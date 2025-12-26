{{-- resources/views/livewire/pages/contact.blade.php --}}
<div>
    {{-- Hero Section --}}
    <section class="bg-gradient-to-b from-indigo-50 to-white py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">Get in Touch</h1>
            <p class="text-xl text-gray-600">
                Have a question or want to work together? I'd love to hear from you.
            </p>
        </div>
    </section>

    {{-- Contact Form Section --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">
            {{-- Success Message --}}
            @if($status === 'success')
                <div class="mb-8 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-green-800">Message sent successfully! 🎉</p>
                            <p class="text-sm text-green-600 mt-1">Thank you for reaching out. I'll get back to you soon.</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Contact Form --}}
            <div class="bg-white rounded-lg shadow-md p-8">
                <form wire:submit.prevent="submit" class="space-y-6">
                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name"
                            wire:model="name"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                            placeholder="Your name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email"
                            wire:model="email"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                            placeholder="your.email@example.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subject --}}
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                            Subject <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="subject"
                            wire:model="subject"
                            required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('subject') border-red-500 @enderror"
                            placeholder="What's this about?">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Message --}}
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                            Message <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="message"
                            wire:model="message"
                            required
                            rows="6"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('message') border-red-500 @enderror"
                            placeholder="Your message..."></textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <div>
                        <button 
                            type="submit"
                            wire:loading.attr="disabled"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white px-6 py-3 rounded-lg font-semibold transition duration-150">
                            <span wire:loading.remove>Send Message</span>
                            <span wire:loading>Sending...</span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Contact Info --}}
            <div class="mt-12 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Other Ways to Connect</h2>
                <div class="flex flex-col sm:flex-row justify-center gap-6 text-gray-600">
                    <a href="mailto:hello@myblog.com" class="flex items-center gap-2 hover:text-indigo-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        hello@myblog.com
                    </a>
                    <a href="https://twitter.com/yourusername" target="_blank" class="flex items-center gap-2 hover:text-indigo-600 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                        @yourusername
                    </a>
                </div>
            </div>
        </div>
    </section>
    <x-footer />
</div>