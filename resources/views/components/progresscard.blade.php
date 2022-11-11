<div class="aspect-video">


    <div
        class="bg-white bg-opacity-10 flex relative rounded-lg z-0 aspect-video shadow-md overflow-hidden">
        <!-- Video Card -->

        <div class="absolute z-2 w-full flex flex-col justify-end h-full">
            <!-- video overlay -->

        </div>
        <!-- Thumb -->
            <div class="w-full h-full absolute backdrop-blur bg-black/90">
                <div class="w-full h-full flex justify-center items-center flex-col" >

                    <span class="text-white font-bold text-lg">Processing</span>

                    <div class="w-3/4" x-data="{ width: '50' }" x-init="$watch('width', value => { if (value > 100) { width = 100 } if (value == 0) { width = 10 } })">
                        <div class="bg-neutral-800 rounded h-6 mt-5 w-full drop-shadow-lg" role="progressbar">
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
            <img class="rounded-lg object-cover h-full w-full" src="https://media.istockphoto.com/id/155439315/photo/passenger-airplane-flying-above-clouds-during-sunset.jpg?s=612x612&w=0&k=20&c=LJWadbs3B-jSGJBVy9s0f8gZMHi2NvWFXa3VJ2lFcL0=" alt="">


    </div><!-- End Video Card -->

</div>
