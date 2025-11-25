<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PengeluaranController extends Controller
{   
// Form tambah pengeluaran
    public function create()
    {
        return view('manajemen_pengeluaran.tambah_pengeluaran');
    }

    // Simpan pengeluaran
    public function store(Request $request)
    {
        $kategori_enum = ['operasional','bahan_baku','gaji','utilitas','maintenance','lainnya'];
        $metode_enum = ['tunai','transfer','e-wallet','kartu_debit','kartu_kredit'];

        $validated = $request->validate([
            'nominal' => 'required|numeric|min:0.1',
            'kategori' => 'required|in:' . implode(',', $kategori_enum),
            'metode_pembayaran' => 'required|in:' . implode(',', $metode_enum),
            'penerima' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
            'bukti_pengeluaran' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $data = [
            'id_user' => auth()->id() ?? 1,
            'nominal' => $validated['nominal'],
            'kategori' => $validated['kategori'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'penerima' => $validated['penerima'],
            'keterangan' => $validated['keterangan'] ?? null,
            'tanggal' => $validated['tanggal'],
            'bukti_pengeluaran' => null,
        ];

        if ($request->hasFile('bukti_pengeluaran')) {

            $foto = $request->file('bukti_pengeluaran');

            // Hapus foto lama jika ada
            if (
                $pengeluaran->bukti_pengeluaran &&
                Storage::disk('public')->exists($pengeluaran->bukti_pengeluaran)
            ) {
                Storage::disk('public')->delete($pengeluaran->bukti_pengeluaran);
            }

            // Simpan foto baru dengan nama unik
            $filename = uniqid() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('bukti_pengeluaran', $filename, 'public');

            // Update field bukti
            $data['bukti_pengeluaran'] = $path;
        }

        Pengeluaran::create($data);

        return redirect()->route('pengeluaran.daftar')->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    // Daftar pengeluaran
    public function index(Request $request)
    {
        // VALIDASI FILTER
        $request->validate([
            'filter_bulan_tahun' => [
                'nullable',
                'regex:/^(0[1-9]|1[0-2])\/\d{4}$/'
            ],
        ]);

        // =====================================
        // 1. CEK APAKAH FILTER AKTIF
        // =====================================
        $isFilterActive = $request->filled('filter_bulan_tahun');
        
        // =====================================
        // 2. QUERY UTAMA TABEL
        // =====================================
        $query = Pengeluaran::query();

        // Jika filter aktif → terapkan filter
        if ($isFilterActive) {

            [$bulan, $tahun] = explode('/', $request->filter_bulan_tahun);

            $query->whereMonth('tanggal', (int) $bulan)
                ->whereYear('tanggal', (int) $tahun);

            // Total pencatatan bulan yang dipilih
            $totalPerBulan = $query->count();

        } else {

            // Tanpa filter → hitung bulan ini saja
            $totalPerBulan = Pengeluaran::whereMonth('tanggal', now()->month)
                                        ->whereYear('tanggal', now()->year)
                                        ->count();
        }

        // =====================================
        // 3. PAGINATION
        // =====================================
        $pengeluarans = $query->latest('tanggal')
                            ->paginate(10)
                            ->appends($request->only('filter_bulan_tahun'));

        // =====================================
        // 4. KIRIM KE VIEW
        // =====================================
        return view('manajemen_pengeluaran.pengeluaran', [
            'pengeluarans' => $pengeluarans,
            'totalPerBulan' => $totalPerBulan,
            'isFilterActive' => $isFilterActive
        ]);;    
    }
    
    // Form edit
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id); // ambil data berdasarkan id
        return view('manajemen_pengeluaran.tambah_pengeluaran', compact('pengeluaran'));
    }


    // Update pengeluaran
    public function update(Request $request, $id)
    {
        $kategori_enum = ['operasional','bahan_baku','gaji','utilitas','maintenance','lainnya'];
        $metode_enum = ['tunai','transfer','e-wallet','kartu_debit','kartu_kredit'];

        $validated = $request->validate([
            'nominal' => 'required|numeric|min:0.1',
            'kategori' => 'required|in:' . implode(',', $kategori_enum),
            'metode_pembayaran' => 'required|in:' . implode(',', $metode_enum),
            'penerima' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
            'bukti_pengeluaran' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        $data = [
            'nominal' => $validated['nominal'],
            'kategori' => $validated['kategori'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'penerima' => $validated['penerima'],
            'keterangan' => $validated['keterangan'] ?? null,
            'tanggal' => $validated['tanggal'],
        ];

        if ($request->hasFile('bukti_pengeluaran')) {

            $foto = $request->file('bukti_pengeluaran');

            // Hapus foto lama jika ada
            if (
                $pengeluaran->bukti_pengeluaran &&
                Storage::disk('public')->exists($pengeluaran->bukti_pengeluaran)
            ) {
                Storage::disk('public')->delete($pengeluaran->bukti_pengeluaran);
            }

            // Simpan foto baru dengan nama unik
            $filename = uniqid() . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('bukti_pengeluaran', $filename, 'public');

            // Update field bukti
            $data['bukti_pengeluaran'] = $path;
        }

        // Update data lain
        $pengeluaran->update($data);

        return redirect()->route('pengeluaran.daftar')
            ->with('success', 'Pengeluaran berhasil diperbarui!');
    }

    // Hapus pengeluaran
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('pengeluaran.daftar')->with('success', 'Pengeluaran berhasil dihapus!');
    }
}
