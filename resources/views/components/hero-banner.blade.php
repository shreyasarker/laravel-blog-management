<section class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center">
            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Welcome to <span class="text-yellow-300">My Blog</span>
            </h1>
            
            <!-- Subheading -->
            <p class="text-xl sm:text-2xl text-indigo-100 mb-8 max-w-3xl mx-auto">
                Discover stories, insights, and ideas that inspire your journey
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#articles" 
                   class="bg-white text-indigo-600 hover:bg-indigo-50 px-8 py-3 rounded-lg font-semibold text-lg transition duration-150 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Explore Articles
                </a>
                <a href="/about" 
                   class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-indigo-600 px-8 py-3 rounded-lg font-semibold text-lg transition duration-150">
                    About Me
                </a>
            </div>
            
            <!-- Optional: Featured Stats or Icons -->
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-2xl mx-auto">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                    <div class="text-3xl font-bold text-white">{{ $totalPosts ?? '100+' }}</div>
                    <div class="text-indigo-100 text-sm">Articles</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                    <div class="text-3xl font-bold text-white">50K+</div>
                    <div class="text-indigo-100 text-sm">Readers</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4">
                    <div class="text-3xl font-bold text-white">{{ $totalCategories ?? '10+' }}</div>
                    <div class="text-indigo-100 text-sm">Categories</div>
                </div>
            </div>
        </div>
    </div>
</section>