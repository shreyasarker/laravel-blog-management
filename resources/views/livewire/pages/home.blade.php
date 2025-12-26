{{-- Example Usage - resources/views/livewire/pages/home.blade.php --}}
<div>
    {{-- Hero Banner --}}
    <x-hero-banner />
    
    {{-- Featured Post Section (if you want to highlight one post) --}}
    @if($posts->isNotEmpty())
        <section class="py-12 px-4 sm:px-6 lg:px-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="mb-6">
                    <h2 class="text-3xl font-bold text-gray-900">Featured Article</h2>
                </div>
                
                {{-- Featured Post Card (Large) --}}
                <x-post-card.featured :post="$posts->first()" />
            </div>
        </section>
    @endif
    
    {{-- Latest Articles Section --}}
    <section id="articles" class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Latest Articles</h2>
                <p class="text-lg text-gray-600">Stay updated with our newest content</p>
            </div>
            
            {{-- Option 1: Grid Layout with Regular Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($posts->skip(1) as $post)
                    <x-post-card.regular :post="$post" />
                @endforeach
            </div>
            
            {{-- OR Option 2: List Layout with Compact Cards --}}
            {{-- 
            <div class="space-y-6 mb-12">
                @foreach($posts->skip(1) as $post)
                    <x-post-card.compact :post="$post" />
                @endforeach
            </div>
            --}}
            
            {{-- Pagination --}}
            {{-- <div class="mt-12">
                {{ $posts->links() }}
            </div> --}}
        </div>
    </section>
    

   {{-- Newsletter Section with Status Messages --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Subscribe to Our Newsletter</h2>
            <p class="text-lg text-gray-600 mb-8">Get the latest articles delivered straight to your inbox</p>
            
            <form wire:submit="subscribe" class="flex flex-col sm:flex-row gap-4 max-w-lg mx-auto">
                <input 
                    type="email" 
                    wire:model="email"
                    placeholder="Enter your email" 
                    required
                    class="flex-1 px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                >
                <button 
                    type="submit" 
                    wire:loading.attr="disabled"
                    class="bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white px-8 py-3 rounded-lg font-semibold transition duration-150 whitespace-nowrap flex items-center justify-center gap-2">
                    <span wire:loading.remove>Subscribe</span>
                    <span wire:loading>Subscribing...</span>
                    <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>
            
            {{-- Error Messages --}}
            @error('email')
                <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3 max-w-lg mx-auto">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-red-600 text-left">{{ $message }}</p>
                </div>
            @enderror
            
            {{-- Success Message --}}
            @if($status === 'success')
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 5000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    class="mt-4 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start gap-3 max-w-lg mx-auto">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-left flex-1">
                        <p class="text-sm font-semibold text-green-800">Successfully subscribed! 🎉</p>
                        <p class="text-sm text-green-600 mt-1">Thank you for subscribing. You'll receive our latest articles in your inbox.</p>
                    </div>
                    <button @click="show = false" class="text-green-400 hover:text-green-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif
            
            {{-- Already Subscribed Message --}}
            @if($status === 'exists')
                <div 
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 5000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-start gap-3 max-w-lg mx-auto">
                    <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-left flex-1">
                        <p class="text-sm font-semibold text-blue-800">Already subscribed! ✉️</p>
                        <p class="text-sm text-blue-600 mt-1">This email is already on our subscriber list. Check your inbox for our latest updates!</p>
                    </div>
                    <button @click="show = false" class="text-blue-400 hover:text-blue-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif
        </div>
    </section>
</div>