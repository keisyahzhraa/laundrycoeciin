<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // Tampilkan halaman tambah pesanan
    public function create()
    {
        return view('manajemen_pesanan.tambah_pesanan');
    }

    // Simpan data pesanan baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'nomor_telephone' => 'nullable|string|max:20',
            'barang_laundry' => 'required|in:pakaian,sepatu,celana',
            'berat_cucian' => 'required|numeric|min:0.1',
            'jenis_layanan' => 'required|in:Satuan,Regular,Express,Super Express/Kilat',
            'tanggal_pesanan' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_pesanan',
            'keterangan' => 'nullable|string',
            'status_pesanan' => 'required|in:Pending,Proses,Selesai',
            'total_harga' => 'required|numeric|min:0',
            'metode_pembayaran' => 'nullable|in:Cash,Transfer,E-wallet',
            'status_pembayaran' => 'required|in:Belum Lunas,Lunas',
            'tanggal_pembayaran' => 'nullable|date',
        ]);

        // Jika user login, ambil id_user
        $validated['id_user'] = Auth::id() ?? 1;

        // Simpan data ke database
        Pesanan::create($validated);

        // Redirect ke daftar pesanan dengan pesan sukses
        return redirect()->route('pesanan.daftar')->with('success', 'Pesanan berhasil ditambahkan!');
    }

    public function index(Request $request)
    {
        // OPTIONAL tapi sangat dianjurkan
        $request->validate([
            'filter_bulan_tahun' => [
                'nullable',
                'regex:/^(0[1-9]|1[0-2])\/\d{4}$/'
            ],
            'status_pesanan' => [
                'nullable',
                'in:Pending,Proses,Selesai'
            ]
        ]);

        $pesanans = Pesanan::query()
            // Filter Bulan & Tahun
            ->when($request->filled('filter_bulan_tahun'), function($q) use ($request) {
                [$bulan, $tahun] = explode('/', $request->filter_bulan_tahun);

                $q->whereMonth('tanggal_pesanan', (int)$bulan)
                ->whereYear('tanggal_pesanan', (int)$tahun);
            })

            // Filter Status Pesanan
            ->when($request->filled('status_pesanan'), function($q) use ($request) {
                $q->where('status_pesanan', $request->status_pesanan);
            })

            ->latest('tanggal_pesanan')
            ->paginate(10)
            ->appends($request->only('filter_bulan_tahun', 'status_pesanan'));

        return view('manajemen_pesanan.pesanan', compact('pesanans'));
    }


    // Tampilkan form edit
    public function edit($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('manajemen_pesanan.tambah_pesanan', compact('pesanan'));
    }


    // Update pesanan
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:100',
            'nomor_telephone' => 'nullable|string|max:20',
            'barang_laundry' => 'required|in:pakaian,sepatu,celana',
            'berat_cucian' => 'required|numeric|min:0.1',
            'jenis_layanan' => 'required|in:Satuan,Regular,Express,Super Express/Kilat',
            'tanggal_pesanan' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_pesanan',
            'keterangan' => 'nullable|string',
            'status_pesanan' => 'required|in:Pending,Proses,Selesai',
            'total_harga' => 'required|numeric|min:0',
            'metode_pembayaran' => 'nullable|in:Cash,Transfer,E-wallet',
            'status_pembayaran' => 'required|in:Belum Lunas,Lunas',
            'tanggal_pembayaran' => 'nullable|date|required_if:status_pembayaran,Lunas',
        ]);

        // Jika pembayaran belum lunas, hapus tanggal pembayaran
        if ($validated['status_pembayaran'] === 'Belum Lunas') {
            $validated['tanggal_pembayaran'] = null;
        }

        $pesanan->update($validated);

        return redirect()->route('pesanan.daftar')->with('success', 'Pesanan berhasil diperbarui!');
    }

    // Hapus pesanan
    public function destroy($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->delete();

        return redirect()->route('pesanan.daftar')->with('success', 'Pesanan berhasil dihapus!');
    }

}
