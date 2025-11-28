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
        <h3 class="text-4xl font-bold text-gray-900" data-stat="pendapatan">Rp 0</h3>
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
        <h3 class="text-4xl font-bold text-gray-900" data-stat="pengeluaran">Rp 0</h3>
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
        <h4 class="text-4xl font-bold text-gray-900" data-stat="pesanan">0</h4>
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
        <h4 class="text-4xl font-bold text-gray-900" data-stat="selesai">0</h4>
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
        <h4 class="text-4xl font-bold text-gray-900" data-stat="dikerjakan">0</h4>
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
        <h4 class="text-4xl font-bold text-gray-900" data-stat="belum">0</h4>
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

  <!-- List Pesanan Mendekati Deadline -->
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
          <p class="text-sm text-gray-500">Total {{ $pesananDeadline->count() }} pesanan</p>
        </div>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left" id="tableDeadline">
        <thead>
          <tr class="bg-gray-50">
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Nama Pelanggan</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">No. Telepon</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Barang Laundry</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Tanggal Masuk</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Tanggal Selesai</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Jenis Layanan</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Total Berat</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Total Harga</th>
            <th class="px-4 py-3 text-sm font-semibold text-gray-700">Status</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          {{-- Baris akan diisi lewat JS --}}
        </tbody>
      </table>
    </div>
  </div>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Statistik
  const stats = {
    pendapatan: {{ $totalPendapatan }},
    pengeluaran: {{ $totalPengeluaran }},
    pesanan: {{ $totalPesanan }},
    selesai: {{ $totalSelesai }},
    dikerjakan: {{ $totalDikerjakan }},
    belum: {{ $totalBelumDikerjakan }}
  };

  Object.keys(stats).forEach(key => {
    const el = document.querySelector(`[data-stat="${key}"]`);
    if(el) {
      el.textContent = (key.includes('pendapatan') || key.includes('pengeluaran'))
        ? 'Rp ' + stats[key].toLocaleString()
        : stats[key];
    }
  });

  // Chart Pendapatan
  const ctx = document.getElementById('chartPendapatan');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: @json($labels),
      datasets: [{
        label: 'Pendapatan (Rp)',
        data: @json($chartData),
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
      plugins: { legend: { display: true, position: 'top' } },
      scales: {
        y: { beginAtZero: true, ticks: { callback: value => 'Rp ' + value.toLocaleString() } },
        x: { title: { display: true, text: 'Tanggal' } }
      }
    }
  });

    // Tabel Pesanan Mendekati Deadline
    // Fungsi format tanggal dd-mm-yyyy
    const formatDate = dateStr => {
        const d = new Date(dateStr);
        const day = String(d.getDate()).padStart(2,'0');
        const month = String(d.getMonth()+1).padStart(2,'0');
        const year = d.getFullYear();
        return `${day}-${month}-${year}`;
    };

    // Mapping warna jenis layanan
    window.layananColors = {
        "Satuan": "bg-green-100 text-green-700",
        "Regular": "bg-yellow-100 text-yellow-700",
        "Express": "bg-purple-100 text-purple-700",
        "Super Express/Kilat": "bg-red-100 text-red-700",
        "": "bg-blue-100 text-blue-700"
    };

    // Mapping warna status pesanan
    window.statusColors = {
        "Pending": "bg-red-100 text-red-800",
        "Proses": "bg-blue-100 text-blue-800",
        "Selesai": "bg-green-100 text-green-800"
    };
    
    // Tabel Pesanan Mendekati Deadline
    const tbody = document.querySelector('#tableDeadline tbody');
    const pesananDeadline = @json($pesananDeadline);

    tbody.innerHTML = ''; // Kosongkan dulu

    pesananDeadline.forEach(p => {
      const tr = document.createElement('tr');

      // Ambil warna berdasarkan jenis layanan & status
      const layananColor = window.layananColors[p.layanan?.jenis_layanan] ?? "bg-gray-100 text-gray-700";
      const statusColor = window.statusColors[p.status_pesanan] ?? "bg-gray-100 text-gray-700";

      tr.classList.add('hover:bg-gray-50');

      tr.innerHTML = `
          <td class="px-4 py-4 text-gray-800 font-medium">${p.nama_pelanggan}</td>
          <td class="px-4 py-4 text-gray-600">${p.nomor_telephone ?? '-'}</td>

          <!-- Barang laundry tetap ungu seperti sebelumnya -->
          <td class="px-4 py-4">
              <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-lg text-sm font-medium">
                  ${p.barang_laundry}
              </span>
          </td>

          <td class="px-4 py-4 text-gray-600">${formatDate(p.tanggal_pesanan)}</td>
          <td class="px-4 py-4 text-gray-600">${formatDate(p.tanggal_selesai)}</td>

          <!-- Jenis Layanan (pakai warna dari mapping) -->
          <td class="px-4 py-4">
              <span class="${layananColor} px-3 py-1 rounded-lg text-sm font-medium">
                  ${p.layanan?.jenis_layanan ?? '-'}
              </span>
          </td>

          <td class="px-4 py-4 text-gray-600">${parseFloat(p.berat_cucian).toFixed(2)} kg</td>
          <td class="px-4 py-4 text-gray-600">Rp ${Number(p.total_harga).toLocaleString()}</td>

          <!-- Status (pakai warna dari mapping) -->
          <td class="px-4 py-4">
              <span class="${statusColor} px-3 py-1.5 rounded-lg text-sm font-medium">
                  ${p.status_pesanan}
              </span>
          </td>
      `;

      tbody.appendChild(tr);
  });

});
</script>
@endpush
