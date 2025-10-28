<!-- Navbar Component - navbar.blade.php -->
<nav id="navbar" class="bg-white/80 backdrop-blur-md border-b border-gray-200/50 fixed top-0 right-0 z-40 transition-all duration-300 ease-in-out shadow-sm" style="left: 16rem;">
    <div class="px-6 py-4">
        <div class="flex items-center justify-between">
            <!-- Left Side: Hamburger & Search -->
            <div class="flex items-center space-x-4 flex-1">
                <!-- Hamburger Menu (Mobile) -->
                <button id="sidebarToggle" class="lg:hidden text-gray-600 hover:text-blue-600 hover:bg-blue-50 p-2.5 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Search Bar -->
                <div class="relative flex-1 max-w-xl">
                    <input type="text" 
                           placeholder="Cari pesanan, pelanggan, atau transaksi..." 
                           class="w-full px-5 py-3 pl-12 bg-gradient-to-r from-gray-50 to-gray-100/50 border border-gray-200/80 rounded-2xl text-sm text-gray-700 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/30 focus:border-blue-400 focus:bg-white transition-all duration-200 hover:border-gray-300">
                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Right Side: User Profile Card -->
            <div class="flex items-center">
                <!-- User Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <!-- Profile Button/Card -->
                    <button @click="open = !open" 
                            @click.away="open = false"
                            class="flex items-center space-x-3 hover:bg-gray-50 px-2 py-1.5 rounded-xl transition-all duration-200 focus:outline-none group">
                        <!-- Avatar -->
                        @if(Auth::check())
                            @if(Auth::user()->profile_image)
                                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                                     alt="Profile" 
                                     class="w-9 h-9 rounded-full object-cover">
                            @else
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-pink-400 via-pink-500 to-pink-600 flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr(Auth::user()->nama_lengkap ?? Auth::user()->name ?? 'A', 0, 1)) }}
                                </div>
                            @endif
                        @endif

                        <!-- User Info -->
                        <div class="hidden md:flex flex-col items-start">
                            @if(Auth::check())
                                <p class="text-sm font-semibold text-gray-900 leading-tight">
                                    {{ Str::limit(Auth::user()->nama_lengkap ?? Auth::user()->name, 15) }}
                                </p>
                                <p class="text-xs text-gray-500 leading-tight">
                                    {{ ucfirst(Auth::user()->role ?? 'Admin') }}
                                </p>
                            @endif
                        </div>

                        <!-- Chevron Icon -->
                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 hidden md:block" 
                             :class="{ 'rotate-180': open }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Panel -->
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="transform opacity-0 scale-95 -translate-y-2"
                         x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="transform opacity-0 scale-95 -translate-y-2"
                         class="absolute right-0 top-full mt-3 w-72 bg-white rounded-2xl shadow-xl border border-gray-200/60 overflow-hidden z-50"
                         style="display: none;">
                        
                        <!-- User Info in Dropdown -->
                        <div class="px-5 py-4 bg-gradient-to-br from-blue-50 to-indigo-50/50 border-b border-gray-200/60">
                            @if(Auth::check())
                                <div class="flex items-center space-x-3">
                                    @if(Auth::user()->profile_image)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" 
                                             alt="Profile" 
                                             class="w-12 h-12 rounded-xl border-2 border-white object-cover shadow-sm">
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-pink-400 via-pink-500 to-pink-600 flex items-center justify-center text-white font-bold shadow-sm">
                                            {{ strtoupper(substr(Auth::user()->nama_lengkap ?? Auth::user()->name ?? 'A', 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-gray-800 truncate">
                                            {{ Auth::user()->nama_lengkap ?? Auth::user()->name }}
                                        </p>
                                        <p class="text-xs text-gray-600 truncate">
                                            {{ Auth::user()->email }}
                                        </p>
                                        <div class="flex items-center gap-1.5 mt-1">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                            <span class="text-xs text-green-600 font-medium">{{ ucfirst(Auth::user()->role ?? 'Admin') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Dropdown Menu Items -->
                        <div class="py-2 px-2">
                            <a href="{{ route('admin.profile') }}" 
                               class="flex items-center px-3 py-3 text-sm text-gray-700 hover:bg-blue-50 rounded-xl transition-all duration-200 group">
                                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-50 to-blue-100 group-hover:from-blue-100 group-hover:to-blue-200 flex items-center justify-center mr-3 transition-all">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <span class="font-medium">Profil Saya</span>
                            </a>
                        </div>

                        <!-- Divider -->
                        <div class="border-t border-gray-200/60 my-2"></div>

                        <!-- Logout -->
                        <div class="px-2 pb-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center w-full px-3 py-3 text-sm text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200 group">
                                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-red-50 to-red-100 group-hover:from-red-100 group-hover:to-red-200 flex items-center justify-center mr-3 transition-all">
                                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript untuk Navbar responsif dengan Sidebar -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('navbar');
        const sidebar = document.getElementById('sidebar');
        const sidebarToggleDesktop = document.getElementById('sidebarToggleDesktop');

        // Function untuk update posisi navbar
        function updateNavbarPosition() {
            if (window.innerWidth >= 1024) { // Desktop
                if (sidebar && sidebar.classList.contains('sidebar-collapsed')) {
                    navbar.style.left = '5rem'; // 80px
                } else {
                    navbar.style.left = '16rem'; // 256px
                }
            } else { // Mobile
                navbar.style.left = '0';
            }
        }

        // Update saat sidebar toggle (Desktop)
        if (sidebarToggleDesktop) {
            sidebarToggleDesktop.addEventListener('click', function() {
                setTimeout(updateNavbarPosition, 50);
            });
        }

        // Update saat window resize
        window.addEventListener('resize', updateNavbarPosition);

        // Initial update
        updateNavbarPosition();
        
        // Load saved state dan update navbar
        if (window.innerWidth >= 1024) {
            const savedState = localStorage.getItem('sidebarCollapsed');
            if (savedState === 'true') {
                navbar.style.left = '5rem';
            }
        }
    });
</script>