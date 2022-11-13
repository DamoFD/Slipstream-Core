<?php

namespace App\Jobs\Tag;

use App\Models\Tag;
use App\Models\Video;
use App\SlipstreamSettings;
use FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Imtigger\LaravelJobStatus\Trackable;
use Str;

class StreamOptimization implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    protected Tag $tag;
    protected $path;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($jobId, Tag $tag, $path)
    {
        $this->setJobStatusId($jobId);
        $this->tag = $tag;
        $this->path = $path;
        $this->setProgressMax(100);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SlipstreamSettings $settings)
    {
        $streamhash = Str::random(40);
        // TODO: Qualities
        $qualities = [
            360 => [640, 360, $settings->hls_streaming_bitrates[360]],
            720 => [1280, 720, $settings->hls_streaming_bitrates[720]],
            1080 => [1920, 1080, $settings->hls_streaming_bitrates[1080]],
            1440 => [2560, 1440, $settings->hls_streaming_bitrates[1440]],
            2160 => [3840, 2160, $settings->hls_streaming_bitrates[2160]]
        ];

        // TODO: To helper?
        preg_match('/livewire-tmp(.*)/', $this->path, $regex);
        $ff = FFMpeg::fromDisk('local')
            ->open($regex[0])
            ->exportForHLS()
            ->setSegmentLength(10) // optional
            ->setKeyFrameInterval(48) // optional
            ->onProgress(function ($percentage) {
                $this->setProgressNow($percentage);
            });



        foreach($qualities as $quality){
            if($ff->getVideoStream()->get('height') >= $quality[1]){
                $ff->addFormat((new X264('libmp3lame', 'libx264'))->setKiloBitrate($quality[2]), function ($media) use ($quality){
                    $media->scale($quality[0], $quality[1]);
                });
            }
        }

        $ff->useSegmentFilenameGenerator(function ($name, $format, $key, callable $segments, callable $playlist) {
            $segments("{$name}-{$format->getKiloBitrate()}-{$key}-%03d.ts");
            $playlist("{$name}-{$format->getKiloBitrate()}-{$key}.m3u8");
        })
            ->toDisk('tags')->save($this->tag->tag.'/'.$streamhash.'.m3u8');

        $media = Video::create([
            'file' => $streamhash.'.m3u8'
        ]);
        $media->tag()->save($this->tag);
    }
}
