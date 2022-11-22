<div class="bg-neutral-900 text-white px-4">
    <div class="p-8">
        <div class="p-4"> <!-- Header -->
            <h1 class="text-4xl leading-6 font-light text-[#00A3FE]">
                Settings
            </h1>
        </div>

        <!-- Main content -->
        <div class="px-4 flex justify-between gap-12">
            <div class="flex flex-col basis-3/5"><!-- coll 1 -->

                <div class="aspect-video py-8"><!-- Media frame -->
                    <img class="rounded-lg w-full" src="{{ url("storage/tags/" . $tag->tag . "/thumb.jpg") }}" alt="">
                </div>

                <div class="mb-8">
                    <p class="font-light pb-2"><label for="mediaTitle">Media Title</label></p>
                    <p><input class="input-text default-input w-full" type="text" placeholder="{{ $tag->title }} ({{ $tag->tag }})" name="mediaTitle" wire:model="tag.title"></p>
                    <sub class="text-neutral-400">The title of your media</sub>
                    @error('tag.title') <sub class="text-red-400">{{ $message }}</sub> @enderror
                </div>

                <div class="mb-6">
                    <p class="font-light pb-2"><label for="mediaDescription">Description</label></p>
                    <p>
                        <textarea class="input-text default-input w-full" name="mediaDescription" id="mediaDescription" cols="10" rows="3" wire:model="tag.description"></textarea>
                    </p>
                    <sub class="text-neutral-400">Describe your media</sub>

                    @error('tag.description') <sub class="text-red-400">{{ $message }}</sub> @enderror
                </div>

            </div>

            <div class="flex-col w-2/5"><!-- coll 2 -->
                <div class="mb-6">
                    <p class="font-light pb-2"><label for="mediaTitle">Access policy</label></p>
                    <p>
                        <select class="input-text default-input w-1/3 pl-2" name="mediaAccessPolicy" id="mediaAccessPolicy" wire:model="">
                            <option value="public">Public</option>
                            <option value="urlOnly">URL only</option>
                            <option value="private">Private</option>
                        </select>
                    </p>
                    <sub class="text-neutral-400">Select the Access policy for your media</sub>
                </div>
                <div class="mb-6">
                    <p class="font-light pb-2"><label for="None">None</label></p>
                    <p><input class="input-text default-input w-full" type="text" name="None" wire:model=""></p>
                    <sub class="text-neutral-400">The None of your media</sub>
                </div>
                <div class="mb-6">
                    <p class="font-light pb-2"><label for="None">None</label></p>
                    <p><input class="input-text default-input w-full" type="text" name="None" wire:model=""></p>
                    <sub class="text-neutral-400">The None of your media</sub>
                </div>
                <div class="mb-6">
                    <p class="font-light pb-2"><label for="None">None</label></p>
                    <p><input class="input-text default-input w-full" type="text" name="None" wire:model=""></p>
                    <sub class="text-neutral-400">The None of your media</sub>
                </div>
            </div>

        </div>

        {{-- <div class="px-6">
            <div class="button">
                <button type="button" wire:click.prevent="update()">SAVE CHANGES</button>
            </div>
            <box-icon color="red" name="trash" animation="tada-hover" wire:click="$emit('openModal', 'tag.delete', {{ json_encode([$tag->id]) }})"></box-icon>
        </div> --}}

        <div class="mx-4">
            <button wire:click.prevent="update()" class="btn btn-primary">
                <p>Save changes</p>
            </button>
            <button wire:click="$emit('openModal', 'tag.delete', {{ json_encode([$tag->id]) }})" class="btn btn-alert">
                <p>Delete</p>
            </button>
        </div>

    </div>
</div>

