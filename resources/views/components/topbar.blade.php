<header class="flex h-16 items-center justify-between border-b border-gray-200 bg-white px-4 dark:border-gray-700 dark:bg-gray-800 sm:px-6">
    {{-- Mobile menu button --}}
    <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700 lg:hidden dark:text-gray-400 dark:hover:text-gray-200">
        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    {{-- Spacer for desktop --}}
    <div class="hidden lg:block"></div>

    {{-- Right side --}}
    <div class="flex items-center gap-4">
        <x-user-menu />
    </div>
</header>