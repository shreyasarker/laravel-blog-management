<div>
    {{-- Hero Section --}}
    <section class="bg-gradient-to-b from-indigo-50 to-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            {{-- Back Button --}}
            <a href="/" wire:navigate class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-medium mb-8 transition duration-150 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Home
            </a>

            {{-- Category Badge --}}
            @if($post->category)
                <div class="mb-4">
                    <span class="inline-block bg-indigo-100 text-indigo-600 text-sm font-semibold px-4 py-1.5 rounded-full">
                        {{ $post->category->name }}
                    </span>
                </div>
            @endif

            {{-- Title --}}
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $post->title }}
            </h1>

            {{-- Meta Info --}}
            <div class="flex flex-wrap items-center gap-4 text-gray-600 mb-8">
                {{-- Published Date --}}
                @if($post->published_at)
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $post->published_at->format('F d, Y') }}</span>
                    </div>
                @endif

                {{-- Reading Time --}}
                @if($post->reading_time)
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $post->reading_time }} min read</span>
                    </div>
                @endif

                {{-- Author --}}
                @if($post->author)
                    <div class="flex items-center gap-2">
                        <img src="{{ $post->author->profile_photo_url ?? $post->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name) . '&background=4f46e5&color=fff' }}" 
                             alt="{{ $post->author->name }}" 
                             class="w-8 h-8 rounded-full">
                        <span>By {{ $post->author->name }}</span>
                    </div>
                @endif
            </div>

            {{-- Excerpt --}}
            @if($post->excerpt)
                <p class="text-xl text-gray-600 leading-relaxed border-l-4 border-indigo-600 pl-6 py-2">
                    {{ $post->excerpt }}
                </p>
            @endif
        </div>
    </section>

    {{-- Featured Image --}}
    @if($post->featured_image)
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 mb-12">
            <img src="{{ $post->featured_image }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-auto rounded-xl shadow-2xl">
        </div>
    @endif

    {{-- Article Content --}}
    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="prose prose-lg prose-indigo max-w-none
                    prose-headings:font-bold prose-headings:text-gray-900
                    prose-h2:text-3xl prose-h2:mt-12 prose-h2:mb-6
                    prose-h3:text-2xl prose-h3:mt-8 prose-h3:mb-4
                    prose-p:text-gray-700 prose-p:leading-relaxed prose-p:mb-6
                    prose-a:text-indigo-600 prose-a:no-underline hover:prose-a:underline
                    prose-strong:text-gray-900 prose-strong:font-semibold
                    prose-ul:my-6 prose-ol:my-6
                    prose-li:text-gray-700 prose-li:my-2
                    prose-blockquote:border-l-4 prose-blockquote:border-indigo-600 prose-blockquote:pl-6 prose-blockquote:italic prose-blockquote:text-gray-600
                    prose-code:text-indigo-600 prose-code:bg-indigo-50 prose-code:px-1 prose-code:py-0.5 prose-code:rounded
                    prose-pre:bg-gray-900 prose-pre:text-gray-100
                    prose-img:rounded-lg prose-img:shadow-md">
            {!! $post->body !!}
        </div>
    </article>

    {{-- Tags --}}
    @if($post->tags && $post->tags->count() > 0)
        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 border-t border-gray-200">
            <div class="flex flex-wrap items-center gap-3">
                <span class="text-gray-600 font-semibold">Tags:</span>
                @foreach($post->tags as $tag)
                    <a href="/tags/{{ $tag->slug }}" 
                       wire:navigate
                       class="inline-block bg-gray-100 hover:bg-indigo-100 text-gray-700 hover:text-indigo-600 px-4 py-2 rounded-full text-sm font-medium transition duration-150">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Share Section --}}
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 border-t border-gray-200">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <h3 class="text-lg font-semibold text-gray-900">Share this article</h3>
            <div class="flex items-center gap-3">
                {{-- Twitter --}}
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" 
                   target="_blank"
                   rel="noopener"
                   class="flex items-center justify-center w-10 h-10 bg-blue-400 hover:bg-blue-500 text-white rounded-full transition duration-150">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                    </svg>
                </a>
                
                {{-- Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                   target="_blank"
                   rel="noopener"
                   class="flex items-center justify-center w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition duration-150">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
                
                {{-- LinkedIn --}}
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                   target="_blank"
                   rel="noopener"
                   class="flex items-center justify-center w-10 h-10 bg-blue-700 hover:bg-blue-800 text-white rounded-full transition duration-150">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                    </svg>
                </a>
                
                {{-- Copy Link --}}
                <button @click="navigator.clipboard.writeText('{{ request()->url() }}'); alert('Link copied to clipboard!')"
                        class="flex items-center justify-center w-10 h-10 bg-gray-600 hover:bg-gray-700 text-white rounded-full transition duration-150">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    {{-- Related Posts --}}
    @if($relatedPosts && $relatedPosts->count() > 0)
        <section class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8 mt-12">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relatedPost)
                        <x-post-card.regular :post="$relatedPost" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <x-footer />
</div>