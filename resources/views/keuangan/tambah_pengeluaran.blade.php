@extends('layouts.app')

@section('title', 'Tambah Pengeluaran | Coeciin')
@section('page_title', 'Manajemen Keuangan')

@section('content')
<main class="p-8 min-h-screen" style="background-color: #EFFCFF;">
  <!-- Header -->
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Manajemen Keuangan</h1>
    <p class="text-gray-500 text-sm mt-1">Tambah data pengeluaran baru ke sistem</p>
  </div>
  
  <!-- Form Card -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    
    <!-- Card Header -->
    <div class="px-6 py-5 flex items-center space-x-3 border-b border-gray-200">
      <div class="bg-blue-500 rounded-xl p-2.5">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
      <h2 class="text-xl font-bold text-gray-800">Tambah Pengeluaran</h2>
    </div>

    <!-- Form Content -->
    <form action="{{ route('keuangan.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
      @csrf
      
      <!-- Section: Informasi Utama -->
      <div class="mb-8">
        <div class="flex items-center space-x-3 mb-6">
          <div class="bg-blue-100 rounded-lg p-2">
            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
              <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-800">Informasi Utama</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Tanggal Pengeluaran -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Tanggal Pengeluaran <span class="text-red-500">*</span>
            </label>
            <input 
              type="date" 
              name="tanggal_pengeluaran"
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all"
              required>
          </div>

          <!-- Nominal Pengeluaran -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Nominal Pengeluaran <span class="text-red-500">*</span>
            </label>
            <input 
              type="text" 
              name="nominal_pengeluaran"
              placeholder="Masukkan nominal pengeluaran" 
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all placeholder:text-gray-400"
              required>
          </div>

          <!-- Kategori Pengeluaran -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Kategori Pengeluaran <span class="text-red-500">*</span>
            </label>
            <select 
              name="kategori_pengeluaran"
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-gray-700"
              required>
              <option value="">Pilih kategori pengeluaran</option>
              <option value="operasional">Operasional</option>
              <option value="bahan_baku">Bahan Baku</option>
              <option value="gaji">Gaji Karyawan</option>
              <option value="utilitas">Utilitas (Listrik, Air, dll)</option>
              <option value="maintenance">Maintenance</option>
              <option value="lainnya">Lainnya</option>
            </select>
          </div>

          <!-- Metode Pembayaran -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Metode Pembayaran <span class="text-red-500">*</span>
            </label>
            <select 
              name="metode_pembayaran"
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all text-gray-700"
              required>
              <option value="">Pilih metode pembayaran</option>
              <option value="tunai">Tunai</option>
              <option value="transfer">Transfer Bank</option>
              <option value="e-wallet">E-Wallet</option>
              <option value="kartu_debit">Kartu Debit</option>
              <option value="kartu_kredit">Kartu Kredit</option>
            </select>
          </div>
        </div>
      </div>

      <!-- Divider Line -->
      <div class="border-t border-gray-200 my-8"></div>

      <!-- Section: Detail Tambahan -->
      <div class="mb-8">
        <div class="flex items-center space-x-3 mb-6">
          <div class="bg-purple-100 rounded-lg p-2">
            <svg class="w-5 h-5 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
          </div>
          <h3 class="text-lg font-bold text-gray-800">Detail Tambahan</h3>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Penerima -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Dibayarkan Kepada / Penerima <span class="text-red-500">*</span>
            </label>
            <input 
              type="text" 
              name="penerima"
              placeholder="Masukkan nama penerima" 
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all placeholder:text-gray-400"
              required>
          </div>

          <!-- Keterangan -->
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Keterangan Pengeluaran <span class="text-gray-400 text-xs font-normal">(opsional)</span>
            </label>
            <input 
              type="text" 
              name="keterangan"
              placeholder="Tuliskan keterangan pengeluaran" 
              class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-all placeholder:text-gray-400">
          </div>

          <!-- Bukti Lampiran -->
          <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Bukti / Lampiran <span class="text-red-500">*</span>
            </label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-400 hover:bg-blue-50 transition-all cursor-pointer">
              <input 
                type="file" 
                name="bukti_lampiran"
                id="file-upload"
                class="hidden"
                accept="image/*,.pdf"
                onchange="updateFileName(this)"
                required>
              <label for="file-upload" class="cursor-pointer">
                <div class="flex flex-col items-center">
                  <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                  </svg>
                  <p class="text-sm font-medium text-gray-600 mb-1">Klik untuk unggah bukti pengeluaran</p>
                  <p class="text-xs text-gray-400">PNG, JPG, PDF (Max. 5MB)</p>
                  <p id="file-name" class="text-sm text-blue-600 font-medium mt-3"></p>
                </div>
              </label>
            </div>
          </div>
        </div>
      </div>

      <!-- Buttons -->
      <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
        <a href="{{ route('dashboard') }}" 
           class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-all">
          Batal
        </a>
        <button 
          type="submit" 
          class="px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg transition-all shadow-sm hover:shadow-md">
          Simpan Pengeluaran
        </button>
      </div>
    </form>
  </div>
</main>

<script>
function updateFileName(input) {
  const fileName = input.files[0]?.name;
  const fileNameElement = document.getElementById('file-name');
  if (fileName) {
    fileNameElement.textContent = '📄 ' + fileName;
  } else {
    fileNameElement.textContent = '';
  }
}
</script>
@endsection