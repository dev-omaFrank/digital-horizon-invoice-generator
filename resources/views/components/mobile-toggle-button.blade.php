<button
    @click="sidebarOpen = !sidebarOpen"
    class="md:hidden fixed top-4 left-4 z-50 w-10 h-10 rounded bg-primary text-white flex items-center justify-center shadow-lg">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>

<!-- Sidebar -->
<aside
    x-show="sidebarOpen"
    @click.outside="sidebarOpen = false"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-gray-200
                   md:relative md:translate-x-0 md:block">
    @include('components.sidebar')
</aside>