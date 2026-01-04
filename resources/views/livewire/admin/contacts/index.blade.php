{{-- resources/views/livewire/admin/contacts/index.blade.php --}}
<div>
    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Contact Messages</h1>
            <p class="text-gray-600 mt-2">
                Manage contact form submissions
                @if($unreadCount > 0)
                    <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                        {{ $unreadCount }} unread
                    </span>
                @endif
            </p>
        </div>
    </div>

    {{-- Success Message --}}
    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-sm text-green-800">{{ session('message') }}</p>
        </div>
    @endif

    {{-- Filters --}}
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Search --}}
            <div>
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search messages..."
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            
            {{-- Status Filter --}}
            <div>
                <select wire:model.live="filterStatus" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Messages</option>
                    <option value="0">Unread</option>
                    <option value="1">Read</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Messages List --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="divide-y divide-gray-200">
            @forelse($contacts as $contact)
                <div class="p-6 hover:bg-gray-50 transition {{ !$contact->is_read ? 'bg-blue-50' : '' }}">
                    <div class="flex items-start justify-between gap-4">
                        {{-- Message Info --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-2">
                                @if(!$contact->is_read)
                                    <span class="flex-shrink-0 w-2 h-2 bg-blue-600 rounded-full"></span>
                                @endif
                                <h3 class="text-lg font-semibold text-gray-900 truncate">
                                    {{ $contact->subject ?: 'No Subject' }}
                                </h3>
                            </div>
                            
                            <div class="flex items-center gap-4 text-sm text-gray-600 mb-2">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $contact->name }}
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $contact->email }}
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $contact->created_at->diffForHumans() }}
                                </div>
                            </div>
                            
                            <p class="text-gray-600 line-clamp-2">
                                {{ $contact->message }}
                            </p>
                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <button 
                                wire:click="viewMessage({{ $contact->id }})"
                                class="px-4 py-2 text-sm bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition">
                                View
                            </button>
                            
                            @if(!$contact->is_read)
                                <button 
                                    wire:click="markAsRead({{ $contact->id }})"
                                    class="px-4 py-2 text-sm bg-green-100 hover:bg-green-200 text-green-700 rounded-lg transition"
                                    title="Mark as read">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>
                            @else
                                <button 
                                    wire:click="markAsUnread({{ $contact->id }})"
                                    class="px-4 py-2 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition"
                                    title="Mark as unread">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                            @endif
                            
                            <button 
                                wire:click="delete({{ $contact->id }})"
                                wire:confirm="Are you sure you want to delete this message?"
                                class="px-4 py-2 text-sm bg-red-100 hover:bg-red-200 text-red-700 rounded-lg transition"
                                title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <p class="text-lg font-medium text-gray-900 mb-2">No messages found</p>
                    <p class="text-gray-500">Contact form submissions will appear here</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $contacts->links() }}
    </div>

    {{-- View Message Modal --}}
    @if($showModal && $selectedMessage)
        <div class="fixed inset-0 z-50 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                {{-- Background Overlay --}}
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" wire:click="closeModal"></div>

                {{-- Modal Panel --}}
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                    <div class="bg-white px-6 pt-6 pb-4">
                        {{-- Header --}}
                        <div class="flex items-start justify-between mb-4">
                            <h3 class="text-2xl font-bold text-gray-900">
                                {{ $selectedMessage->subject ?: 'No Subject' }}
                            </h3>
                            <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        {{-- Meta Info --}}
                        <div class="bg-gray-50 rounded-lg p-4 mb-6 space-y-2">
                            <div class="flex items-center gap-2 text-sm">
                                <span class="font-medium text-gray-700">From:</span>
                                <span class="text-gray-900">{{ $selectedMessage->name }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <span class="font-medium text-gray-700">Email:</span>
                                <a href="mailto:{{ $selectedMessage->email }}" class="text-indigo-600 hover:text-indigo-700">
                                    {{ $selectedMessage->email }}
                                </a>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <span class="font-medium text-gray-700">Date:</span>
                                <span class="text-gray-900">{{ $selectedMessage->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <span class="font-medium text-gray-700">Status:</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $selectedMessage->is_read ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $selectedMessage->is_read ? 'Read' : 'Unread' }}
                                </span>
                            </div>
                        </div>

                        {{-- Message --}}
                        <div class="mb-6">
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Message:</h4>
                            <div class="bg-white border border-gray-200 rounded-lg p-4 text-gray-900 whitespace-pre-wrap">{{ $selectedMessage->message }}</div>
                        </div>
                    </div>

                    {{-- Footer Actions --}}
                    <div class="bg-gray-50 px-6 py-4 flex items-center justify-end gap-2">
                        <a href="mailto:{{ $selectedMessage->email }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition">
                            Reply via Email
                        </a>
                        @if(!$selectedMessage->is_read)
                            <button 
                                wire:click="markAsRead({{ $selectedMessage->id }}); closeModal();"
                                class="px-4 py-2 bg-green-100 hover:bg-green-200 text-green-700 rounded-lg font-semibold transition">
                                Mark as Read
                            </button>
                        @endif
                        <button 
                            wire:click="delete({{ $selectedMessage->id }}); closeModal();"
                            wire:confirm="Are you sure you want to delete this message?"
                            class="px-4 py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg font-semibold transition">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>