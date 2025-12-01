<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class LaporanKeuanganController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan & tahun (default bulan ini)
        $bulan = (int) $request->input('bulan', Carbon::now()->month);
        $tahun = (int) $request->input('tahun', Carbon::now()->year);

        // === 1. TOTAL PEMASUKAN ===
        $totalPemasukan = Pesanan::whereMonth('tanggal_pembayaran', $bulan)
            ->whereYear('tanggal_pembayaran', $tahun)
            ->where('status_pembayaran', 'Lunas')
            ->sum('total_harga') ?? 0;

        // === 2. TOTAL PENGELUARAN ===
        $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('nominal') ?? 0;

        // === 3. LABA BERSIH ===
        $labaBersih = $totalPemasukan - $totalPengeluaran;

        // Nama bulan Indonesia
        $namaBulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        // === 4. PERBANDINGAN BULAN INI VS BULAN LALU ===
        $bulanSebelumnya = Carbon::create($tahun, $bulan)->subMonth();

        // Hitung pemasukan bulan sebelumnya
        $pendapatanPrev = Pesanan::whereMonth('tanggal_pembayaran', $bulanSebelumnya->month)
            ->whereYear('tanggal_pembayaran', $bulanSebelumnya->year)
            ->where('status_pembayaran', 'Lunas')
            ->sum('total_harga');

        // Hitung pengeluaran bulan sebelumnya
        $pengeluaranPrev = Pengeluaran::whereMonth('tanggal', $bulanSebelumnya->month)
            ->whereYear('tanggal', $bulanSebelumnya->year)
            ->sum('nominal');

        // Data bulan ini
        $dataSekarang = [
            'bulan' => $namaBulan[$bulan],
            'pemasukan' => $totalPemasukan,
            'pengeluaran' => $totalPengeluaran
        ];

        // Data bulan sebelumnya
        $dataSebelumnya = [
            'bulan' => $namaBulan[$bulanSebelumnya->month] . " (Bulan Sebelumnya)",
            'pemasukan' => $pendapatanPrev,
            'pengeluaran' => $pengeluaranPrev
        ];

        // Final 2 data untuk chart
        $chartData = [$dataSebelumnya, $dataSekarang];

        // === 5. Persen kenaikan / penurunan ===
        $persenPendapatan = ($pendapatanPrev > 0)
            ? round((($totalPemasukan - $pendapatanPrev) / $pendapatanPrev) * 100)
            : 0;

        $persenPengeluaran = ($pengeluaranPrev > 0)
            ? round((($totalPengeluaran - $pengeluaranPrev) / $pengeluaranPrev) * 100)
            : 0;

        // === 6. REKAP HARIAN ===
        $rekap = [];
        $jumlahHari = Carbon::create($tahun, $bulan)->daysInMonth;

        for ($hari = 1; $hari <= $jumlahHari; $hari++) {
            $tanggal = Carbon::create($tahun, $bulan, $hari)->format('Y-m-d');

            // Pemasukan = total_harga dari pesanan LUNAS pada hari tsb
            $pemasukan = Pesanan::whereDate('tanggal_pembayaran', $tanggal)
                ->where('status_pembayaran', 'Lunas')
                ->sum('total_harga') ?? 0;

            // Pengeluaran harian
            $pengeluaran = Pengeluaran::whereDate('tanggal', $tanggal)
                ->sum('nominal') ?? 0;

            $rekap[] = [
                'tanggal'      => Carbon::create($tahun, $bulan, $hari)->translatedFormat('d F Y'),
                'pemasukan'    => $pemasukan,
                'pengeluaran'  => $pengeluaran,
                'laba_bersih'  => $pemasukan - $pengeluaran,
            ];
        }

        // === 7. Persentase Pemasukan vs Pengeluaran (Pie Chart) ===
        $totalBulanan = $totalPemasukan + $totalPengeluaran;

        if ($totalBulanan > 0) {
            $piePemasukanPercent = round(($totalPemasukan / $totalBulanan) * 100);
            $piePengeluaranPercent = round(($totalPengeluaran / $totalBulanan) * 100);
        } else {
            $piePemasukanPercent = 0;
            $piePengeluaranPercent = 0;
        }

        return view('keuangan.laporan', compact(
            'bulan',
            'tahun',
            'totalPemasukan',
            'totalPengeluaran',
            'labaBersih',
            'chartData',
            'persenPendapatan',
            'persenPengeluaran',
            'rekap',
            'piePemasukanPercent',
            'piePengeluaranPercent',
            'namaBulan',
        ));
    }
}