<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="fixed left-0 top-0 w-64 h-screen transition-all duration-300 ease-in-out z-40 overflow-y-auto" 
    id="sidebar">
    <div class="h-full bg-gradient-to-b from-blue-800 to-blue-900 shadow-xl">
        <!-- Logo / Brand -->
        <div class="px-6 py-5 border-b border-blue-700/50">
            <a href="{{ route('dashboard') }}" class="flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-white text-xl font-bold leading-tight">MEKAR TANI</h1>
                    <p class="text-blue-200 text-sm">DESA SUKARAJA</p>
                </div>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="mt-6 px-4 space-y-1">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
                class="group flex items-center px-4 py-3 text-blue-100 rounded-lg transition-all duration-200 
                    {{ Request::routeIs('dashboard') ? 'bg-blue-700 shadow-lg' : 'hover:bg-blue-700/50' }}">
                <svg class="w-5 h-5 mr-3 {{ Request::routeIs('dashboard') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" 
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Data Petani -->
            <a href="{{ route('petani.index') }}" 
                class="group flex items-center px-4 py-3 text-blue-100 rounded-lg transition-all duration-200 
                    {{ Request::routeIs('petani.index') ? 'bg-blue-700 shadow-lg' : 'hover:bg-blue-700/50' }}">
                <svg class="w-5 h-5 mr-3 {{ Request::routeIs('petani.index') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" 
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="font-medium">Data Petani</span>
            </a>

            <!-- Report Petani -->
            <a href="{{ route('report') }}" 
                class="group flex items-center px-4 py-3 text-blue-100 rounded-lg transition-all duration-200 
                    {{ Request::routeIs('report') ? 'bg-blue-700 shadow-lg' : 'hover:bg-blue-700/50' }}">
                <svg class="w-5 h-5 mr-3 {{ Request::routeIs('report') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" 
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="font-medium">Report Petani</span>
            </a>

            @if (auth()->user()->level == 'Admin')
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-blue-300 uppercase">Admin Menu</p>
                <div class="mt-3 space-y-1">
                    <!-- Kategori -->
                    <a href="{{ route('kategori') }}" 
                        class="group flex items-center px-4 py-3 text-blue-100 rounded-lg transition-all duration-200 
                            {{ Request::routeIs('kategori') ? 'bg-blue-700 shadow-lg' : 'hover:bg-blue-700/50' }}">
                        <svg class="w-5 h-5 mr-3 {{ Request::routeIs('kategori') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span class="font-medium">Kategori</span>
                    </a>

                    <!-- Jadwal -->
                    <a href="{{ route('jadwal') }}" 
                        class="group flex items-center px-4 py-3 text-blue-100 rounded-lg transition-all duration-200 
                            {{ Request::routeIs('jadwal') ? 'bg-blue-700 shadow-lg' : 'hover:bg-blue-700/50' }}">
                        <svg class="w-5 h-5 mr-3 {{ Request::routeIs('jadwal') ? 'text-white' : 'text-blue-300 group-hover:text-white' }}" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="font-medium">Jadwal</span>
                    </a>
                </div>
            </div>
            @endif
        </nav>

        <!-- Sidebar Footer -->
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <hr class="mb-4 border-blue-700/50">
            <div class="flex items-center justify-between px-4">
                <button id="sidebarToggle" 
                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-700/50 text-white hover:bg-blue-700 transition-colors duration-200">
                    <svg class="w-5 h-5 transform transition-transform" id="toggleIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                    </svg>
                </button>
                <span class="text-sm text-blue-300">v1.0.0</span>
            </div>
        </div>
    </div>
</aside>

<!-- Overlay for mobile -->
<div id="sidebarOverlay" 
    class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-30 hidden md:hidden transition-opacity duration-300"
    onclick="toggleSidebar()">
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleIcon = document.getElementById('toggleIcon');
    let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';

    function updateSidebarState() {
        if (isCollapsed) {
            sidebar.classList.add('w-20');
            sidebar.classList.remove('w-64');
            toggleIcon.classList.add('rotate-180');
            document.querySelectorAll('#sidebar span').forEach(span => {
                span.classList.add('hidden');
            });
        } else {
            sidebar.classList.remove('w-20');
            sidebar.classList.add('w-64');
            toggleIcon.classList.remove('rotate-180');
            document.querySelectorAll('#sidebar span').forEach(span => {
                span.classList.remove('hidden');
            });
        }
    }

    function toggleSidebar() {
        if (window.innerWidth < 768) {
            // Mobile behavior
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        } else {
            // Desktop behavior
            isCollapsed = !isCollapsed;
            localStorage.setItem('sidebarCollapsed', isCollapsed);
            updateSidebarState();
        }
    }

    // Initialize sidebar state
    if (window.innerWidth < 768) {
        sidebar.classList.add('-translate-x-full');
    } else {
        updateSidebarState();
    }

    // Event listeners
    document.getElementById('sidebarToggle').addEventListener('click', toggleSidebar);
    
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            overlay.classList.add('hidden');
            sidebar.classList.remove('-translate-x-full');
            updateSidebarState();
        } else {
            sidebar.classList.add('-translate-x-full');
        }
    });
});
</script>

<style>
/* Improve scrollbar styling */
::-webkit-scrollbar {
    width: 4px;
    height: 4px;
}

::-webkit-scrollbar-track {
    background: rgba(59, 130, 246, 0.1);
}

::-webkit-scrollbar-thumb {
    background: rgba(59, 130, 246, 0.5);
    border-radius: 2px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(59, 130, 246, 0.7);
}

/* Smooth transitions */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}

/* Improve mobile experience */
@media (max-width: 768px) {
    #sidebar {
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }
}

/* Active state animations */
.shadow-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}
</style>