<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    // Laporan pengeluaran
    public function index()
    {
        $pengeluarans = Pengeluaran::orderByDesc('id_pengeluaran')->paginate(10);
        return view('keuangan.laporan_keuangan', compact('pengeluarans'));
    }

    // Form tambah pengeluaran
    public function create()
    {
        return view('keuangan.tambah_pengeluaran');
    }

    // Simpan pengeluaran
    public function store(Request $request)
    {
        $kategori_enum = ['operasional','bahan_baku','gaji','utilitas','maintenance','lainnya'];
        $metode_enum = ['tunai','transfer','e-wallet','kartu_debit','kartu_kredit'];

        $validated = $request->validate([
            'nominal_pengeluaran' => 'required|numeric|min:0.1',
            'kategori_pengeluaran' => 'required|in:' . implode(',', $kategori_enum),
            'metode_pembayaran' => 'required|in:' . implode(',', $metode_enum),
            'penerima' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'tanggal_pengeluaran' => 'required|date',
            'bukti_lampiran' => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:5120'
        ]);

        $data = [
            'id_user' => auth()->id() ?? 1,
            'nominal' => $validated['nominal_pengeluaran'],
            'kategori' => $validated['kategori_pengeluaran'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'penerima' => $validated['penerima'],
            'keterangan' => $validated['keterangan'] ?? null,
            'tanggal' => $validated['tanggal_pengeluaran'],
            'bukti_pengeluaran' => null,
        ];

        if ($request->hasFile('bukti_lampiran')) {
            $image = $request->file('bukti_lampiran');
            $mime = $image->getMimeType();
            $base64 = base64_encode(file_get_contents($image->getRealPath()));
            $data['bukti_pengeluaran'] = 'data:' . $mime . ';base64,' . $base64;
        }

        Pengeluaran::create($data);

        return redirect()->route('keuangan.laporan')->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id); // ambil data berdasarkan id
       return view('keuangan.tambah_pengeluaran', compact('pengeluaran'));
    }


    // Update pengeluaran
    public function update(Request $request, $id)
    {
        $kategori_enum = ['operasional','bahan_baku','gaji','utilitas','maintenance','lainnya'];
        $metode_enum = ['tunai','transfer','e-wallet','kartu_debit','kartu_kredit'];

        $validated = $request->validate([
            'nominal_pengeluaran' => 'required|numeric|min:0.1',
            'kategori_pengeluaran' => 'required|in:' . implode(',', $kategori_enum),
            'metode_pembayaran' => 'required|in:' . implode(',', $metode_enum),
            'penerima' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'tanggal_pengeluaran' => 'required|date',
            'bukti_lampiran' => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:5120'
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        $data = [
            'nominal' => $validated['nominal_pengeluaran'],
            'kategori' => $validated['kategori_pengeluaran'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'penerima' => $validated['penerima'],
            'keterangan' => $validated['keterangan'] ?? null,
            'tanggal' => $validated['tanggal_pengeluaran'],
        ];

        if ($request->hasFile('bukti_lampiran')) {
            $image = $request->file('bukti_lampiran');
            $mime = $image->getMimeType();
            $base64 = base64_encode(file_get_contents($image->getRealPath()));
            $data['bukti_pengeluaran'] = 'data:' . $mime . ';base64,' . $base64;
        }

        $pengeluaran->update($data);

        return redirect()->route('keuangan.laporan')->with('success', 'Pengeluaran berhasil diperbarui!');
    }

    // Hapus pengeluaran
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return redirect()->route('keuangan.laporan')->with('success', 'Pengeluaran berhasil dihapus!');
    }
}
