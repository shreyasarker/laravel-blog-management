<div class="p-8">
    <h1 class="text-2xl font-bold mb-4">Livewire Test</h1>
    
    <div class="mb-4 p-4 bg-blue-100">
        <p class="text-xl">{{ $message }}</p>
    </div>
    
    <button wire:click="changeMessage" class="px-4 py-2 bg-blue-600 text-white rounded">
        Click Me
    </button>
</div>