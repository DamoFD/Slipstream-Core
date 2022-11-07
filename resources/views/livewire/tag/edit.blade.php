<div class="bg-gray-700 text-opacity-100 text-gray-900 px-4 py-2">
    <div class="text-center text-2xl">Edit: {{ $tag->title }} ({{ $tag->tag }})</div>
    <box-icon color="red" name="trash" animation="tada-hover" wire:click="$emit('openModal', 'tag.delete', {{ json_encode([$tag->id]) }})"></box-icon></li>
</div>
