@props(['post'])

<article class="bg-white rounded-xl shadow-xl hover:shadow-2xl transition duration-300 overflow-hidden group">
    {{-- Large Featured Image --}}
    @if($post->featured_image)
        <a href="/posts/{{ $post->slug }}" wire:navigate class="block relative h-64 sm:h-80 overflow-hidden">
            <img src="{{ $post->featured_image }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
            
            {{-- Featured Badge --}}
            <div class="absolute top-4 left-4">
                <span class="bg-yellow-400 text-gray-900 text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                    ⭐ FEATURED
                </span>
            </div>
        </a>
    @else
        <a href="/posts/{{ $post->slug }}" wire:navigate class="block relative h-64 sm:h-80 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600"></a>
    @endif
    
    {{-- Card Content --}}
    <div class="p-8">
        {{-- Category & Meta Info --}}
        <div class="flex items-center gap-3 mb-4 flex-wrap">
            @if($post->category)
                <span class="bg-indigo-600 text-white text-sm font-semibold px-4 py-1.5 rounded-full">
                    {{ $post->category->name }}
                </span>
            @endif
            
            <div class="flex items-center gap-3 text-sm text-gray-500">
                @if($post->published_at)
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $post->published_at->format('M d, Y') }}
                    </span>
                @endif
                
                @if($post->reading_time)
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $post->reading_time }} min read
                    </span>
                @endif
            </div>
        </div>
        
        {{-- Title --}}
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-4 group-hover:text-indigo-600 transition duration-150 line-clamp-2">
            <a href="/posts/{{ $post->slug }}" wire:navigate>
                {{ $post->title }}
            </a>
        </h2>
        
        {{-- Excerpt --}}
        <p class="text-gray-600 text-lg mb-6 line-clamp-3 leading-relaxed">
            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 200) }}
        </p>
        
        {{-- Tags --}}
        @if($post->tags && $post->tags->count() > 0)
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach($post->tags->take(4) as $tag)
                    <span class="text-sm text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif
        
        {{-- Footer: Author & CTA --}}
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            {{-- Author Info --}}
            @if($post->author)
                <div class="flex items-center gap-3">
                    <img src="{{ $post->author->profile_photo_url ?? $post->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name) . '&background=4f46e5&color=fff' }}" 
                         alt="{{ $post->author->name }}" 
                         class="w-12 h-12 rounded-full object-cover ring-2 ring-indigo-100">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">{{ $post->author->name }}</p>
                        @if($post->author->title)
                            <p class="text-xs text-gray-500">{{ $post->author->title }}</p>
                        @endif
                    </div>
                </div>
            @endif
            
            {{-- Read More Button --}}
            <a href="/posts/{{ $post->slug }}" 
               wire:navigate
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2.5 rounded-lg font-semibold text-sm flex items-center gap-2 transition duration-150 group-hover:gap-3">
                Read Article
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</article>