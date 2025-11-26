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

  <!-- Filter Bulanan -->
    <div class="bg-gradient-to-r from-blue-400 to-blue-500 rounded-xl shadow-sm p-6 mb-8">
        <h3 class="text-2xl font-bold text-white mb-4">Filter Laporan</h3>

        <div class="flex flex-wrap gap-4">

            <!-- Dropdown Bulan -->
            <div class="relative">
                <select id="filterBulanBar" 
                    class="px-6 py-2.5 bg-white text-gray-800 rounded-lg focus:ring-2 focus:ring-blue-300 appearance-none cursor-pointer pr-12 min-w-[160px] font-medium">
                    
                    <option value="" disabled selected hidden>Pilih Bulan</option>

                    @foreach($namaBulan as $key => $value)
                        <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>

                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Dropdown Tahun -->
            <div class="relative">
                <select id="filterTahunBar"
                    class="px-6 py-2.5 bg-white text-gray-800 rounded-lg focus:ring-2 focus:ring-blue-300 appearance-none cursor-pointer pr-12 min-w-[140px] font-medium">

                    @php
                        $tahunSekarang = date('Y');
                    @endphp

                    @for($t = $tahunSekarang; $t >= $tahunSekarang - 5; $t--)
                        <option value="{{ $t }}" {{ $tahun == $t ? 'selected' : '' }}>
                            {{ $t }}
                        </option>
                    @endfor

                </select>

                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Tombol Terapkan -->
            <button onclick="applyFilterFromBar()" 
                class="px-6 py-2.5 bg-white/20 text-white font-semibold rounded-lg hover:bg-white/30 transition">
                Terapkan
            </button>
        </div>
    </div>
  <!-- Summary Cards Row -->
  <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 mb-8">
    <!-- Left Column: 2 Stacked Cards -->
    <div class="space-y-8">
      <!-- ===== ROW 1: Keuntungan Bersih & Banner ===== -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

            <!-- Keuntungan Bersih -->
            <div class="bg-gradient-to-br from-blue-400 to-blue-500 rounded-2xl shadow-lg p-8 text-white relative overflow-hidden min-h-[140px]">

                <div class="absolute top-6 right-6">
                    <div class="px-5 py-2.5 bg-white text-blue-600 rounded-lg text-base font-semibold">
                        @php
                            $namaBulan = [
                                1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                                7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
                            ];
                            echo $namaBulan[$bulan] . " " . $tahun;
                        @endphp
                    </div>
                </div>

                <p class="text-base opacity-90 mb-3">Keuntungan Bersih</p>
                <h2 class="text-4xl font-bold">Rp {{ number_format($labaBersih ?? 0,0,',','.') }}</h2>
            </div>

            <!-- Banner -->
            <div class="rounded-2xl shadow-lg overflow-hidden relative min-h-[140px] bg-cover bg-center"
                style="background-image: url('{{ asset('fogot.png') }}');">

                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-gray-700/80 to-transparent z-10"></div>

                <div class="absolute inset-0 flex items-center p-8 z-20">
                    <div class="text-white max-w-xs">
                        <h3 class="text-3xl font-bold mb-3">Lihat Laporan Keuanganmu!</h3>
                    </div>
                </div>
            </div>

        </div>


        <!-- ===== ROW 2: Total Pendapatan & Total Pengeluaran ===== -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

            <!-- Total Pendapatan -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 relative min-h-[120px]">

                <div class="absolute top-6 right-6">
                    <div class="px-5 py-2.5 bg-blue-500 text-white rounded-lg text-base font-semibold">
                        @php
                            echo $namaBulan[$bulan] . ' ' . $tahun;
                        @endphp
                    </div>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-blue-100 rounded-xl p-4">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <p class="text-base text-gray-600 font-medium">Total Pendapatan</p>
                </div>

                <h3 class="text-4xl font-bold text-gray-900">
                    Rp {{ number_format($totalPemasukan ?? 0,0,',','.') }}
                </h3>

            </div>

            <!-- Total Pengeluaran -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 relative min-h-[120px]">

                <div class="absolute top-6 right-6">
                    <div class="px-5 py-2.5 bg-blue-500 text-white rounded-lg text-base font-semibold">
                        @php echo $namaBulan[$bulan] . ' ' . $tahun; @endphp
                    </div>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <div class="bg-blue-100 rounded-xl p-4">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                        </svg>
                    </div>
                    <p class="text-base text-gray-600 font-medium">Total Pengeluaran</p>
                </div>

                <h3 class="text-4xl font-bold text-gray-900">
                    Rp {{ number_format($totalPengeluaran ?? 0,0,',','.') }}
                </h3>

            </div>

        </div>


  <!-- ROW 3: Chart Batang + Pie Chart -->
    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        
        <!-- Perbandingan Bulanan Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-800">Perbandingan Bulanan</h3>
            </div>

            @if(!empty($chartData) && count($chartData) == 2)
            <div class="relative">

                <!-- Sumbu X -->
                <div class="absolute left-0 right-0 bottom-12 h-[2px] bg-gray-300"></div>

                <div class="h-72 flex items-end justify-center gap-24 relative">

                    @php
                        $maxValue = max(
                            $chartData[0]['pemasukan'],
                            $chartData[0]['pengeluaran'],
                            $chartData[1]['pemasukan'],
                            $chartData[1]['pengeluaran']
                        );
                        $maxValue = $maxValue > 0 ? $maxValue : 1;
                    @endphp

                    @foreach($chartData as $data)
                        @php
                            $pemasukanHeight = ($data['pemasukan'] / $maxValue) * 180;
                            $pengeluaranHeight = ($data['pengeluaran'] / $maxValue) * 180;
                        @endphp

                        <div class="flex flex-col items-center gap-4 relative">

                            <!-- Label nilai -->
                            <div class="flex justify-center gap-6 mb-2">
                                <span class="text-sm font-semibold text-blue-700">
                                    Rp{{ number_format($data['pemasukan'],0,',','.') }}
                                </span>
                                <span class="text-sm font-semibold text-red-600">
                                    Rp{{ number_format($data['pengeluaran'],0,',','.') }}
                                </span>
                            </div>

                            <!-- Bars -->
                            <div class="flex items-end gap-6 h-48 relative">

                                <!-- Garis bantu vertikal di bawah setiap bar -->
                                <div class="absolute left-1 right-1 bottom-[-12px] w-full"></div>

                                <!-- Bar pemasukan -->
                                <div class="w-14 bg-blue-500/90 rounded-lg shadow-md transition-all duration-300 hover:bg-blue-600"
                                    style="height: {{ $pemasukanHeight }}px;"></div>

                                <!-- Bar pengeluaran -->
                                <div class="w-14 bg-red-600/90 rounded-lg shadow-md transition-all duration-300 hover:bg-red-700"
                                    style="height: {{ $pengeluaranHeight }}px;"></div>
                            </div>

                            <!-- Label bulan -->
                            <span class="text-sm text-gray-800 font-semibold text-center mt-4">
                                {{ $data['bulan'] }}
                            </span>

                        </div>
                    @endforeach

                </div>
            </div>

            @else
            <div class="h-64 flex items-center justify-center">
                <div class="text-center text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <p class="text-sm">Belum ada data untuk ditampilkan</p>
                </div>
            </div>
            @endif

            <!-- Legend -->
            <div class="mt-6 flex items-center justify-center gap-10">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-blue-500 rounded"></div>
                    <span class="text-xs text-gray-600">Pemasukan</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 bg-red-600 rounded"></div>
                    <span class="text-xs text-gray-600">Pengeluaran</span>
                </div>
            </div>
        </div>

        <!-- Perbandingan Pie Chart -->
        <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 w-full">
            <h3 class="text-lg font-bold text-gray-800 mb-6">
                Persentase Pemasukan & Pengeluaran Bulanan
            </h3>

            @php
                // nilai absolut
                $absIn = abs($piePemasukanPercent);
                $absOut = abs($piePengeluaranPercent);

                $totalPie = max(1, $absIn + $absOut);

                $radius = 55; 
                $circumference = 2 * pi() * $radius;

                $inDash = ($absIn / $totalPie) * $circumference;
                $outDash = ($absOut / $totalPie) * $circumference;
            @endphp

            <div class="flex flex-col items-center justify-center w-full">
                <div class="flex justify-center w-full">
                    <svg width="180" height="180" viewBox="0 0 180 180">
                        <circle cx="90" cy="90" r="{{ $radius }}" fill="none" stroke="#e5e7eb" stroke-width="24"/>

                        <!-- Pemasukan -->
                        <circle cx="90" cy="90" r="{{ $radius }}" fill="none" stroke="#3b82f6"
                            stroke-width="24" stroke-dasharray="{{ $inDash }} {{ $circumference }}"
                            stroke-linecap="round" transform="rotate(-90 90 90)"/>

                        <!-- Pengeluaran -->
                        <circle cx="90" cy="90" r="{{ $radius }}" fill="none" stroke="#ef4444"
                            stroke-width="24" stroke-dasharray="{{ $outDash }} {{ $circumference }}"
                            stroke-linecap="round"
                            transform="rotate({{ ($absIn / $totalPie * 360) - 90 }} 90 90)"/>
                    </svg>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4 w-full text-center">
                    <div class="bg-blue-50 p-3 rounded-lg shadow-sm">
                        <p class="text-sm font-medium text-blue-600">Pemasukan</p>
                        <p class="text-2xl font-bold text-blue-700">{{ $piePemasukanPercent }}%</p>
                    </div>

                    <div class="bg-red-50 p-3 rounded-lg shadow-sm">
                        <p class="text-sm font-medium text-red-600">Pengeluaran</p>
                        <p class="text-2xl font-bold text-red-700">{{ $piePengeluaranPercent }}%</p>
                    </div>
                </div>
            </div>
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
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Total Pemasukan (Rp)</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Total Pengeluaran (Rp)</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Laba Bersih (Rp)</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @forelse($rekap ?? [] as $index => $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ $item['tanggal'] }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ number_format($item['pemasukan'], 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-700">
                            {{ number_format($item['pengeluaran'], 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 text-sm 
                            {{ $item['laba_bersih'] >= 0 ? 'text-green-600' : 'text-red-600' }} 
                            font-semibold">
                            {{ number_format($item['laba_bersih'], 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty

                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Belum ada data rekapitulasi
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</main>

{{-- ===================== SCRIPT ===================== --}}
<script>
  // ===== Filter Bulanan Bar =====
  function applyFilterFromBar() {
    const bulan = document.getElementById('filterBulanBar').value;
    const tahun = document.getElementById('filterTahunBar').value;

    let url = '{{ route("keuangan.laporan") }}';

    url += '?bulan=' + bulan + '&tahun=' + tahun;

    window.location.href = url;
    }

  // ===== Set dropdown sesuai URL saat halaman load =====
    document.addEventListener('DOMContentLoaded', function() {
        const params = new URLSearchParams(window.location.search);

        const bulan = params.get('bulan') || '';
        const tahun = params.get('tahun') || '{{ date("Y") }}';

        document.getElementById('filterBulanBar').value = bulan;
        document.getElementById('filterTahunBar').value = tahun;
    });

  // Helper function
  function ucfirst(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
  }
</script>
@endsection