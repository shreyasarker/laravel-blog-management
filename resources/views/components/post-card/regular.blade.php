@props(['post'])

<article class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden group">
    {{-- Featured Image --}}
    @if($post->featured_image)
        <a href="/posts/{{ $post->slug }}" wire:navigate class="block relative h-48 overflow-hidden">
            <img src="{{ $post->featured_image }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
            {{-- Overlay on hover --}}
            <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition duration-300"></div>
        </a>
    @else
        {{-- Default gradient if no image --}}
        <a href="/posts/{{ $post->slug }}" wire:navigate class="block relative h-48 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500"></a>
    @endif
    
    {{-- Card Content --}}
    <div class="p-6">
        {{-- Category & Reading Time --}}
        <div class="flex items-center gap-2 mb-3 flex-wrap">
            @if($post->category)
                <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold px-3 py-1 rounded-full">
                    {{ $post->category->name }}
                </span>
            @endif
            
            @if($post->reading_time)
                <span class="text-gray-500 text-sm">{{ $post->reading_time }} min read</span>
            @endif
            
            @if($post->published_at)
                <span class="text-gray-400 text-sm">
                    {{ $post->published_at->diffForHumans() }}
                </span>
            @endif
        </div>
        
        {{-- Title --}}
        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition duration-150 line-clamp-2">
            <a href="/posts/{{ $post->slug }}" wire:navigate>
                {{ $post->title }}
            </a>
        </h3>
        
        {{-- Excerpt --}}
        <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
        </p>
        
        {{-- Tags (Optional) --}}
        @if($post->tags && $post->tags->count() > 0)
            <div class="flex flex-wrap gap-2 mb-4">
                @foreach($post->tags->take(3) as $tag)
                    <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif
        
        {{-- Footer: Author & Read More --}}
        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            {{-- Author Info --}}
            @if($post->author)
                <div class="flex items-center gap-2">
                    <img src="{{ $post->author->profile_photo_url ?? $post->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name) . '&background=4f46e5&color=fff' }}" 
                         alt="{{ $post->author->name }}" 
                         class="w-8 h-8 rounded-full object-cover">
                    <div class="text-sm">
                        <p class="text-gray-700 font-medium">{{ $post->author->name }}</p>
                    </div>
                </div>
            @endif
            
            {{-- Read More Link --}}
            <a href="/posts/{{ $post->slug }}" 
               wire:navigate
               class="text-indigo-600 hover:text-indigo-700 font-semibold text-sm flex items-center gap-1 group-hover:gap-2 transition-all">
                Read More 
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</article>