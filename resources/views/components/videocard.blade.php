<div class="aspect-video">

    <div
        class="bg-white bg-opacity-10 flex relative rounded-lg z-0 aspect-video shadow-md transition-all duration-300 delay-75 hover:scale-[0.99]">
        <!-- Video Card -->

        <div class="absolute z-2 w-full flex flex-col justify-end h-full">
            <!-- video overlay -->

            <div class="bg-black opacity-80 flex justify-between rounded-b-lg text-opacity-100 text-white px-4 py-2">
                <!-- Video Information -->
                <div>
                    <!-- Title -->
                    <p class="text-lg">
                        <a href="" target="_blank"><b>Title</b></a>
                    </p>
                    <!-- Description -->
                    <p class="text-sm text-de">
                        Description
                    </p>
                </div>
                <div class="flex self-center h-5/6">

                    <ul class="flex text-3xl">

                        <li class="px-1 self-center cursor-pointer transition-all hover:text-status-warning-500">
                            <box-icon color="white" name="edit-alt"></box-icon></li>
                        <li class="px-1 self-center cursor-pointer transition-all hover:text-brand-primary-500">
                            <box-icon color="white" name="cloud-download"></box-icon>
                        <li class="px-1 self-center cursor-pointer transition-all hover:text-status-success-500"
                            data-tooltip-target="tooltip-copy"
                            onclick="">
                            <box-icon color="white" name="copy-alt"></box-icon>
                        </li>

                    </ul>

                </div>
            </div>

            <!-- Badges -->
            <div class="flex order-first h-full p-4 justify-between">
                <!-- Type -->
                <div class="p-2 h-fit bg-black opacity-80 rounded-lg text-white text-opacity-100">
                    <span class="align-middle"><i class='bx bx-world'></i></span>
                    <span class="text-sm font-bold">HLS</span>
                </div>

                <!-- Quality -->
                <div class="p-2 h-fit bg-black opacity-80 rounded-lg text-white text-opacity-100">
                    <span class="align-middle"><i class='bx bx-film'></i></span>
                    <span class="text-sm font-bold">1080P</span>
                </div>

            </div>
        </div>
        <!-- Thumb -->
        <img class="rounded-lg object-cover h-full w-full" src="{{ $message }}" alt="">

    </div><!-- End Video Card -->

    <div id="tooltip-copy" role="tooltip"
         class="z-50 inline-block absolute invisible py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip dark:bg-gray-700">
        Copy link
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>

</div>
