@props(['post'])

<article class="bg-white rounded-lg shadow-md hover:shadow-xl transition duration-300 overflow-hidden group flex flex-col sm:flex-row">
    {{-- Featured Image (smaller, side by side on desktop) --}}
    @if($post->featured_image)
        <a href="/posts/{{ $post->slug }}" wire:navigate class="block relative w-full sm:w-48 h-48 sm:h-auto overflow-hidden flex-shrink-0">
            <img src="{{ $post->featured_image }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
        </a>
    @else
        <a href="/posts/{{ $post->slug }}" wire:navigate class="block relative w-full sm:w-48 h-48 sm:h-auto bg-gradient-to-br from-indigo-500 to-purple-500 flex-shrink-0"></a>
    @endif
    
    {{-- Card Content --}}
    <div class="p-5 flex-1 flex flex-col">
        {{-- Category & Meta --}}
        <div class="flex items-center gap-2 mb-2 flex-wrap">
            @if($post->category)
                <span class="bg-indigo-100 text-indigo-600 text-xs font-semibold px-2.5 py-0.5 rounded-full">
                    {{ $post->category->name }}
                </span>
            @endif
            @if($post->published_at)
                <span class="text-gray-400 text-xs">
                    {{ $post->published_at->format('M d, Y') }}
                </span>
            @endif
        </div>
        
        {{-- Title --}}
        <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition duration-150 line-clamp-2">
            <a href="/posts/{{ $post->slug }}" wire:navigate>
                {{ $post->title }}
            </a>
        </h3>
        
        {{-- Excerpt --}}
        <p class="text-gray-600 text-sm mb-3 line-clamp-2 flex-grow">
            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}
        </p>
        
        {{-- Footer --}}
        <div class="flex items-center justify-between mt-auto">
            @if($post->author)
                <div class="flex items-center gap-2">
                    <img src="{{ $post->author->profile_photo_url ?? $post->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name) . '&background=4f46e5&color=fff' }}" 
                         alt="{{ $post->author->name }}" 
                         class="w-7 h-7 rounded-full">
                    <span class="text-xs text-gray-600">{{ $post->author->name }}</span>
                </div>
            @endif
            
            @if($post->reading_time)
                <span class="text-xs text-gray-500">{{ $post->reading_time }} min read</span>
            @endif
        </div>
    </div>
</article>