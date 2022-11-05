<div x-data="{file: '', isUploading: false, isFinished: false, progress: 0}"
     x-on:livewire-upload-start="isUploading = true"
     x-on:livewire-upload-finish="isUploading = false, isFinished = true"
     x-on:livewire-upload-error="isUploading = false"
     x-on:livewire-upload-progress="progress = $event.detail.progress"
     class="upload-area bg-gray-700 text-opacity-100 text-gray-900 px-4 py-2 border-dashed border-8">
    <div class="flex h-screen h-72">
        <div class="m-auto">
            <div class="">
                <!-- Input -->
                <div x-show="!file">
                    <input id="file" hidden type="file" wire:model="file" x-ref="file" x-on:change="file = $refs.file.files[0].name">
                    <p class="text-center align-middle" id="dropmessage" onclick="document.querySelector('input[type=\'file\']').click();">Click to select file!</p>
                </div>

                <!-- File selected -->
                <div x-show="file">
                    <!-- Form -->
                    <p class="text-center align-middle">
                        <input type="text" x-bind:placeholder="file" wire:model="title" id="title"><br>
                        <textarea placeholder="Description..." wire:model="description"></textarea>
                    </p>

                    <!-- Uploading -->
                    <div x-show="isUploading">
                        <p class="text-center align-middle">Uploading in progres..</p>
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>

                    <!-- Finished uploading -->
                    <div x-show="isFinished">
                        <button wire:click.prevent="upload">Save media!</button>.
                        <button x-on:click.prevent="file = '', isFinished = 0" id="reset">Reset</button>
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


