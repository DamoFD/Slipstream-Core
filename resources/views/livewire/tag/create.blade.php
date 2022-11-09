<div x-data="{file: '', isUploading: false, isFinished: false, progress: 0}"
     x-on:livewire-upload-start="isUploading = true"
     x-on:livewire-upload-finish="isUploading = false, isFinished = true"
     x-on:livewire-upload-error="isUploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress"outline-opa
     class="upload-area bg-gray-900 text-opacity-100 text-gray-900 px-4 py-2 cursor-pointer">
    <div class="flex h-72">
        <div class="flex justify-center items-center w-full">
                <!-- Input -->
                <div x-show="!file">
                    <span class="flex justify-center mb-4" onclick="document.querySelector('input[type=\'file\']').click();"><box-icon name='download' color="white" animation="flashing-hover" size="lg"></box-icon></span>
                    <input id="file" hidden type="file" wire:model="file" x-ref="file" x-on:change="file = $refs.file.files[0].name">
                    <p id="dropmessage" ><span class="font-bold">Choose a file</span> or drag it here.</p>
                </div>


                @error('file') <span class="error" x-show="!isFinished" x-data="file=''">{{ $message }}</span> @enderror
                <!-- File selected -->
                <div x-show="file">

                    <!-- Form -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="">
                            <p><label for="title">Title</label></p>
                            <p class="mb-8"><input type="text" x-bind:placeholder="file" wire:model="title" id="title" class="default-input"></p>
                            <p><label for="description">Description</label></p>
                            <p><textarea placeholder="Description..." wire:model="description" class="default-input"></textarea></p>
                        </div>

                        <div class="">
                            <div class="bg-gray-500 rounded-md w-64 h-full"><p class="text-center align-middle">This is a video or thumb..</p></div>
                        </div>
                    </div>

                    <!-- Uploading -->
                    <div x-show="isUploading">
                        <p class="text-center align-middle">Uploading in progres..</p>
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>

                    <!-- Finished uploading -->
                    <div x-show="isFinished">
                        <button wire:click.prevent="upload">
                            <p>Save media</p>
                        </button>
                        <button x-on:click.prevent="file = '', isFinished = 0" id="reset">
                            <p>Cancel</p>
                        </button>
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


