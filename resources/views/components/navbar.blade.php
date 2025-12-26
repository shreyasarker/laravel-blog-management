<nav class="bg-white shadow-lg" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side: Logo and Menu -->
            <div class="flex items-center space-x-8">
                <!-- Site Name/Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" wire:navigate class="text-2xl font-bold text-indigo-600">
                        My Blog
                    </a>
                </div>
                
                <!-- Navigation Menu -->
                <div class="hidden md:flex space-x-6">
                    <a href="/about" 
                       wire:navigate
                       class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition duration-150">
                        About
                    </a>
                    <a href="/contact" 
                       wire:navigate
                       class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition duration-150">
                        Contact
                    </a>
                    <a href="/blog" 
                       wire:navigate
                       class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium transition duration-150">
                        Blog
                    </a>
                </div>
            </div>

            <!-- Right Side: Auth Buttons or Profile -->
            <div class="flex items-center">
                @auth
                    <!-- Profile Dropdown (shown when logged in) -->
                    <div class="hidden md:block relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                @click.away="open = false"
                                class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600 focus:outline-none">
                            <img class="h-8 w-8 rounded-full object-cover" 
                                 src="{{ Auth::user()->profile_photo_url ?? Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=4f46e5&color=fff' }}" 
                                 alt="{{ Auth::user()->name }}">
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="h-5 w-5 transition-transform duration-200" 
                                 :class="{ 'rotate-180': open }"
                                 fill="none" 
                                 stroke="currentColor" 
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-10"
                             style="display: none;">
                            <a href="/profile" 
                               wire:navigate
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-150">
                                Your Profile
                            </a>
                            <a href="/settings" 
                               wire:navigate
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition duration-150">
                                Settings
                            </a>
                            <hr class="my-1">
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" 
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-150">
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Login/Register Buttons (shown when logged out) -->
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="/login" 
                           wire:navigate
                           class="text-gray-700 hover:text-indigo-600 px-4 py-2 text-sm font-medium transition duration-150">
                            Login
                        </a>
                        <a href="/register" 
                           wire:navigate
                           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150">
                            Register
                        </a>
                    </div>
                @endauth

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="md:hidden ml-4 text-gray-700 hover:text-indigo-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen"
         @click.away="mobileMenuOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2"
         class="md:hidden border-t border-gray-200"
         style="display: none;">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="/about" 
               wire:navigate
               class="block text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 px-3 py-2 rounded-md text-base font-medium">
                About
            </a>
            <a href="/contact" 
               wire:navigate
               class="block text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 px-3 py-2 rounded-md text-base font-medium">
                Contact
            </a>
            <a href="/blog" 
               wire:navigate
               class="block text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 px-3 py-2 rounded-md text-base font-medium">
                Blog
            </a>
            
            @auth
                <!-- Mobile Profile Menu -->
                <div class="pt-4 pb-3 border-t border-gray-200">
                    <div class="flex items-center px-3 mb-3">
                        <img class="h-10 w-10 rounded-full" 
                             src="{{ Auth::user()->profile_photo_url ?? Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=4f46e5&color=fff' }}" 
                             alt="{{ Auth::user()->name }}">
                        <div class="ml-3">
                            <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <a href="/profile" 
                       wire:navigate
                       class="block text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 px-3 py-2 rounded-md text-base font-medium">
                        Your Profile
                    </a>
                    <a href="/settings" 
                       wire:navigate
                       class="block text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 px-3 py-2 rounded-md text-base font-medium">
                        Settings
                    </a>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" 
                                class="block w-full text-left text-red-600 hover:bg-red-50 px-3 py-2 rounded-md text-base font-medium mt-2">
                            Sign Out
                        </button>
                    </form>
                </div>
            @else
                <!-- Mobile Auth Buttons -->
                <div class="pt-4 pb-3 border-t border-gray-200 space-y-2">
                    <a href="/login" 
                       wire:navigate
                       class="block text-center text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 px-3 py-2 rounded-md text-base font-medium">
                        Login
                    </a>
                    <a href="/register" 
                       wire:navigate
                       class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-md text-base font-medium">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>