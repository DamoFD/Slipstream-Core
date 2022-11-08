<div class="bg-gray-700 text-opacity-100 text-gray-900 px-4 py-0">
    <div class="p-8">
        <div class="p-4 sm:px-6 sm:py-4"> <!-- Header -->
            <h1 class="text-4xl leading-6 font-light text-white">
               Settings
            </h1>
        </div>

        <div class="px-4 sm:p-6 text-white"> <!-- Main content -->

            <div class="flex gap-8 basis-3/5">
                <div class="flex flex-col basis-3/4"><!-- coll 1 -->
                    <div>
                        <p class="font-light pb-2"><label for="mediaTitle">Media Title</label></p>
                        <p><input class="input-text w-3/4" type="text" name="mediaTitle" wire:model=""></p>
                        <sub>The title of your media</sub>
                    </div>

                    <div class="aspect-video py-8"><!-- Media frame -->
                        <img class="rounded-lg w-full" src="{{ url("storage/tags/" . $tag->tag . "/thumb.jpg") }}" alt="">
                    </div>
                </div>

                <div class="flex flex-col basis-2/5"><!-- coll 2 -->
                    <div class="mb-8">
                        <p class="font-light pb-2"><label for="mediaDiscription">Discription</label></p>
                        <p>
                            <textarea class="input-text w-full" name="mediaDiscription" id="mediaDiscription" cols="10" rows="5" wire:model=""></textarea>
                        </p>
                        <sub>Discribe your media</sub>
                    </div>

                    <div class="mb-8">
                        <p class="font-light pb-2"><label for="mediaTitle">Access policy</label></p>
                        <p>
                            <select class="input-text w-1/3 pl-2" name="mediaAccessPolicy" id="mediaAccessPolicy" wire:model="">
                                <option value="public">Public</option>
                                <option value="urlOnly">URL only</option>
                                <option value="private">Private</option>
                            </select>
                        </p>
                        <sub>Select the Access policy for your media</sub>
                    </div>

                    <div class="mb-8">
                        <p class="font-light pb-2"><label for="None">None</label></p>
                        <p><input class="input-text w-full" type="text" name="None" wire:model=""></p>
                        <sub>The None of your media</sub>
                    </div>

                    <div class="mb-8">
                        <p class="font-light pb-2"><label for="None">None</label></p>
                        <p><input class="input-text w-full" type="text" name="None" wire:model=""></p>
                        <sub>The None of your media</sub>
                    </div>

                    <div class="mb-8">
                        <p class="font-light pb-2"><label for="None">None</label></p>
                        <p><input class="input-text w-full" type="text" name="None" wire:model=""></p>
                        <sub>The None of your media</sub>
                    </div>
                </div>
            </div>

            <div class="button">
                <button type="button" wire:click.prevent="update()">SAVE CHANGES</button>
            </div>

        </div>
    </div>


    <hr>
    <div class="text-center text-2xl">Edit: {{ $tag->title }} ({{ $tag->tag }})</div>
    <box-icon color="red" name="trash" animation="tada-hover" wire:click="$emit('openModal', 'tag.delete', {{ json_encode([$tag->id]) }})"></box-icon></li>
</div>

