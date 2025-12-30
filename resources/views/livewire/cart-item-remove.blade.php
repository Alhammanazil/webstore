<div>
    <button wire:click="remove"
        class="px-3 py-2 mt-1 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700"
        wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed">
        <span wire:loading.remove>Remove</span>
        <span wire:loading>Removing...</span>
    </button>
</div>
