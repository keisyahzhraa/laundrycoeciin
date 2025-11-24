@extends('layouts.app')

@section('title', 'Laporan Keuangan | Coeciin')
@section('page_title', 'Manajemen Keuangan')

@section('content')
<main class="p-8 min-h-screen" style="background-color: #EFFCFF;">
  <!-- Header -->
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Laporan Keuangan</h1>
  </div>

  {{-- Notifikasi Sukses --}}
  @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
      <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
      </svg>
      {{ session('success') }}
    </div>
  @endif

  <!-- Summary Cards Row -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Left Column: 2 Stacked Cards -->
    <div class="space-y-8">
      <!-- Keuntungan Bersih Card -->
      <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-2xl shadow-lg p-8 text-white relative overflow-hidden min-h-[100px]">
        <div class="absolute top-6 right-6">
          <div class="px-5 py-2.5 bg-white text-blue-600 rounded-lg text-base font-semibold">
            @php
              $bulanFilter = request('bulan');
              $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              echo $bulanFilter ? $namaBulan[$bulanFilter] : 'Semua Bulan';
            @endphp
          </div>
        </div>
        <p class="text-base opacity-90 mb-3">Keuntungan Bersih</p>
        <h2 class="text-4xl font-bold">Rp {{ number_format($labaBersih ?? 0, 0, ',', '.') }}</h2>
      </div>

      <!-- Total Pendapatan Card -->
      <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 relative min-h-[100px]">
        <div class="absolute top-6 right-6">
          <div class="px-5 py-2.5 bg-blue-500 text-white rounded-lg text-base font-semibold">
            @php
              $bulanFilter = request('bulan');
              $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              echo $bulanFilter ? $namaBulan[$bulanFilter] : 'Semua Bulan';
            @endphp
          </div>
        </div>
        <div class="flex items-center gap-4 mb-4">
          <div class="bg-blue-100 rounded-xl p-4">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
            </svg>
          </div>
          <p class="text-base text-gray-600 font-medium">Total Pendapatan</p>
        </div>
        <h3 class="text-4xl font-bold text-gray-900">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</h3>
      </div>
    </div>

    <!-- Right Column: 2 Stacked Cards -->
    <div class="space-y-8">
      <!-- Banner Card with Image -->
      <div class="bg-gradient-to-br from-gray-600 to-gray-700 rounded-2xl shadow-lg overflow-hidden relative min-h-[140px]">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-700/90 to-transparent z-10"></div>
        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=500&h=200&fit=crop" alt="Customer Service" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 flex items-center p-8 z-20">
          <div class="text-white max-w-xs">
            <h3 class="text-3xl font-bold mb-3">Lihat Laporan Keuanganmu!</h3>
          </div>
        </div>
      </div>

      <!-- Total Pengeluaran Card -->
      <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 relative min-h-[100px]">
        <div class="absolute top-6 right-6">
          <div class="px-5 py-2.5 bg-blue-500 text-white rounded-lg text-base font-semibold">
            @php
              $bulanFilter = request('bulan');
              $namaBulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              echo $bulanFilter ? $namaBulan[$bulanFilter] : 'Semua Bulan';
            @endphp
          </div>
        </div>
        <div class="flex items-center gap-4 mb-4">
          <div class="bg-blue-100 rounded-xl p-4">
            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
            </svg>
          </div>
          <p class="text-base text-gray-600 font-medium">Total Pengeluaran</p>
        </div>
        <h3 class="text-4xl font-bold text-gray-900">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</h3>
      </div>
    </div>
  </div>

  <!-- Charts Row -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Perbandingan Bulanan Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-800">Perbandingan Bulanan</h3>
        <button class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
          <span>Filter</span>
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>
      </div>
      @if(isset($chartData) && count($chartData) > 0)
      <div class="h-64 flex items-end justify-around gap-4">
        @php
          $maxValue = 0;
          foreach($chartData as $data) {
            $maxValue = max($maxValue, $data['pemasukan'], $data['pengeluaran']);
          }
          $maxValue = $maxValue > 0 ? $maxValue : 1;
        @endphp
        
        @foreach($chartData as $data)
          @php
            $pemasukanHeight = ($data['pemasukan'] / $maxValue) * 200;
            $pengeluaranHeight = ($data['pengeluaran'] / $maxValue) * 200;
          @endphp
          <div class="flex flex-col items-center gap-2 flex-1">
            <div class="w-full bg-blue-500 rounded-t-lg transition-all" style="height: {{ $pemasukanHeight }}px;"></div>
            <span class="text-xs text-gray-600">{{ $data['label'] }}</span>
          </div>
          <div class="flex flex-col items-center gap-2 flex-1">
            <div class="w-full bg-yellow-400 rounded-t-lg transition-all" style="height: {{ $pengeluaranHeight }}px;"></div>
            <span class="text-xs text-gray-600">{{ $data['label'] }}</span>
          </div>
        @endforeach
      </div>
      @else
      <div class="h-64 flex items-center justify-center">
        <div class="text-center text-gray-400">
          <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
          </svg>
          <p class="text-sm">Belum ada data untuk ditampilkan</p>
        </div>
      </div>
      @endif
      <div class="mt-4 flex items-center justify-center gap-6">
        <div class="flex items-center gap-2">
          <div class="w-4 h-4 bg-blue-500 rounded"></div>
          <span class="text-xs text-gray-600">Pemasukan</span>
        </div>
        <div class="flex items-center gap-2">
          <div class="w-4 h-4 bg-yellow-400 rounded"></div>
          <span class="text-xs text-gray-600">Pengeluaran</span>
        </div>
      </div>
    </div>

    <!-- Rekapitulasi Pie Chart -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
      <h3 class="text-lg font-bold text-gray-800 mb-6">Rekapitulasi</h3>
      @if(($totalPemasukan ?? 0) > 0 || ($totalPengeluaran ?? 0) > 0)
      @php
        $total = ($totalPemasukan ?? 0) + ($totalPengeluaran ?? 0);
        $pemasukanPercent = $total > 0 ? round((($totalPemasukan ?? 0) / $total) * 100) : 0;
        $pengeluaranPercent = 100 - $pemasukanPercent;
        
        $circumference = 2 * 3.14159 * 40;
        $pemasukanDash = ($pemasukanPercent / 100) * $circumference;
        $pengeluaranDash = ($pengeluaranPercent / 100) * $circumference;
      @endphp
      <div class="flex items-center justify-center">
        <div class="relative w-48 h-48">
          <svg viewBox="0 0 100 100" class="transform -rotate-90">
            <circle cx="50" cy="50" r="40" fill="none" stroke="#3B82F6" stroke-width="20" stroke-dasharray="{{ $pemasukanDash }} {{ $circumference }}"/>
            <circle cx="50" cy="50" r="40" fill="none" stroke="#FCD34D" stroke-width="20" stroke-dasharray="{{ $pengeluaranDash }} {{ $circumference }}" stroke-dashoffset="-{{ $pemasukanDash }}"/>
          </svg>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center">
              <p class="text-2xl font-bold text-gray-800">{{ $pemasukanPercent }}%</p>
              <p class="text-xs text-gray-500">Pemasukan</p>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-6 space-y-3">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-2">
            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
            <span class="text-sm text-gray-700">{{ $pemasukanPercent }}% Pemasukan</span>
          </div>
          <span class="text-sm font-semibold text-gray-800">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</span>
        </div>
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-2">
            <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
            <span class="text-sm text-gray-700">{{ $pengeluaranPercent }}% Pengeluaran</span>
          </div>
          <span class="text-sm font-semibold text-gray-800">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</span>
        </div>
      </div>
      @else
      <div class="flex items-center justify-center h-64">
        <div class="text-center text-gray-400">
          <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
          </svg>
          <p class="text-sm">Belum ada data untuk ditampilkan</p>
        </div>
      </div>
      @endif
    </div>
  </div>

  <!-- Rekapitulasi Table -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
    <div class="px-6 py-5 border-b border-gray-200">
      <h3 class="text-lg font-bold text-gray-800">Rekapitulasi</h3>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">No</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Bulan</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Total Pemasukan (Rp)</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Total Pengeluaran (Rp)</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Laba Bersih (Rp)</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($rekapitulasi ?? [] as $index => $rekap)
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ $rekap['bulan'] }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($rekap['pemasukan'], 0, ',', '.') }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ number_format($rekap['pengeluaran'], 0, ',', '.') }}</td>
            <td class="px-6 py-4 text-sm {{ $rekap['laba'] >= 0 ? 'text-green-600' : 'text-red-600' }} font-semibold">
              {{ number_format($rekap['laba'], 0, ',', '.') }}
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
              <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
              Belum ada data rekapitulasi
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200 flex items-center justify-end">
      <button class="px-4 py-2 text-blue-600 hover:text-blue-700 text-sm font-medium">
        Lihat Semua →
      </button>
    </div>
  </div>

  <!-- Filter Bulanan -->
  <div class="bg-gradient-to-r from-blue-400 to-blue-500 rounded-xl shadow-sm p-6 mb-8 flex items-center justify-between">
    <h3 class="text-2xl font-bold text-white">Filter Bulanan</h3>
    <div class="relative">
      <select id="filterBulanBar" onchange="applyFilterFromBar()" class="px-6 py-2.5 bg-white text-gray-800 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none appearance-none cursor-pointer pr-12 min-w-[180px] font-medium">
        <option value="">Semua Bulan</option>
        <option value="1" {{ request('bulan') == 1 ? 'selected' : '' }}>Januari</option>
        <option value="2" {{ request('bulan') == 2 ? 'selected' : '' }}>Februari</option>
        <option value="3" {{ request('bulan') == 3 ? 'selected' : '' }}>Maret</option>
        <option value="4" {{ request('bulan') == 4 ? 'selected' : '' }}>April</option>
        <option value="5" {{ request('bulan') == 5 ? 'selected' : '' }}>Mei</option>
        <option value="6" {{ request('bulan') == 6 ? 'selected' : '' }}>Juni</option>
        <option value="7" {{ request('bulan') == 7 ? 'selected' : '' }}>Juli</option>
        <option value="8" {{ request('bulan') == 8 ? 'selected' : '' }}>Agustus</option>
        <option value="9" {{ request('bulan') == 9 ? 'selected' : '' }}>September</option>
        <option value="10" {{ request('bulan') == 10 ? 'selected' : '' }}>Oktober</option>
        <option value="11" {{ request('bulan') == 11 ? 'selected' : '' }}>November</option>
        <option value="12" {{ request('bulan') == 12 ? 'selected' : '' }}>Desember</option>
      </select>
      <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
      </div>
    </div>
  </div>

  <!-- List Pemasukan -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
    <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
      <h3 class="text-lg font-bold text-gray-800">List Pemasukan</h3>
      <a href="{{ route('pesanan.tambah') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-all">
        + Tambah Pemasukan
      </a>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">No</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Nama Pelanggan</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Tanggal Masuk</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Tanggal Selesai</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Jenis</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Total Berat</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Total Harga</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Status</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($pemasukans ?? [] as $index => $pemasukan)
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ $pemasukan->nama_pelanggan ?? '-' }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ $pemasukan->tanggal_transaksi ? $pemasukan->tanggal_transaksi->format('d/m/Y') : '-' }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ $pemasukan->tanggal_selesai ? $pemasukan->tanggal_selesai->format('d/m/Y') : '-' }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst($pemasukan->jenis ?? '-') }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ $pemasukan->berat ?? '-' }} Kg</td>
            <td class="px-6 py-4 text-sm text-gray-700">Rp {{ number_format($pemasukan->total_bayar ?? 0, 0, ',', '.') }}</td>
            <td class="px-6 py-4">
              <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                {{ $pemasukan->status ?? 'Di Outlet' }}
              </span>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <a href="{{ route('pesanan.show', $pemasukan->id) }}" class="text-yellow-600 hover:text-yellow-700 hover:bg-yellow-50 p-1.5 rounded-lg transition-all">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                </a>
                <a href="{{ route('pesanan.edit', $pemasukan->id) }}" class="text-blue-600 hover:text-blue-700 hover:bg-blue-50 p-1.5 rounded-lg transition-all">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                  </svg>
                </a>
                <form action="{{ route('pesanan.destroy', $pemasukan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus data pemasukan ini?');" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-700 hover:bg-red-50 p-1.5 rounded-lg transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="9" class="px-6 py-8 text-center text-gray-500">
              <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
              Belum ada data pemasukan
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- List Pengeluaran -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-200 flex items-center justify-between">
      <h3 class="text-lg font-bold text-gray-800">List Pengeluaran</h3>
      <a href="{{ route('keuangan.tambah') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-all">
        + Tambah Pengeluaran
      </a>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">No</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Tanggal Masuk</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Tanggal Pengeluaran</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Nominal</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Kategori</th>
            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          @forelse($pengeluarans as $index => $p)
          <tr class="hover:bg-gray-50 transition-colors">
            <td class="px-6 py-4 text-sm text-gray-700">{{ $index + $pengeluarans->firstItem() }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ $p->created_at->format('d/m/y') }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ $p->tanggal->format('d/m/y') }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
            <td class="px-6 py-4 text-sm text-gray-700">{{ ucfirst(str_replace('_', ' ', $p->kategori)) }}</td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <button onclick='showDetail(@json($p))' class="text-yellow-600 hover:text-yellow-700 hover:bg-yellow-50 p-1.5 rounded-lg transition-all">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                </button>
                <a href="{{ route('pengeluaran.edit', $p->id_pengeluaran) }}" class="text-blue-600 hover:text-blue-700 hover:bg-blue-50 p-1.5 rounded-lg transition-all">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                  </svg>
                </a>
                <form action="{{ route('pengeluaran.destroy', $p->id_pengeluaran) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus pengeluaran ini?');" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 hover:text-red-700 hover:bg-red-50 p-1.5 rounded-lg transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
              <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
              Belum ada data pengeluaran
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-200">
      {{ $pengeluarans->links() }}
    </div>
  </div>
</main>

{{-- ===================== MODAL: DETAIL PENGELUARAN ===================== --}}
<div id="modalDetail" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
  <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full p-6 relative max-h-[90vh] overflow-y-auto">
    <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors" onclick="closeDetail()">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
    
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Pengeluaran</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
      <div class="bg-gray-50 rounded-lg p-4">
        <p class="text-xs text-gray-500 mb-1">Penerima</p>
        <p class="text-sm font-semibold text-gray-800" id="detailPenerima"></p>
      </div>
      
      <div class="bg-gray-50 rounded-lg p-4">
        <p class="text-xs text-gray-500 mb-1">Tanggal</p>
        <p class="text-sm font-semibold text-gray-800" id="detailTanggal"></p>
      </div>
      
      <div class="bg-gray-50 rounded-lg p-4">
        <p class="text-xs text-gray-500 mb-1">Nominal</p>
        <p class="text-sm font-semibold text-gray-800">Rp <span id="detailNominal"></span></p>
      </div>
      
      <div class="bg-gray-50 rounded-lg p-4">
        <p class="text-xs text-gray-500 mb-1">Kategori</p>
        <p class="text-sm font-semibold text-gray-800" id="detailKategori"></p>
      </div>
      
      <div class="bg-gray-50 rounded-lg p-4">
        <p class="text-xs text-gray-500 mb-1">Metode Pembayaran</p>
        <p class="text-sm font-semibold text-gray-800" id="detailMetode"></p>
      </div>
      
      <div class="bg-gray-50 rounded-lg p-4">
        <p class="text-xs text-gray-500 mb-1">Keterangan</p>
        <p class="text-sm font-semibold text-gray-800" id="detailKeterangan"></p>
      </div>
    </div>

    <div class="border-t border-gray-200 pt-4">
      <p class="font-semibold text-gray-800 mb-3">Bukti Pengeluaran</p>
      <div class="text-center bg-gray-50 rounded-lg p-4">
        <img id="detailBukti" class="max-h-[300px] mx-auto rounded-lg border border-gray-200" alt="Bukti Pengeluaran">
        <p id="noBukti" class="text-sm text-gray-500 mt-3 hidden">Tidak ada bukti pengeluaran</p>
      </div>
    </div>
  </div>
</div>

{{-- ===================== SCRIPT ===================== --}}
<script>
  // ===== Filter Bulanan Bar =====
  function applyFilterFromBar() {
    const bulan = document.getElementById('filterBulanBar').value;
    const tahun = new Date().getFullYear();
    
    if (bulan) {
      let url = '{{ route("keuangan.laporan") }}?bulan=' + bulan + '&tahun=' + tahun;
      window.location.href = url;
    } else {
      window.location.href = '{{ route("keuangan.laporan") }}';
    }
  }

  // ===== Modal Detail Pengeluaran =====
  function showDetail(data) {
    document.getElementById('detailPenerima').textContent = data.penerima || '-';
    document.getElementById('detailTanggal').textContent = new Date(data.tanggal).toLocaleDateString('id-ID', {
      day: '2-digit',
      month: 'long',
      year: 'numeric'
    });
    document.getElementById('detailNominal').textContent = (data.nominal || 0).toLocaleString('id-ID');
    document.getElementById('detailKategori').textContent = data.kategori ? ucfirst(data.kategori.replace(/_/g, ' ')) : '-';
    document.getElementById('detailMetode').textContent = data.metode_pembayaran ? ucfirst(data.metode_pembayaran.replace(/_/g, ' ')) : '-';
    document.getElementById('detailKeterangan').textContent = data.keterangan || '-';

    const img = document.getElementById('detailBukti');
    const noBukti = document.getElementById('noBukti');
    
    if (data.bukti_pengeluaran) {
      img.src = data.bukti_pengeluaran.startsWith('data:image') 
        ? data.bukti_pengeluaran 
        : '{{ asset('storage') }}/' + data.bukti_pengeluaran;
      img.classList.remove('hidden');
      noBukti.classList.add('hidden');
    } else {
      img.classList.add('hidden');
      noBukti.classList.remove('hidden');
    }

    const modal = document.getElementById('modalDetail');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
  }
  
  function closeDetail() {
    const modal = document.getElementById('modalDetail');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  }

  // Set filter on page load
  document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const bulan = urlParams.get('bulan');
    
    if (bulan) {
      document.getElementById('filterBulanBar').value = bulan;
    }
  });

  // Helper function
  function ucfirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
  }

  // Close modal when clicking outside
  document.getElementById('modalDetail')?.addEventListener('click', function(e) {
    if (e.target === this) closeDetail();
  });
</script>
@endsection