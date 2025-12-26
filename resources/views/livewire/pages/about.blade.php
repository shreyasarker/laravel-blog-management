{{-- resources/views/livewire/pages/about.blade.php --}}
<div>
    {{-- Hero Section --}}
    <section class="bg-gradient-to-b from-indigo-50 to-white py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">About My Blog</h1>
            <p class="text-xl text-gray-600 leading-relaxed">
                Welcome! I'm passionate about sharing insights, stories, and ideas that inspire and inform.
            </p>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            {{-- About Me Card --}}
            <div class="bg-white rounded-lg shadow-md p-8 mb-12">
                <div class="flex flex-col md:flex-row gap-8 items-center md:items-start">
                    {{-- Profile Image --}}
                    <div class="flex-shrink-0">
                        <img src="https://ui-avatars.com/api/?name=My+Blog&size=200&background=4f46e5&color=fff" 
                             alt="Profile" 
                             class="w-32 h-32 rounded-full shadow-lg">
                    </div>
                    
                    {{-- Bio --}}
                    <div class="flex-1 text-center md:text-left">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Hi, I'm [Your Name]</h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            I'm a writer, developer, and lifelong learner based in [Your Location]. This blog is where I share my thoughts on technology, design, productivity, and everything in between.
                        </p>
                        <p class="text-gray-600 leading-relaxed">
                            When I'm not writing, you can find me exploring new tools, reading books, or working on side projects. I believe in continuous learning and sharing knowledge with the community.
                        </p>
                    </div>
                </div>
            </div>

            {{-- What I Write About --}}
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">What I Write About</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Topic 1 --}}
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-xl transition duration-300">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Technology</h3>
                        <p class="text-gray-600">Web development, programming tips, and tech trends</p>
                    </div>

                    {{-- Topic 2 --}}
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-xl transition duration-300">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Design</h3>
                        <p class="text-gray-600">UI/UX insights, design patterns, and creative inspiration</p>
                    </div>

                    {{-- Topic 3 --}}
                    <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-xl transition duration-300">
                        <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Productivity</h3>
                        <p class="text-gray-600">Time management, workflows, and efficiency tips</p>
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="bg-indigo-600 rounded-lg shadow-xl p-8 mb-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center text-white">
                    <div>
                        <div class="text-4xl font-bold mb-2">50+</div>
                        <div class="text-indigo-100">Articles Published</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold mb-2">10K+</div>
                        <div class="text-indigo-100">Monthly Readers</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold mb-2">5+</div>
                        <div class="text-indigo-100">Years Writing</div>
                    </div>
                </div>
            </div>

            {{-- CTA Section --}}
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Let's Connect</h2>
                <p class="text-gray-600 mb-8">
                    Have a question or want to collaborate? Feel free to reach out!
                </p>
                <div class="flex justify-center gap-4">
                    <a href="/contact" 
                       wire:navigate
                       class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-150">
                        Contact Me
                    </a>
                    <a href="/" 
                       wire:navigate
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-8 py-3 rounded-lg font-semibold transition duration-150">
                        Read Articles
                    </a>
                </div>
            </div>
        </div>
    </section>
    <x-footer />
</div>