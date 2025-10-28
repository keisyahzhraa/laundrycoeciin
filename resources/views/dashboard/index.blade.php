@extends('layouts.app')

@section('title', 'Dashboard | Coeciin')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<main class="p-8 min-h-screen" style="background-color: #EFFCFF;">
  <!-- Judul -->
  <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

  <!-- Statistik -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Pendapatan -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow flex items-start justify-between">
      <div>
        <p class="text-base text-gray-600 mb-4">Total Pendapatan</p>
        <h3 class="text-4xl font-bold text-gray-900">Rp 6.000.000</h3>
      </div>
      <div class="bg-sky-400 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
        </svg>
      </div>
    </div>

    <!-- Total Pengeluaran -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow flex items-start justify-between">
      <div>
        <p class="text-base text-gray-600 mb-4">Total Pengeluaran</p>
        <h3 class="text-4xl font-bold text-gray-900">Rp 300.000</h3>
      </div>
      <div class="bg-sky-100 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
        </svg>
      </div>
    </div>

    <!-- Total Pesanan -->
    <div class="bg-white rounded-2xl p-6 shadow flex justify-between items-start">
      <div>
        <p class="text-sm text-gray-600 mb-3">Total<br>Pesanan</p>
        <h4 class="text-4xl font-bold text-gray-900">62</h4>
      </div>
      <div class="bg-indigo-100 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
      </div>
    </div>

    <!-- Total Selesai -->
    <div class="bg-white rounded-2xl p-6 shadow flex justify-between items-start">
      <div>
        <p class="text-sm text-gray-600 mb-3">Total<br>Selesai</p>
        <h4 class="text-4xl font-bold text-gray-900">30</h4>
      </div>
      <div class="bg-green-100 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
      </div>
    </div>

    <!-- Total Dikerjakan -->
    <div class="bg-white rounded-2xl p-6 shadow flex justify-between items-start">
      <div>
        <p class="text-sm text-gray-600 mb-3">Total<br>Dikerjakan</p>
        <h4 class="text-4xl font-bold text-gray-900">12</h4>
      </div>
      <div class="bg-yellow-100 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
    </div>

    <!-- Total Belum Dikerjakan -->
    <div class="bg-white rounded-2xl p-6 shadow flex justify-between items-start">
      <div>
        <p class="text-sm text-gray-600 mb-3">Total Belum<br>Dikerjakan</p>
        <h4 class="text-4xl font-bold text-gray-900">20</h4>
      </div>
      <div class="bg-red-100 p-3 rounded-xl">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </div>
    </div>
  </div>

  <!-- Grafik -->
  <div class="bg-white rounded-2xl p-6 shadow mb-8">
    <h3 class="text-lg font-semibold text-gray-700 mb-4">Grafik Pendapatan Per Hari</h3>
    <canvas id="chartPendapatan"></canvas>
  </div>

  <!-- List Pesanan (Pesanan Mendekati Deadline) -->
  <div class="bg-white rounded-2xl p-6 shadow">
    <div class="flex items-center justify-between mb-6">
      <div class="flex items-center gap-3">
        <div class="bg-blue-500 p-3 rounded-xl">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </div>
        <div>
          <h3 class="text-xl font-semibold text-gray-800">List Pesanan Mendekati Deadline</h3>
          <p class="text-sm text-gray-500">Total 6 pesanan</p>
        </div>
      </div>
      <div class="flex items-center gap-3">
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left">
        <thead>
          <tr class="bg-gray-50">
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Nama Pelanggan</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Barang Laundry</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Tanggal Masuk</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Tanggal Selesai</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Jenis</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Total Berat</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Total Harga</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Status</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-4 text-gray-800 font-medium">Kosiyah</td>
            <td class="px-4 py-4">
              <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-lg text-sm font-medium">Pakaian</span>
            </td>
            <td class="px-4 py-4 text-gray-600">12/05/25</td>
            <td class="px-4 py-4 text-gray-600">12/05/25</td>
            <td class="px-4 py-4">
              <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm font-medium">Regular</span>
            </td>
            <td class="px-4 py-4 text-gray-600">10 kg</td>
            <td class="px-4 py-4 text-gray-600">Rp 10,000</td>
            <td class="px-4 py-4">
              <span class="bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-sm font-medium">Belum</span>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-4 text-gray-800 font-medium">Fallanan</td>
            <td class="px-4 py-4">
              <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-lg text-sm font-medium">Sepatu</span>
            </td>
            <td class="px-4 py-4 text-gray-600">12/05/25</td>
            <td class="px-4 py-4 text-gray-600">12/05/25</td>
            <td class="px-4 py-4">
              <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm font-medium">Regular</span>
            </td>
            <td class="px-4 py-4 text-gray-600">10 kg</td>
            <td class="px-4 py-4 text-gray-600">Rp 10,000</td>
            <td class="px-4 py-4">
              <span class="bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-lg text-sm font-medium">Disetrika</span>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-4 text-gray-800 font-medium">Puti</td>
            <td class="px-4 py-4">
              <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-lg text-sm font-medium">Celana</span>
            </td>
            <td class="px-4 py-4 text-gray-600">12/05/25</td>
            <td class="px-4 py-4 text-gray-600">12/05/25</td>
            <td class="px-4 py-4">
              <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm font-medium">Regular</span>
            </td>
            <td class="px-4 py-4 text-gray-600">10 kg</td>
            <td class="px-4 py-4 text-gray-600">Rp 10,000</td>
            <td class="px-4 py-4">
              <span class="bg-green-100 text-green-700 px-3 py-1.5 rounded-lg text-sm font-medium">Selesai</span>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-4 text-gray-800 font-medium">Budi Santoso</td>
            <td class="px-4 py-4">
              <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-lg text-sm font-medium">Bed Cover</span>
            </td>
            <td class="px-4 py-4 text-gray-600">13/05/25</td>
            <td class="px-4 py-4 text-gray-600">15/05/25</td>
            <td class="px-4 py-4">
              <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-lg text-sm font-medium">Express</span>
            </td>
            <td class="px-4 py-4 text-gray-600">5 kg</td>
            <td class="px-4 py-4 text-gray-600">Rp 15,000</td>
            <td class="px-4 py-4">
              <span class="bg-blue-100 text-blue-700 px-3 py-1.5 rounded-lg text-sm font-medium">Dicuci</span>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-4 text-gray-800 font-medium">Siti Nurhaliza</td>
            <td class="px-4 py-4">
              <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-lg text-sm font-medium">Selimut</span>
            </td>
            <td class="px-4 py-4 text-gray-600">14/05/25</td>
            <td class="px-4 py-4 text-gray-600">16/05/25</td>
            <td class="px-4 py-4">
              <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm font-medium">Regular</span>
            </td>
            <td class="px-4 py-4 text-gray-600">8 kg</td>
            <td class="px-4 py-4 text-gray-600">Rp 12,000</td>
            <td class="px-4 py-4">
              <span class="bg-yellow-100 text-yellow-700 px-3 py-1.5 rounded-lg text-sm font-medium">Dijemur</span>
            </td>
          </tr>
          <tr class="hover:bg-gray-50">
            <td class="px-4 py-4 text-gray-800 font-medium">Ahmad Dahlan</td>
            <td class="px-4 py-4">
              <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-lg text-sm font-medium">Karpet</span>
            </td>
            <td class="px-4 py-4 text-gray-600">15/05/25</td>
            <td class="px-4 py-4 text-gray-600">18/05/25</td>
            <td class="px-4 py-4">
              <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-lg text-sm font-medium">Regular</span>
            </td>
            <td class="px-4 py-4 text-gray-600">15 kg</td>
            <td class="px-4 py-4 text-gray-600">Rp 25,000</td>
            <td class="px-4 py-4">
              <span class="bg-red-100 text-red-700 px-3 py-1.5 rounded-lg text-sm font-medium">Belum</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
  // Chart Pendapatan
  const ctx = document.getElementById('chartPendapatan');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['1', '5', '10', '15', '20', '25', '30'],
      datasets: [{
        label: 'Pendapatan (Ribu)',
        data: [20, 40, 60, 80, 50, 90, 70],
        borderColor: '#0ea5e9',
        backgroundColor: 'rgba(14,165,233,0.2)',
        tension: 0.4,
        fill: true,
        pointBackgroundColor: '#0ea5e9',
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
        pointRadius: 4,
        pointHoverRadius: 6
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: true,
          position: 'top'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'Rp ' + value + 'k';
            }
          }
        },
        x: {
          title: {
            display: true,
            text: 'Tanggal'
          }
        }
      }
    }
  });
</script>
@endpush