<?php

namespace App\Http\Controllers;
use App\Models\HargaLayanan;
use Illuminate\Http\Request;

class HargaLayananController extends Controller
{
    public function update(Request $request)
    {
        // Validasi input: harus array dan setiap item wajib angka >= 0
    $validated = $request->validate([
        'harga'              => 'required|array',
        'harga.*.id_layanan' => 'required|exists:harga_layanans,id_layanan',
        'harga.*.harga_per_kg' => 'required|numeric|min:0',
    ]);

    // Loop update harga layanan
    foreach ($validated['harga'] as $item) {
        \App\Models\HargaLayanan::where('id_layanan', $item['id_layanan'])
            ->update([
                'harga_per_kg' => $item['harga_per_kg'],
            ]);
    }

    return back()->with('success', 'Harga layanan berhasil diperbarui.');
        return back()->with('success', 'Harga layanan berhasil diperbarui!');
    }
}

