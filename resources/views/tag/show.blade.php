
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://unpkg.com/plyr@3/dist/plyr.css'>
    <style>.container {
            margin: 100px auto;
            width: 70%;
        }
        video {
            width: 100%;
        }


        body {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background-color: #000;
            margin: 0;
        }
        /*.ambient-player {*/
        /*    display: flex;*/
        /*    justify-content: center;*/
        /*}*/
        .main,
        .decoy {
            width: 100%;
            max-height: 75vh;
            border-radius: 12px;
        }
        .decoy {
            position: absolute;
            filter: blur(64px);
            transform: scale(2, 1.5);
            z-index: -1;
            opacity: 0.6;
        }


    </style>

<div class="container">
    <div class="ambient-player">
        <canvas id="decoyVideo" class="decoy"></canvas>
        <video id="mainVideo" controls crossorigin playsinline poster="{{ url("storage/tags/" . $tag->tag . "/thumb.jpg") }}" src="">

        </video>
    </div>
</div>
<!-- Plyr resources and browser polyfills are specified in the pen settings -->
<!-- Hls.js 0.9.x and 0.10.x both have critical bugs affecting this demo. Using fixed git hash to when it was working (0.10.0 pre-release), until https://github.com/video-dev/hls.js/issues/1790 has been resolved -->
{{--<script src="https://cdn.rawgit.com/video-dev/hls.js/18bb552/dist/hls.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/hls.js/0.8.2/hls.min.js"></script>
<!-- partial -->
<script src='https://cdn.polyfill.io/v2/polyfill.min.js?features=es6,Array.prototype.includes,CustomEvent,Object.entries,Object.values,URL'></script>
<script src='https://unpkg.com/plyr@3'></script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const source = '{{url('storage/tags/'.$tag->tag.'/'.$tag->taggable->file)}}';
            const video = document.querySelector('video');
            const defaultOptions = {};

            console.log("Source: %s",source)
            console.log( "Type: %d", {{ $tag->taggable->type }} );

            if (!Hls.isSupported() || {{ $tag->taggable->type }} != 3) {
                console.log("HLS is not supported")
                video.src = source;
                var player = new Plyr(video, defaultOptions);
            } else {
                console.log("HLS is supported! :)")
                // For more Hls.js options, see https://github.com/dailymotion/hls.js
                console.log("Setting up HLS and load source")
                const hls = new Hls();
                hls.loadSource(source);

                // From the m3u8 playlist, hls parses the manifest and returns
                // all available video qualities. This is important, in this approach,
                // we will have one source on the Plyr player.
                hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {

                    // Transform available levels into an array of integers (height values).
                    const availableQualities = hls.levels.map(l => l.height);
                    availableQualities.unshift(0); //prepend 0 to quality array

                    // Add new qualities to option
                    defaultOptions.quality = {
                        default: 0, //Default - AUTO
                        options: availableQualities,
                        forced: true,
                        onChange: e => updateQuality(e) };

                    // Add Auto Label
                    defaultOptions.i18n = {
                        qualityLabel: {
                            0: 'Auto' } };



                    hls.on(Hls.Events.LEVEL_SWITCHED, function (event, data) {
                        var span = document.querySelector(".plyr__menu__container [data-plyr='quality'][value='0'] span");
                        if (hls.autoLevelEnabled) {
                            span.innerHTML = `AUTO (${hls.levels[data.level].height}p)`;
                        } else {
                            span.innerHTML = `AUTO`;
                        }
                    });

                    // Initialize new Plyr player with quality options
                    var player = new Plyr(video, defaultOptions);
                });

                hls.attachMedia(video);
                window.hls = hls;
            }

            function updateQuality(newQuality) {
                if (newQuality === 0) {
                    window.hls.currentLevel = -1; //Enable AUTO quality if option.value = 0
                } else {
                    window.hls.levels.forEach((level, levelIndex) => {
                        if (level.height === newQuality) {
                            console.log("Found quality match with " + newQuality);
                            window.hls.currentLevel = levelIndex;
                        }
                    });
                }
            }
        });
    </script>



    <script>
        /*
        Ambilight
         */
        let canvas = document.getElementById("decoyVideo"),
            ctx = canvas.getContext("2d"),
            video = document.getElementById("mainVideo");

        setCanvasDimension();
        paintStaticVideo();

        video.addEventListener("play", function () {
            let video = this; //cache
            (function loop() {
                if (!video.paused && !video.ended) {
                    ctx.drawImage(video, 0, 0, video.offsetWidth, video.offsetHeight);
                    setTimeout(loop, 1000 / 30); // drawing at 30fps
                }
            })();
        });

        video.addEventListener("seeked", () => {
            paintStaticVideo();
        });

        window.addEventListener("resize", () => {
            setCanvasDimension();
            if (video.paused) {
                paintStaticVideo();
            }
        });

        function setCanvasDimension() {
            canvas.height = video.offsetHeight;
            canvas.width = video.offsetWidth;
        }

        function paintStaticVideo() {
            ctx.drawImage(video, 0, 0, video.offsetWidth, video.offsetHeight);
        }
    </script>

</body>
</html>



{{--WERKEND--}}
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/videojs-hls-quality-selector@1.1.4/dist/videojs-hls-quality-selector.min.css">--}}
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/video.js@7.20.3/dist/video-js.min.css">--}}
{{--<style>--}}
{{--    .container {--}}
{{--        margin: 100px auto;--}}
{{--        width: 70%;--}}
{{--    }--}}
{{--    video {--}}
{{--        width: 100%;--}}
{{--    }--}}
{{--</style>--}}


{{--<div class="container">--}}
{{--    <video--}}
{{--        id="tag"--}}
{{--        class="video-js"--}}
{{--        controls  preload="auto"--}}
{{--        crossorigin playsinline--}}
{{--        data-setup="{}"--}}
{{--        poster="https://bitdash-a.akamaihd.net/content/sintel/poster.png">--}}

{{--        <source src="{{url('storage/tags/'.$tag->tag.'/'.$tag->taggable->file)}}" type="application/x-mpegURL">--}}
{{--    </video>--}}
{{--</div>--}}
{{--<link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />--}}
{{--<link href="https://www.unpkg.com/videojs-hls-quality-selector@1.0.5/dist/videojs-hls-quality-selector.css" rel="stylesheet" />--}}

{{--<script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>--}}
{{--<script src="https://unpkg.com/@videojs/http-streaming@2.13.1/dist/videojs-http-streaming.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-quality-levels/2.1.0/videojs-contrib-quality-levels.min.js" integrity="sha512-IcVOuK95FI0jeody1nzu8wg/n+PtQtxy93L8irm+TwKfORimcB2g4GSHdc0CvsK8gt1yJSbO6fCtZggBvLDDAQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
{{--<script src="https://www.unpkg.com/videojs-hls-quality-selector@1.0.5/dist/videojs-hls-quality-selector.min.js"></script>--}}

{{--<script>--}}
{{--    var player = videojs('tag');--}}

{{--    player.hlsQualitySelector();--}}
{{--</script>--}}
{{--ENDWERKEND--}}










{{--<head>--}}
{{--    <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />--}}
{{--    <script src="https://cdn.tailwindcss.com"></script>--}}

{{--</head>--}}
{{--<style>--}}
{{--    .vjs-theme-slipstream{--}}
{{--        --vjs-theme-slipstream--primary:#bf3b4d;--}}
{{--        --vjs-theme-slipstream--secondary:#fff--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-control-bar{--}}
{{--        height:70px;--}}
{{--        padding-top:20px;--}}
{{--        background:none;--}}
{{--        background-image:linear-gradient(0deg,#000,transparent)--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-button>.vjs-icon-placeholder:before{--}}
{{--        line-height:50px--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-play-progress:before{--}}
{{--        display:none--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-progress-control{--}}
{{--        position:absolute;--}}
{{--        top:0;--}}
{{--        right:0;--}}
{{--        left:0;--}}
{{--        width:100%;--}}
{{--        height:20px--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-progress-control .vjs-progress-holder{--}}
{{--        position:absolute;--}}
{{--        top:20px;--}}
{{--        right:0;--}}
{{--        left:0;--}}
{{--        width:100%;--}}
{{--        margin:0--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-play-progress{--}}
{{--        background-color:var(--vjs-theme-slipstream--primary)--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-remaining-time{--}}
{{--        order:1;--}}
{{--        line-height:50px;--}}
{{--        flex:3;--}}
{{--        text-align:left--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-play-control{--}}
{{--        order:2;--}}
{{--        flex:8;--}}
{{--        font-size:1.75em--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-fullscreen-control,.vjs-theme-slipstream .vjs-picture-in-picture-control,.vjs-theme-slipstream .vjs-volume-panel{--}}
{{--        order:3;--}}
{{--        flex:1--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-volume-panel:hover .vjs-volume-control.vjs-volume-horizontal{--}}
{{--        height:100%--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-mute-control{--}}
{{--        display:none--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-volume-panel{--}}
{{--        margin-left:.5em;--}}
{{--        margin-right:.5em;--}}
{{--        padding-top:1.5em--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-volume-bar.vjs-slider-horizontal,.vjs-theme-slipstream .vjs-volume-panel,.vjs-theme-slipstream .vjs-volume-panel.vjs-volume-panel-horizontal:hover,.vjs-theme-slipstream .vjs-volume-panel:active .vjs-volume-control.vjs-volume-horizontal,.vjs-theme-slipstream .vjs-volume-panel:focus .vjs-volume-control.vjs-volume-horizontal,.vjs-theme-slipstream .vjs-volume-panel:hover,.vjs-theme-slipstream .vjs-volume-panel:hover .vjs-volume-control.vjs-volume-horizontal{--}}
{{--        width:3em--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-volume-level:before{--}}
{{--        font-size:1em--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-volume-panel .vjs-volume-control{--}}
{{--        opacity:1;--}}
{{--        width:100%;--}}
{{--        height:100%--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-volume-bar{--}}
{{--        background-color:transparent;--}}
{{--        margin:0--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-slider-horizontal .vjs-volume-level{--}}
{{--        height:100%--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-volume-bar.vjs-slider-horizontal{--}}
{{--        margin-top:0;--}}
{{--        margin-bottom:0;--}}
{{--        height:100%--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-volume-bar:before{--}}
{{--        content:"";--}}
{{--        z-index:0;--}}
{{--        width:0;--}}
{{--        height:0;--}}
{{--        position:absolute;--}}
{{--        top:0;--}}
{{--        left:0;--}}
{{--        border-color:transparent transparent hsla(0,0%,100%,.25);--}}
{{--        border-style:solid;--}}
{{--        border-width:0 0 1.75em 3em--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-volume-level{--}}
{{--        overflow:hidden;--}}
{{--        background-color:transparent--}}
{{--    }--}}
{{--    .vjs-theme-slipstream .vjs-volume-level:before{--}}
{{--        content:"";--}}
{{--        z-index:1;--}}
{{--        width:0;--}}
{{--        height:0;--}}
{{--        position:absolute;--}}
{{--        top:0;--}}
{{--        left:0;--}}
{{--        border-left:3em solid transparent;--}}
{{--        border-bottom:1.75em solid var(--vjs-theme-slipstream--secondary);--}}
{{--        border-right:0 solid transparent;--}}
{{--        border-top:0 solid transparent--}}
{{--    }--}}
{{--</style>--}}

{{--<div class="flex justify-center items-center w-full h-full bg-neutral-900">--}}

{{--    <div class="p-8 flex flex-col border-red-900 border-2">--}}
{{--        <div class="mt-4 flex justify-between">--}}
{{--            --}}{{-- <p class="text-lg text-white mt-2">{{ $tag->title }} ({{ $tag->tag }})"</p> --}}
{{--            <p class="text-white text-2xl">A nice random tilte</p>--}}
{{--            <div class="bg-green-200 flex flex-col">--}}
{{--                <p>Powered by</p>--}}
{{--                <img class="w-3/5" src="../img/logo.png" alt="">--}}
{{--            </div>--}}

{{--        </div>--}}

{{--        <div class="rounded-md overflow-hidden self-center">--}}
{{--            <video--}}
{{--            id="media"--}}
{{--            class="video-js vjs-big-play-centered vjs-theme-slipstream"--}}
{{--            controls--}}
{{--            preload="auto"--}}
{{--            width="auto"--}}
{{--            height="528"--}}
{{--            --}}{{--        poster="MY_VIDEO_POSTER.jpg"--}}
{{--            data-setup="{}"--}}
{{--            >--}}
{{--                <source src="{{url('storage/tags/'.$tag->tag.'/'.$tag->taggable->file)}}" type="video/mp4">--}}
{{--            </video>--}}
{{--        </div>--}}



{{--        <div class="mt-6">--}}
{{--            <sub class="text-white">Description</sub>--}}
{{--            <p class="text-lg text-white mt-2">{{ $tag->title }} ({{ $tag->tag }}){{ $tag->title }} ({{ $tag->tag }})"</p>--}}
{{--        </div>--}}


{{--    </div>--}}

{{--</div>--}}
{{--<script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>--}}
