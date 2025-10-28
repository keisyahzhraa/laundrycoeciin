<!-- Sidebar Component - sidebar.blade.php -->
<aside id="sidebar" class="fixed left-0 top-0 h-full bg-gradient-to-b from-white to-gray-50/30 shadow-xl transition-all duration-300 ease-in-out z-50 sidebar-expanded border-r border-gray-200/50">
    <div class="flex flex-col h-full">
        <!-- Logo & Toggle -->
        <div class="px-6 py-6 border-b border-gray-200/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 sidebar-logo">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M5 2C3.895 2 3 2.895 3 4v16c0 1.105.895 2 2 2h14c1.105 0 2-.895 2-2V4c0-1.105-.895-2-2-2H5zm1 2h12v3H6V4zm6 5c-2.761 0-5 2.239-5 5s2.239 5 5 5 5-2.239 5-5-2.239-5-5-5zm0 2c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3z"/>
                            <circle cx="7" cy="5.5" r="0.8" fill="white"/>
                            <circle cx="9.5" cy="5.5" r="0.8" fill="white"/>
                        </svg>
                    </div>
                    <div class="sidebar-text">
                        <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Coeciin</h1>
                        <p class="text-xs text-gray-500 mt-0.5">Laundry Management</p>
                    </div>
                </div>
                <!-- Toggle Button (Desktop) -->
                <button id="sidebarToggleDesktop" class="hidden lg:flex items-center justify-center w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg transition-all duration-200 hover:scale-110">
                    <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menu Items -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1 scrollbar-custom">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="menu-item relative group flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 scale-[1.02]' : 'text-gray-700 hover:bg-gray-100/70 hover:scale-[1.02]' }}">
                <div class="flex items-center justify-center w-5 h-5 flex-shrink-0">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110 duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <span class="font-semibold sidebar-text ml-3 whitespace-nowrap">Dashboard</span>
                @if(request()->routeIs('dashboard'))
                    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full sidebar-text"></div>
                @endif
                <span class="sidebar-tooltip">Dashboard</span>
            </a>

            <!-- Manajemen Pesanan -->
            <div class="mb-1">
                <button onclick="toggleSubmenu('pesanan')" class="menu-item relative group w-full flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 {{ request()->routeIs('pesanan.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 scale-[1.02]' : 'text-gray-700 hover:bg-gray-100/70 hover:scale-[1.02]' }}">
                    <div class="flex items-center justify-center w-5 h-5 flex-shrink-0">
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110 duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="font-semibold sidebar-text ml-3 flex-1 text-left whitespace-nowrap">Manajemen Pesanan</span>
                    <svg id="pesanan-icon" class="w-4 h-4 transition-all duration-300 sidebar-text chevron-icon flex-shrink-0 {{ request()->routeIs('pesanan.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    @if(request()->routeIs('pesanan.*'))
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full sidebar-text"></div>
                    @endif
                    <span class="sidebar-tooltip">Manajemen Pesanan</span>
                </button>
                <!-- Submenu -->
                <div id="pesanan-submenu" class="sidebar-submenu ml-8 mt-1 space-y-1 overflow-hidden transition-all duration-300 {{ request()->routeIs('pesanan.*') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0 hidden' }}">
                    <a href="{{ route('pesanan.tambah') }}" class="flex items-center px-4 py-2.5 text-sm rounded-lg transition-all duration-200 group {{ request()->routeIs('pesanan.tambah') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 hover:translate-x-1' }}">
                        <div class="w-1.5 h-1.5 rounded-full bg-current mr-3 transition-all duration-200 group-hover:scale-150"></div>
                        <span>Tambah Pesanan</span>
                    </a>
                    <a href="{{ route('pesanan.daftar') }}" class="flex items-center px-4 py-2.5 text-sm rounded-lg transition-all duration-200 group {{ request()->routeIs('pesanan.daftar') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 hover:translate-x-1' }}">
                        <div class="w-1.5 h-1.5 rounded-full bg-current mr-3 transition-all duration-200 group-hover:scale-150"></div>
                        <span>Daftar Pesanan</span>
                    </a>
                </div>
            </div>

            <!-- Manajemen Keuangan -->
            <div class="mb-1">
                <button onclick="toggleSubmenu('keuangan')" class="menu-item relative group w-full flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 {{ request()->routeIs('keuangan.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 scale-[1.02]' : 'text-gray-700 hover:bg-gray-100/70 hover:scale-[1.02]' }}">
                    <div class="flex items-center justify-center w-5 h-5 flex-shrink-0">
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110 duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="font-semibold sidebar-text ml-3 flex-1 text-left whitespace-nowrap">Manajemen Keuangan</span>
                    <svg id="keuangan-icon" class="w-4 h-4 transition-all duration-300 sidebar-text chevron-icon flex-shrink-0 {{ request()->routeIs('keuangan.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    @if(request()->routeIs('keuangan.*'))
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full sidebar-text"></div>
                    @endif
                    <span class="sidebar-tooltip">Manajemen Keuangan</span>
                </button>
                <!-- Submenu -->
                <div id="keuangan-submenu" class="sidebar-submenu ml-8 mt-1 space-y-1 overflow-hidden transition-all duration-300 {{ request()->routeIs('keuangan.*') ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0 hidden' }}">
                    <a href="{{ route('keuangan.tambah') }}" class="flex items-center px-4 py-2.5 text-sm rounded-lg transition-all duration-200 group {{ request()->routeIs('keuangan.tambah') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 hover:translate-x-1' }}">
                        <div class="w-1.5 h-1.5 rounded-full bg-current mr-3 transition-all duration-200 group-hover:scale-150"></div>
                        <span>Tambah Pengeluaran</span>
                    </a>
                    <a href="{{ route('keuangan.laporan') }}" class="flex items-center px-4 py-2.5 text-sm rounded-lg transition-all duration-200 group {{ request()->routeIs('keuangan.laporan') ? 'text-blue-600 font-semibold bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 hover:translate-x-1' }}">
                        <div class="w-1.5 h-1.5 rounded-full bg-current mr-3 transition-all duration-200 group-hover:scale-150"></div>
                        <span>Laporan Keuangan</span>
                    </a>
                </div>
            </div>

            <!-- Divider -->
            <div class="my-4 border-t border-gray-200/50"></div>

            <!-- Profil Admin -->
            <a href="{{ route('admin.profile') }}" class="menu-item relative group flex items-center px-4 py-3.5 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.profile') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/30 scale-[1.02]' : 'text-gray-700 hover:bg-gray-100/70 hover:scale-[1.02]' }}">
                <div class="flex items-center justify-center w-5 h-5 flex-shrink-0">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110 duration-200" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <span class="font-semibold sidebar-text ml-3 whitespace-nowrap">Profil Admin</span>
                @if(request()->routeIs('admin.profile'))
                    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-white rounded-l-full sidebar-text"></div>
                @endif
                <span class="sidebar-tooltip">Profil Admin</span>
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-item relative group w-full flex items-center px-4 py-3.5 text-red-500 hover:bg-red-50 rounded-xl transition-all duration-200 hover:scale-[1.02]">
                    <div class="flex items-center justify-center w-5 h-5 flex-shrink-0">
                        <svg class="w-5 h-5 transition-transform group-hover:scale-110 duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <span class="font-semibold sidebar-text ml-3 whitespace-nowrap">Logout</span>
                    <span class="sidebar-tooltip">Logout</span>
                </button>
            </form>
        </nav>

        <!-- User Info Footer (Optional) -->
        <div class="px-4 py-4 border-t border-gray-200/50 sidebar-text">
            @if(Auth::check())
                <div class="flex items-center space-x-3 px-3 py-2.5 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl">
                    @if(Auth::user()->profile_image)
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Profile" class="w-9 h-9 rounded-lg object-cover border-2 border-white shadow-sm">
                    @else
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                            {{ strtoupper(substr(Auth::user()->nama_lengkap ?? Auth::user()->name ?? 'A', 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-gray-800 truncate">{{ Str::limit(Auth::user()->nama_lengkap ?? Auth::user()->name, 15) }}</p>
                        <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->role ?? 'Admin') }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</aside>

<!-- Overlay untuk mobile -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden backdrop-blur-sm transition-opacity duration-300"></div>

<style>
    /* EXPANDED STATE - Default */
    #sidebar {
        width: 16rem;
    }

    /* COLLAPSED STATE */
    #sidebar.sidebar-collapsed {
        width: 5rem;
    }

    /* Hide text smoothly */
    #sidebar.sidebar-collapsed .sidebar-text {
        opacity: 0;
        display: none;
        transition: opacity 0.2s ease-in-out;
    }

    #sidebar.sidebar-collapsed .sidebar-logo {
        opacity: 0;
        display: none;
    }

    #sidebar.sidebar-collapsed .sidebar-submenu {
        display: none !important;
    }

    #sidebar.sidebar-collapsed .chevron-icon {
        display: none;
    }

    /* Center items when collapsed */
    #sidebar.sidebar-collapsed #sidebarToggleDesktop {
        margin: 0 auto;
    }

    #sidebar.sidebar-collapsed .px-6 {
        padding-left: 1rem;
        padding-right: 1rem;
        display: flex;
        justify-content: center;
    }

    #sidebar.sidebar-collapsed .menu-item {
        justify-content: center;
        padding-left: 0;
        padding-right: 0;
    }

    /* Tooltips in collapsed state */
    .sidebar-tooltip {
        display: none;
    }

    #sidebar.sidebar-collapsed .menu-item:hover .sidebar-tooltip {
        display: block;
        position: absolute;
        left: 100%;
        top: 50%;
        transform: translateY(-50%);
        margin-left: 0.75rem;
        background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        color: white;
        padding: 0.5rem 0.875rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        white-space: nowrap;
        z-index: 1000;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1);
        animation: tooltipSlide 0.2s ease-out;
    }

    @keyframes tooltipSlide {
        from {
            opacity: 0;
            transform: translateY(-50%) translateX(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(-50%) translateX(0);
        }
    }

    #sidebar.sidebar-collapsed .menu-item:hover .sidebar-tooltip::before {
        content: '';
        position: absolute;
        right: 100%;
        top: 50%;
        transform: translateY(-50%);
        border-width: 6px;
        border-style: solid;
        border-color: transparent #1f2937 transparent transparent;
    }

    /* Smooth transitions */
    #sidebar {
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-text,
    .chevron-icon,
    .sidebar-logo {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Custom scrollbar */
    .scrollbar-custom::-webkit-scrollbar {
        width: 5px;
    }

    .scrollbar-custom::-webkit-scrollbar-track {
        background: transparent;
    }

    .scrollbar-custom::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #e5e7eb 0%, #d1d5db 100%);
        border-radius: 10px;
    }

    .scrollbar-custom::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #d1d5db 0%, #9ca3af 100%);
    }

    /* Mobile */
    @media (max-width: 1024px) {
        #sidebar {
            transform: translateX(-100%);
            width: 16rem !important;
        }

        #sidebar.show-mobile {
            transform: translateX(0);
        }

        #sidebar.sidebar-collapsed .sidebar-text,
        #sidebar.sidebar-collapsed .sidebar-logo {
            display: block;
            opacity: 1;
        }

        #sidebar.sidebar-collapsed .chevron-icon {
            display: block;
        }

        #sidebar.sidebar-collapsed .menu-item {
            justify-content: flex-start;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        #sidebar.sidebar-collapsed .menu-item:hover .sidebar-tooltip {
            display: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggleDesktop = document.getElementById('sidebarToggleDesktop');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const sidebarToggleMobile = document.getElementById('sidebarToggle');

        // Desktop Toggle with smooth animation
        if (sidebarToggleDesktop) {
            sidebarToggleDesktop.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-collapsed');
                const icon = this.querySelector('svg');
                icon.classList.toggle('rotate-180');
                
                const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);

                if (isCollapsed) {
                    setTimeout(() => {
                        document.querySelectorAll('.sidebar-submenu').forEach(submenu => {
                            submenu.classList.add('hidden');
                            submenu.classList.remove('max-h-96', 'opacity-100');
                            submenu.classList.add('max-h-0', 'opacity-0');
                        });
                        document.querySelectorAll('[id$="-icon"]').forEach(icon => {
                            icon.classList.remove('rotate-180');
                        });
                    }, 200);
                }
            });

            // Load saved state
            if (window.innerWidth >= 1024) {
                const savedState = localStorage.getItem('sidebarCollapsed');
                if (savedState === 'true') {
                    sidebar.classList.add('sidebar-collapsed');
                    const icon = sidebarToggleDesktop.querySelector('svg');
                    icon.classList.add('rotate-180');
                }
            }
        }

        // Mobile Toggle
        if (sidebarToggleMobile) {
            sidebarToggleMobile.addEventListener('click', function() {
                sidebar.classList.toggle('show-mobile');
                sidebarOverlay.classList.toggle('hidden');
                document.body.classList.toggle('overflow-hidden');
            });
        }

        // Overlay click to close
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show-mobile');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });
        }

        // Close sidebar on link click (Mobile)
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    sidebar.classList.remove('show-mobile');
                    sidebarOverlay.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('show-mobile');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    });

    // Submenu Toggle with smooth animation
    function toggleSubmenu(menuId) {
        const sidebar = document.getElementById('sidebar');
        const submenu = document.getElementById(menuId + '-submenu');
        const icon = document.getElementById(menuId + '-icon');

        if (sidebar.classList.contains('sidebar-collapsed')) {
            return;
        }

        if (submenu && icon) {
            const isHidden = submenu.classList.contains('hidden');
            
            if (isHidden) {
                submenu.classList.remove('hidden', 'max-h-0', 'opacity-0');
                submenu.classList.add('max-h-96', 'opacity-100');
            } else {
                submenu.classList.remove('max-h-96', 'opacity-100');
                submenu.classList.add('max-h-0', 'opacity-0');
                setTimeout(() => {
                    submenu.classList.add('hidden');
                }, 300);
            }
            
            icon.classList.toggle('rotate-180');
        }
    }
</script>