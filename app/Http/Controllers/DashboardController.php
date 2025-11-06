<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil bulan dan tahun dari request, default sekarang
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        // Tanggal hari ini dan 3 hari ke depan
        $today = Carbon::today();
        $limit = $today->copy()->addDays(3);

        // ===== Statistik Pesanan =====
        $totalPesanan = Pesanan::whereMonth('tanggal_pesanan', $bulan)
            ->whereYear('tanggal_pesanan', $tahun)
            ->count();

        $totalPendapatan = Pesanan::whereMonth('tanggal_pesanan', $bulan)
            ->whereYear('tanggal_pesanan', $tahun)
            ->sum('total_harga');

        $totalSelesai = Pesanan::where('status_pesanan', 'Selesai')
            ->whereMonth('tanggal_pesanan', $bulan)
            ->whereYear('tanggal_pesanan', $tahun)
            ->count();

        $totalDikerjakan = Pesanan::where('status_pesanan', 'Dikerjakan')
            ->whereMonth('tanggal_pesanan', $bulan)
            ->whereYear('tanggal_pesanan', $tahun)
            ->count();

        $totalBelumDikerjakan = Pesanan::where('status_pesanan', 'Belum')
            ->whereMonth('tanggal_pesanan', $bulan)
            ->whereYear('tanggal_pesanan', $tahun)
            ->count();

        // ===== Statistik Pengeluaran =====
        $totalPengeluaran = Pengeluaran::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('nominal');

        // ===== Laba Bersih =====
        $labaBersih = $totalPendapatan - $totalPengeluaran;

        // ===== Chart Pendapatan Harian =====
        // Ambil total pendapatan per hari
        $chartRaw = Pesanan::select(
                DB::raw('DAY(tanggal_pesanan) as hari'),
                DB::raw('SUM(total_harga) as total')
            )
            ->whereMonth('tanggal_pesanan', $bulan)
            ->whereYear('tanggal_pesanan', $tahun)
            ->groupBy('hari')
            ->orderBy('hari')
            ->get()
            ->pluck('total', 'hari') // key = hari, value = total
            ->toArray();

        // Semua hari di bulan berjalan
        $daysInMonth = Carbon::createFromDate($tahun, $bulan, 1)->daysInMonth;
        $labels = range(1, $daysInMonth); // 1,2,3,...,30/31
        $chartData = array_map(fn($day) => $chartRaw[$day] ?? 0, $labels);

        // Tambahkan prefix "Hari " untuk label
        $labelsWithPrefix = array_map(fn($day) => 'Hari '.$day, $labels);

        // ===== Pesanan Mendekati Deadline (<3 hari dari sekarang) =====
        $pesananDeadline = Pesanan::where('status_pesanan', '!=', 'Selesai')
            ->whereBetween('tanggal_selesai', [$today, $limit])
            ->orderBy('tanggal_selesai', 'asc')
            ->get();

        // ===== Return View =====
        return view('dashboard.index', [
            'totalPesanan' => $totalPesanan,
            'totalPendapatan' => $totalPendapatan,
            'totalPengeluaran' => $totalPengeluaran,
            'labaBersih' => $labaBersih,
            'chartData' => $chartData,
            'labels' => $labelsWithPrefix,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'totalSelesai' => $totalSelesai,
            'totalDikerjakan' => $totalDikerjakan,
            'totalBelumDikerjakan' => $totalBelumDikerjakan,
            'pesananDeadline' => $pesananDeadline
        ]);
    }
}
