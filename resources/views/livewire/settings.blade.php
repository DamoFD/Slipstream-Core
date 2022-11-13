<div class="bg-neutral-900 text-white px-4">
    <div class="p-8">
        <div class="p-4"> <!-- Header -->
            <h1 class="text-4xl leading-6 font-light text-[#00A3FE]">
                Settings
            </h1>
        </div>

        <!-- Main content -->
        <div class="px-4 flex justify-between gap-12">
            <div class="flex flex-col basis-1/6"><!-- coll 1 -->

                <div class="mb-8">
                    <p class="font-light pb-2"><label for="siteTitle">Site title</label></p>
                    <p><input class="input-text default-input w-full" type="text" placeholder="" name="siteTitle" wire:model="settings.site_name"></p>
                    <sub class="text-neutral-400">The name your guests will see</sub>
                </div>
                <div class="mb-8">
                    <div class="flex items-center">
                        <p class="font-light pb-2"><label for="siteTitle">Guest can see tag info</label></p>
                        <p><input class="input-text default-input w-full" type="checkbox" placeholder="" name="siteTitle" wire:model="settings.guests_can_see_tag_info"></p>
                        <sub class="text-neutral-400">Upload date, size, amount of views etc.</sub>
                    </div>
                </div>

                <div class="mb-8">
                    <div class="flex">
                        <p class="font-light pb-2"><label for="siteTitle">360p</label></p>
                        <p><input class="input-text default-input w-50" type="text" placeholder="" name="siteTitle" wire:model="settings.hls_streaming_bitrates.360"></p>
                        <p class="font-light pb-2"><label for="siteTitle">720p</label></p>
                        <p><input class="input-text default-input w-50" type="text" placeholder="" name="siteTitle" wire:model="settings.hls_streaming_bitrates.720"></p>
                    </div>
                </div>
                <div class="mb-8">
                    <div class="flex">
                        <p class="font-light pb-2"><label for="siteTitle">1080p</label></p>
                        <p><input class="input-text default-input w-50" type="text" placeholder="" name="siteTitle" wire:model="settings.hls_streaming_bitrates.1080"></p>
                        <p class="font-light pb-2"><label for="siteTitle">1440p</label></p>
                        <p><input class="input-text default-input w-50" type="text" placeholder="" name="siteTitle" wire:model="settings.hls_streaming_bitrates.1440"></p>
                    </div>
                </div>
                <div class="mb-8">
                    <div class="flex">
                        <p class="font-light pb-2"><label for="siteTitle">2160p</label></p>
                        <p><input class="input-text default-input w-50" type="text" placeholder="" name="siteTitle" wire:model="settings.hls_streaming_bitrates.2160"></p>
                    </div>
                </div>

            </div>

            <div class="flex-col w-2/5"><!-- coll 2 -->
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

        </div>

    </div>
</div>



{{--<div class="bg-neutral-900 text-white px-4">--}}

{{--    <div class="p-8">--}}
{{--        <div class="p-4"> <!-- Header -->--}}
{{--            <h1 class="text-4xl leading-6 font-light text-[#00A3FE]">--}}
{{--                Settings--}}
{{--            </h1>--}}
{{--        </div>--}}


{{--    </div>--}}
{{--        <a class="dropdown-item px-4 text-center" wire:click="$emit('showModal', 'user-settings')">Click here for user settings</a>--}}
{{--    <div class="col-md-3 border-right">--}}
{{--        <div class="d-flex flex-column align-items-center text-center p-3 py-5">--}}
{{--            <span class="font-weight-bold">Powered by</span>--}}
{{--            <img class="" width="150px" src="{{ asset('logo.svg') }}">--}}
{{--            <span class="text-black-50">Version: xx</span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-5 border-right">--}}
{{--        <div class="p-3 pt-3">--}}
{{--            <div class="d-flex justify-content-between align-items-center mb-1">--}}
{{--                <h4 class="text-right">General settings</h4>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <label class="labels">Sitename</label>--}}
{{--                    <input type="text" class="form-control" placeholder="Sitename" wire:model="settings.site_name">--}}
{{--                    <span class="text-small text-muted">The name that your guests will see</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row mt-3">--}}
{{--                <div class="col-md-12 mt-2">--}}
{{--                    <div class="form-check form-switch">--}}
{{--                        <input class="form-check-input" type="checkbox" id="" wire:model="settings.keep_original_file">--}}
{{--                        <label class="form-check-label" for="">Keep original file</label>--}}
{{--                    </div>--}}
{{--                    <span class="text-small text-muted">Keep uploaded file on disk, when using web optimization processing the original and optimized files will be stored.</span>--}}
{{--                </div>--}}
{{--                <div class="col-md-12 mt-2">--}}
{{--                    <div class="form-check form-switch">--}}
{{--                        <input class="form-check-input" type="checkbox" id="" wire:model="settings.guests_can_see_video_info">--}}
{{--                        <label class="form-check-label" for="">Guests can see video info</label>--}}
{{--                    </div>--}}
{{--                    <span class="text-small text-muted">This includes upload date, size, amount of views</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row mt-3">--}}
{{--                <div class="col-md-12"><label class="labels">Views retention delay in minutes</label>--}}
{{--                    <input type="number" class="form-control" placeholder="minutes" wire:model="settings.view_retention_delay">--}}
{{--                    <span class="text-small text-muted">This will be added on top of the default timeout, the length of the video.<br>Advised to add at least a few minutes as extra buffer</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row mt-3">--}}
{{--                <span class=""><h4 class="text-right">Streaming bitrate settings in kb/s (x264/HLS)</h4></span>--}}
{{--                <div class="col-md-4"><label class="labels">360p</label>--}}
{{--                    <input type="number" class="form-control" placeholder="minutes" wire:model="settings.streaming_bitrates.360">--}}
{{--                    <span class="text-small text-muted"></span>--}}
{{--                </div>--}}
{{--                <div class="col-md-4"><label class="labels">720p</label>--}}
{{--                    <input type="number" class="form-control" placeholder="minutes" wire:model="settings.streaming_bitrates.720">--}}
{{--                    <span class="text-small text-muted"></span>--}}
{{--                </div>--}}
{{--                <div class="col-md-4"><label class="labels">1080p</label>--}}
{{--                    <input type="number" class="form-control" placeholder="minutes" wire:model="settings.streaming_bitrates.1080">--}}
{{--                    <span class="text-small text-muted"></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row mt-3">--}}
{{--                <div class="col-md-4"><label class="labels">1440p</label>--}}
{{--                    <input type="number" class="form-control" placeholder="minutes" wire:model="settings.streaming_bitrates.1440">--}}
{{--                    <span class="text-small text-muted"></span>--}}
{{--                </div>--}}
{{--                <div class="col-md-4"><label class="labels">2160p</label>--}}
{{--                    <input type="number" class="form-control" placeholder="minutes" wire:model="settings.streaming_bitrates.2160">--}}
{{--                    <span class="text-small text-muted"></span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row mt-3">--}}

{{--            </div>--}}
{{--            <div class="mt-5 text-center">--}}
{{--                <button class="btn btn-primary" wire:click.prevent="update()" type="button">Save Settings</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-md-4">--}}
{{--        <div class="p-3 py-5">--}}
{{--            <div class="d-flex justify-content-between align-items-center experience">--}}
{{--                <span>System information</span>--}}
{{--                <span class="border px-3 p-1 add-experience"><i class="bi-plus"></i>&nbsp;IP?</span></div><br>--}}
{{--            <div class="col-md-12">--}}
{{--                <span>Total videos:</span>--}}
{{--            </div>--}}
{{--            <div class="col-md-12">--}}
{{--                <span>Total views:</span>--}}
{{--            </div>--}}
{{--            <div class="col-md-12">--}}
{{--                <span>Total etc:</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
