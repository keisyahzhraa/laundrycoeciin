<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Coeciin - Laundry Management')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom Styles -->
    @stack('styles')
</head>
<body class="bg-gray-50">
    
    <!-- Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Navbar -->
    @include('layouts.navbar')
    
    <!-- Main Content -->
    <div id="mainContent" class="transition-all duration-300 ease-in-out" style="margin-left: 16rem; margin-top: 4rem;">
        @yield('content')
    </div>
    
    <!-- Scripts -->
    <script>
        // Adjust main content when sidebar collapsed
        document.addEventListener('DOMContentLoaded', function() {
            const mainContent = document.getElementById('mainContent');
            const sidebar = document.getElementById('sidebar');
            const sidebarToggleDesktop = document.getElementById('sidebarToggleDesktop');

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
            
            // Load saved state dan update margin
            if (window.innerWidth >= 1024) {
                const savedState = localStorage.getItem('sidebarCollapsed');
                if (savedState === 'true') {
                    mainContent.style.marginLeft = '5rem';
                }
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>