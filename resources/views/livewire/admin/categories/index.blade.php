{{-- resources/views/livewire/admin/categories/index.blade.php --}}
<div>
    {{-- Page Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Categories</h1>
            <p class="text-gray-600 mt-2">Manage your post categories</p>
        </div>
        <button wire:click="create" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-150">
            Add Category
        </button>
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

    {{-- Error Message --}}
    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-sm text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    {{-- Search --}}
    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <input 
            type="text" 
            wire:model.live.debounce.300ms="search"
            placeholder="Search categories..."
            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500">
    </div>

    {{-- Categories Table --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posts</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-gray-900">{{ $category->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-600">{{ $category->slug }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                {{ $category->posts_count }} posts
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button wire:click="edit({{ $category->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                Edit
                            </button>
                            <button 
                                wire:click="delete({{ $category->id }})" 
                                wire:confirm="Are you sure you want to delete this category?"
                                class="text-red-600 hover:text-red-900">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                <p class="text-lg font-medium">No categories found</p>
                                <button wire:click="create" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">
                                    Create your first category
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $categories->links() }}
    </div>

    {{-- Modal --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data x-init="$el.showModal()">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                {{-- Background Overlay --}}
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" wire:click="closeModal"></div>

                {{-- Modal Panel --}}
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form wire:submit="save">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                {{ $editingId ? 'Edit Category' : 'Create Category' }}
                            </h3>

                            {{-- Name --}}
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="name"
                                    wire:model.live="name"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                                    placeholder="Category name">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Slug --}}
                            <div class="mb-4">
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                                    Slug <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="slug"
                                    wire:model="slug"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('slug') border-red-500 @enderror"
                                    placeholder="category-slug">
                                <p class="mt-1 text-sm text-gray-500">Auto-generated from name</p>
                                @error('slug')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Modal Footer --}}
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                            <button 
                                type="submit"
                                class="w-full sm:w-auto px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition duration-150">
                                {{ $editingId ? 'Update' : 'Create' }}
                            </button>
                            <button 
                                type="button"
                                wire:click="closeModal"
                                class="w-full sm:w-auto mt-3 sm:mt-0 px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 rounded-lg font-semibold transition duration-150">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>