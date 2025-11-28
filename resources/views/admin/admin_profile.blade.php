<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - Coeciin</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js untuk interaktivitas -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body style="background-color: #EFFCFF;">

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div id="mainContent" class="transition-all duration-300 ease-in-out" style="margin-left: 16rem;">
        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Content Area -->
        <main class="p-8" style="margin-top: 5rem;">
            <div class="max-w-6xl mx-auto">
                
                <!-- Header Card dengan Info Admin -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg p-8 mb-6">
                    <div class="flex items-center justify-between flex-wrap gap-4">
<div class="flex items-center gap-5 text-white">

    <!-- Avatar -->
    <img src="{{ $user->foto 
        ? asset('storage/' . $user->foto) 
        : 'https://ui-avatars.com/api/?name=' . urlencode(trim(($user->nama_depan ?? 'User') . ' ' . ($user->nama_belakang ?? ''))) . '&size=200&background=3b82f6&color=fff'
    }}"
    class="w-24 h-24 rounded-full border-4 border-white shadow-lg">

    <!-- Nama + Role -->
    <div class="flex flex-col justify-center leading-tight">
        @php
            $namaDepan = $user->nama_depan;
            $namaBelakang = $user->nama_belakang;
        @endphp

        <h1 class="text-3xl font-bold">
            @if ($namaDepan || $namaBelakang)
                {{ $namaDepan ?? '' }} {{ $namaBelakang ?? '' }}
            @else
                <span class="text-blue-100 italic">Nama belum diisi</span>
            @endif
        </h1>

        <span class="flex items-center text-blue-200 text-sm mt-1">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
            </svg>
            Admin
        </span>
    </div>

</div>

                        
                        <!-- Kontak Info -->
                        <div class="text-right text-white">
                            <p class="mb-2 flex items-center justify-end space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                                <span id="headerEmail">{{ $user->email }}</span>
                            </p>
                            <p class="flex items-center justify-end space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                                <span id="headerTelepon">{{ $user->no_telepon ?? 'Belum terdaftar' }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Alert Success (Hidden by default) -->
                <div id="successAlert" class="hidden bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg animate-fade-in">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-700 font-medium">Profil berhasil diperbarui!</p>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <form id="profileForm"
                          method="POST"
                          action="{{ route('admin.profile.update') }}"
                          enctype="multipart/form-data"
                          onsubmit="validateForm(event)">

                          @csrf
                          @method('PUT')

                        <!-- Info Personal Section -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 pb-3 border-b-2 border-gray-200 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Info Personal
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Nama Depan -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Depan
                                    </label>
                                    <input type="text"
                                           name="nama_depan"
                                           placeholder="Masukkan nama depan"
                                           value="{{ old('nama_depan', $user->nama_depan ?? '') }}"
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg 
                                                  focus:outline-none focus:ring-2 focus:ring-blue-500 
                                                  focus:border-transparent transition">
                                </div>

                                <!-- Nama Belakang -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Belakang</label>
                                    <input type="text"
                                            name="nama_belakang"
                                            placeholder="Masukkan nama belakang"
                                            value="{{ old('nama_belakang', $user->nama_belakang ?? '') }}"
                                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg 
                                                    focus:outline-none focus:ring-2 focus:ring-blue-500 
                                                    focus:border-transparent transition">
                                </div>

                                <!-- Nomor Telepon -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                    <input type="text" 
                                        id="nomorTelepon"
                                        name="no_telepon"
                                        value="{{ old('no_telepon', $user->no_telepon ?? '') }}"
                                        placeholder="08xxxxxxxxxx"
                                        pattern="^08[0-9]{8,11}$"
                                        title="Nomor harus dimulai dengan 08 dan berisi 10–13 digit angka."
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                </div>
                            </div>
                        </div>

                        <!-- Autentifikasi Section -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 pb-3 border-b-2 border-gray-200 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Autentifikasi
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <!-- Username -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Username <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                            name="username"
                                            placeholder="Masukkan nama username"
                                            value="{{ old('username', $user->username) }}"
                                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg 
                                                    focus:outline-none focus:ring-2 focus:ring-blue-500 
                                                    focus:border-transparent transition">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email"
                                            name="email"
                                            placeholder="Masukkan nama email"
                                            value="{{ old('email', $user->email) }}"
                                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg 
                                                    focus:outline-none focus:ring-2 focus:ring-blue-500 
                                                    focus:border-transparent transition">
                                </div>
                            </div>

                            <!-- Password Section -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                <p class="text-sm text-blue-700 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    Kosongkan jika tidak ingin mengubah password
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                    <input type="password" 
                                           id="password"
                                           name="password" 
                                           placeholder="Min. 6 karakter" 
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                                    <input type="password" 
                                           id="passwordConfirmation"
                                           name="password_confirmation" 
                                           placeholder="Ulangi password baru" 
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                </div>
                            </div>
                        </div>

                        <!-- Upload Foto Profile -->
                        <div class="mb-8">
                            <h2 class="text-xl font-bold text-gray-800 mb-6 pb-3 border-b-2 border-gray-200 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Foto Profile
                            </h2>
                            
                            <div class="flex items-start space-x-6">
                                <!-- Preview Image -->
                                <div class="flex-shrink-0">
                                    <img
                                        id="imagePreview"
                                        class="w-24 h-24 rounded-full border-4 border-white shadow-lg"
                                        src="{{ 
                                            $user->foto 
                                                ? asset('storage/' . $user->foto)
                                                : 'https://ui-avatars.com/api/?name=' . urlencode(trim(($user->nama_depan ?? '') . ' ' . ($user->nama_belakang ?? ''))) . '&size=200&background=3b82f6&color=fff'
                                        }}"
                                    >
                                </div>

                                <!-- Upload Input -->
                                <div class="flex-1">
                                    <input type="file" 
                                           name="foto" 
                                           id="profileImageInput"
                                           accept="image/jpeg,image/png,image/jpg"
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                                    <p class="text-xs text-gray-500 mt-2">Format: JPG, JPEG, PNG. Max: 2MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
                            <button type="reset" 
                                    onclick="resetForm(event)"
                                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Reset
                            </button>
                            <button type="submit" 
                                    class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition font-medium shadow-lg hover:shadow-xl flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </main>
    </div>

    <!-- JavaScript -->
    <script>
        // Preview foto saat upload
        document.getElementById('profileImageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const imgPreview = document.getElementById('imagePreview');
                imgPreview.src = URL.createObjectURL(file);
            }
        });

        // Validasi form sebelum submit
        function validateForm(event) {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('passwordConfirmation').value;

            if (password && password !== confirm) {
                alert('Password dan konfirmasi password tidak cocok!');
                event.preventDefault();
                return false;
            }

            if (password && password.length < 6) {
                alert('Password minimal 6 karakter!');
                event.preventDefault();
                return false;
            }

            return true; // lanjut submit ke backend
        }

        // Perbaikan sidebar responsive
        document.addEventListener('DOMContentLoaded', () => {
            const mainContent = document.getElementById('mainContent');
            const sidebar = document.getElementById('sidebar');

            function updateMargin() {
                if (window.innerWidth >= 1024) {
                    mainContent.style.marginLeft = sidebar.classList.contains('sidebar-collapsed')
                        ? '5rem'
                        : '16rem';
                } else {
                    mainContent.style.marginLeft = '0';
                }
            }

            const sidebarToggle = document.getElementById('sidebarToggleDesktop');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', () => setTimeout(updateMargin, 50));
            }

            window.addEventListener('resize', updateMargin);
            updateMargin();

            // Pantau perubahan class sidebar
            if (sidebar) {
                const observer = new MutationObserver(() => updateMargin());
                observer.observe(sidebar, { attributes: true, attributeFilter: ['class'] });
            }
        });
    </script>

    <script>
    function resetForm(event) {
        event.preventDefault();

        if (!confirm('Yakin ingin mereset semua perubahan?')) return;

        const form = document.getElementById('profileForm');
        form.reset();

        // Hapus pesan error HTML5
        document.getElementById('nomorTelepon').setCustomValidity('');

        // Reset foto kembali ke default backend
        document.getElementById('imagePreview').src =
            "{{ 
                $user->foto 
                    ? asset('storage/' . $user->foto) 
                    : 'https://ui-avatars.com/api/?name=' . urlencode(trim(($user->nama_depan ?? 'User') . ' ' . ($user->nama_belakang ?? ''))) . '&size=200&background=e5e7eb&color=6b7280'
            }}";

        document.getElementById('profileImageInput').value = '';
    }
    </script>
</body>
</html>