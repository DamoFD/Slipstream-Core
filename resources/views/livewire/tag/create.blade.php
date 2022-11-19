<div x-data="{file: '', isUploading: false, isFinished: false, progress: 0}"
     x-on:livewire-upload-start="isUploading = true"
     x-on:livewire-upload-finish="isUploading = false, isFinished = true"
     x-on:livewire-upload-error="isUploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress"
     class="upload-area bg-neutral-900 text-white px-4 py-2">
    <div class="flex h-full justify-center items-center">
        <div class="w-3/4">

            <!-- Input -->
            <div x-show="!file">
                <div class="my-20 flex justify-center items-center flex-col cursor-pointer">
                    <span class="flex justify-center mb-4"><box-icon name='download' color="white" animation="flashing-hover" size="lg"></box-icon></span>
                    <input id="file" hidden type="file" wire:model="file" x-ref="file" x-on:change="file = $refs.file.files[0].name">
                    <div class="flex justify-center"><p id="dropmessage"><span class="font-bold">Choose a file</span> or drag it here.</p></div>
                </div>
            </div>

            @error('file') <span class="error" x-show="!isFinished" x-data="file=''">{{ $message }}</span> @enderror

            <!-- File selected -->
            <div x-show="file">
                <!-- Uploading -->
                <div x-show="isUploading">
                    <div class="my-10">
                        <p class="text-center align-middle pt-4 font-bold">Uploading</p>
                        {{-- <progress max="100" x-bind:value="progress"></progress> --}}
                        {{-- Progress Bar --}}
                        <div class="w-full" x-data="{ width: '50' }" x-init="$watch('width', value => { if (value > 100) { width = 100 } if (value == 0) { width = 10 } })">
                            <div class="bg-neutral-800 rounded h-6 mt-2 w-full drop-shadow-lg" role="progressbar">
                                <div
                                    class="bg-[#00A3FE] rounded h-6 text-center text-white text-sm transition"
                                    :style="`width: ${width}%; transition: width 2s;`"
                                    x-text="`${width}%`"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Finished uploading -->
                <div x-show="isFinished" >
                    <div class="my-4">
                        <div class="mb-4"> <!-- Header -->
                            <h1 class="text-4xl font-light text-white">
                                Save your media
                            </h1>
                        </div>
                        <div class="grid grid-cols-2 gap-8">
                            <div class="">
                                <p class="mb-2"><label for="title" >Title</label></p>
                                <p class="mb-4"><input type="text" x-bind:placeholder="file" wire:model="title" id="title" class="default-input w-full"></p>
                                <p class="mb-2"><label for="description">Description</label></p>
                                <p><textarea placeholder="Description..." rows="1" wire:model="description" class="default-input w-full"></textarea></p>
                                <p class="mb-2"><label for="type">Type</label>

                                    <select name="type" id="type" autocomplete="off" x-model="type" wire:model="type" class="default-input w-full">
                                        <option value="1" selected="selected">None (Original file)</option>
                                        <option value="2">Optimized for web (x264)</option>
                                        <option value="3">Optimized for streaming (x264/HLS)</option>
                                    </select>
                                </p>
                            </div>
                            <div class="flex justify-center items-center">
                                <div class="rounded-md overflow-hidden">
                                    @if($file)
                                    <video src="{{$file->temporaryUrl() }}" class="aspect-video"></video>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 mb-4">
                        <button wire:click.prevent="upload" class="btn btn-primary">
                            <p>Save media</p>
                        </button>
                        <button x-on:click.prevent="file = '', isFinished = 0" id="reset" class="btn btn-alert">
                            <p>Cancel</p>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        {{--        TODO : REWRITE!!! --}}
        $(function() {
            // Open file selector on div click
            $(".upload-area").click(function(){
                if(document.querySelector('input[type=\'file\']').files.length == 0 ) {
                    document.querySelector('input[type=\'file\']').click();
                }
            });

            window.addEventListener('resetform', event => {
                document.getElementById('reset').click()
            })
        });
    </script>
</div>


