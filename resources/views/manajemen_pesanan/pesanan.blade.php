<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pesanan - Coecin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr Month Select Plugin CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <!-- Flatpickr Month Select Plugin JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
</head>
<body style="background-color: #EFFCFF;">
    
    <!-- Include Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Main Content -->
    <div id="mainContent" class="transition-all duration-300 ease-in-out" style="margin-left: 16rem;">
        
        <!-- Include Navbar -->
        @include('layouts.navbar')
        
        <!-- Page Content -->
        <div class="p-4 md:p-8" style="margin-top: 5rem;">
            
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">Manajemen Pesanan</h1>
                <p class="text-sm text-gray-500">Kelola semua pesanan laundry Anda</p>
            </div>

            <!-- Card Container -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                
                <!-- Card Header -->
                <div class="px-4 md:px-8 py-6 border-b-2 border-gray-100 bg-white">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl md:text-2xl font-bold text-gray-800">List Pesanan</h2>
                                <p class="text-sm text-gray-500 mt-0.5">Total 6 pesanan</p>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                            <!-- Filter Bulan & Tahun dengan Flatpickr -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       id="monthYearPicker" 
                                       placeholder="Pilih Bulan & Tahun"
                                       class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 cursor-pointer"
                                       readonly>
                            </div>
                            
                            <button class="px-6 py-3 bg-blue-500 text-white rounded-xl text-sm font-semibold hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Tambah Pesanan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto overflow-y-auto" style="max-height: 600px;">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 sticky top-0 z-10">
                            <tr>
                                <th scope="col" class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">
                                    Nama Pelanggan
                                </th>
                                <th scope="col" class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">
                                    Barang Laundry
                                </th>
                                <th scope="col" class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">
                                    Tanggal Masuk
                                </th>
                                <th scope="col" class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">
                                    Tanggal Selesai
                                </th>
                                <th scope="col" class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">
                                    Jenis
                                </th>
                                <th scope="col" class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">
                                    Total Berat
                                </th>
                                <th scope="col" class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">
                                    Total Harga
                                </th>
                                <th scope="col" class="px-4 md:px-6 py-4 text-left text-xs font-bold text-gray-700 tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-4 md:px-6 py-4 text-center text-xs font-bold text-gray-700 tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            
                            <!-- Row 1 -->
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">Kosiyah</div>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-lg">
                                        Pakaian
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    12/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    12/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg">
                                        Regular
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    10 kg
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    Rp 10,000
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800 shadow-sm">
                                        Belum
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button class="p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 2 -->
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">Fallanan</div>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-lg">
                                        Sepatu
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    12/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    12/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg">
                                        Regular
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    10 kg
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    Rp 10,000
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800 shadow-sm">
                                        Disetrika
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button class="p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 3 -->
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">Puti</div>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-lg">
                                        Celana
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    12/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    12/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg">
                                        Regular
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    10 kg
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    Rp 10,000
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-800 shadow-sm">
                                        Selesai
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button class="p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 4 -->
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">Budi Santoso</div>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-lg">
                                        Bed Cover
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    13/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    15/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-lg">
                                        Express
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    5 kg
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    Rp 15,000
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-blue-100 text-blue-800 shadow-sm">
                                        Dicuci
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button class="p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 5 -->
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">Siti Nurhaliza</div>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-lg">
                                        Selimut
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    14/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    16/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg">
                                        Regular
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    8 kg
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    Rp 12,000
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-800 shadow-sm">
                                        Dijemur
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button class="p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Row 6 -->
                            <tr class="hover:bg-gray-50 transition-all duration-200">
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">Ahmad Dahlan</div>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-purple-700 bg-purple-100 rounded-lg">
                                        Karpet
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    15/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    18/05/25
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-lg">
                                        Regular
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    15 kg
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    Rp 25,000
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1.5 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-800 shadow-sm">
                                        Belum
                                    </span>
                                </td>
                                <td class="px-4 md:px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="p-2 text-amber-600 hover:text-amber-800 hover:bg-amber-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button class="p-2 text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-all duration-200 group">
                                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk responsif Main Content dengan Sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainContent = document.getElementById('mainContent');
            const sidebar = document.getElementById('sidebar');
            const sidebarToggleDesktop = document.getElementById('sidebarToggleDesktop');

            // Function untuk update margin main content
            function updateMainContentMargin() {
                if (window.innerWidth >= 1024) { // Desktop
                    if (sidebar && sidebar.classList.contains('sidebar-collapsed')) {
                        mainContent.style.marginLeft = '5rem'; // 80px
                    } else {
                        mainContent.style.marginLeft = '16rem'; // 256px
                    }
                } else { // Mobile
                    mainContent.style.marginLeft = '0';
                }
            }

            // Update saat sidebar toggle (Desktop)
            if (sidebarToggleDesktop) {
                sidebarToggleDesktop.addEventListener('click', function() {
                    setTimeout(updateMainContentMargin, 50);
                });
            }

            // Update saat window resize
            window.addEventListener('resize', updateMainContentMargin);

            // Initial update
            updateMainContentMargin();
            
            // Load saved state dan update main content
            if (window.innerWidth >= 1024) {
                const savedState = localStorage.getItem('sidebarCollapsed');
                if (savedState === 'true') {
                    setTimeout(updateMainContentMargin, 100);
                }
            }
        });
    </script>

    <!-- Initialize Flatpickr -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#monthYearPicker", {
                plugins: [
                    new monthSelectPlugin({
                        shorthand: false,
                        dateFormat: "F Y",
                        altFormat: "F Y",
                    })
                ],
                locale: "id",
                defaultDate: new Date(),
            });
        });
    </script>

</body>
</html>