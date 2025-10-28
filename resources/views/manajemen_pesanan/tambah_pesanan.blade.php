<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pesanan - Coociin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body style="background-color: #EFFCFF;">
    <!-- Include Sidebar -->
    @include('layouts.sidebar')

    <!-- Include Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <main id="mainContent" class="transition-all duration-300 ease-in-out pt-20" style="margin-left: 16rem;">
        <div class="p-8">
            <!-- Page Title -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Pesanan</h1>
                <p class="text-sm text-gray-500 mt-1">Tambah pesanan baru ke sistem</p>
            </div>
            
            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl p-10 border border-gray-100">
                <form action="#" method="POST">
                    @csrf
                    
                    <!-- Tambah Pesanan Header -->
                    <div class="mb-8 pb-6 border-b-2 border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </div>
                            Tambah Pesanan
                        </h3>
                    </div>
                    
                    <!-- Identitas Pembeli -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            Identitas Pembeli
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nama Pelanggan<span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" 
                                       name="nama_pelanggan"
                                       placeholder="Masukkan nama pelanggan" 
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nomor Telephone <span class="text-gray-400 font-normal">(opsional)</span>
                                </label>
                                <input type="text" 
                                       name="nomor_telepon"
                                       placeholder="Masukkan nomor telephone" 
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                            </div>
                        </div>
                    </div>

                    <!-- Detail Pesanan -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                            Detail Pesanan
                        </h4>
                        
                        <!-- Row 1: Barang Laundry, Berat, Jenis -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Barang Laundry<span class="text-red-500 ml-1">*</span>
                                </label>
                                <select name="barang_laundry" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer"
                                        required>
                                    <option value="" disabled selected>Pilih barang laundry</option>
                                    <option value="pakaian">Pakaian</option>
                                    <option value="sepatu">Sepatu</option>
                                    <option value="celana">Celana</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Berat<span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" 
                                       name="berat"
                                       placeholder="Masukan berat laundry" 
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Jenis<span class="text-red-500 ml-1">*</span>
                                </label>
                                <select name="jenis" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer"
                                        required>
                                    <option value="" disabled selected>Pilih jenis laundry</option>
                                    <option value="regular">Satuan</option>
                                    <option value="regular">Regular</option>
                                    <option value="express">Express</option>
                                    <option value="super_express">Super Express / Kilat</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Row 2: Tanggal Masuk, Tanggal Selesai, Status -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tanggal Masuk<span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" 
                                       name="tanggal_masuk"
                                       placeholder="Masukan Tanggal Masuk"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                       onfocus="(this.type='date')"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tanggal Selesai<span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" 
                                       name="tanggal_selesai"
                                       placeholder="Tanggal selesai"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200"
                                       onfocus="(this.type='date')"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Status<span class="text-red-500 ml-1">*</span>
                                </label>
                                <select name="status" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer"
                                        required>
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                        </div>

                        <!-- Row 3: Keterangan Tambahan (full width) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Keterangan Tambahan <span class="text-gray-400 font-normal">(opsional)</span>
                                </label>
                                <input type="text" 
                                       name="keterangan"
                                       placeholder="Pesan dari pelanggan" 
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200">
                            </div>
                        </div>
                    </div>

                    <!-- Pembayaran -->
                    <div class="mb-8">
                        <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            Pembayaran
                        </h4>
                        
                        <!-- Row 1: Total Harga, Metode, Status -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Total Harga<span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" 
                                       name="total_harga"
                                       placeholder="Masukan total harga" 
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                       required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Metode Pembayaran<span class="text-red-500 ml-1">*</span>
                                </label>
                                <select name="metode_pembayaran" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer"
                                        required>
                                    <option value="" disabled selected>Pilih metode pembayaran</option>
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="ewallet">E-Wallet</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Status Pembayaran<span class="text-red-500 ml-1">*</span>
                                </label>
                                <select name="status_pembayaran" 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200 appearance-none cursor-pointer"
                                        required>
                                    <option value="" disabled selected>Status pembayaran</option>
                                    <option value="belum_lunas">Belum Lunas</option>
                                    <option value="lunas">Lunas</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Row 2: Tanggal Pembayaran -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Tanggal Pembayaran<span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" 
                                       name="tanggal_pembayaran"
                                       placeholder="Tanggal pembayaran"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-200"
                                       onfocus="(this.type='date')"
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end gap-4 pt-6 border-t-2 border-gray-200">
                        <button type="reset" 
                                class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
                            Reset
                        </button>
                        <button type="submit" 
                                class="px-8 py-3 bg-blue-500 text-white font-semibold rounded-xl hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Tambah Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- JavaScript untuk responsive main content -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainContent = document.getElementById('mainContent');
            const sidebar = document.getElementById('sidebar');
            const sidebarToggleDesktop = document.getElementById('sidebarToggleDesktop');

            // Function untuk update margin main content
            function updateMainContentMargin() {
                if (window.innerWidth >= 1024) { // Desktop
                    if (sidebar.classList.contains('sidebar-collapsed')) {
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
                    mainContent.style.marginLeft = '5rem';
                }
            }
        });
    </script>
</body>
</html>