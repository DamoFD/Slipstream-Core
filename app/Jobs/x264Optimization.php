<?php

namespace App\Jobs;

use App\Models\Tag;
use App\Models\Video;
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

class x264Optimization implements ShouldQueue
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
    public function handle()
    {
        // TODO: Qualities
        $qualities = [
            360 => [640, 360, '1000'],
            720 => [1280, 720, '1000'],
            1080 => [1920, 1080, '1000'],
//            1440 => [2560, 1440, $this->settings['streaming_bitrates'][1440]],
//            2160 => [3840, 2160, $this->settings['streaming_bitrates'][2160]]
        ];
        $streamhash = Str::random(40);

        // Bitrates // TODO: Bitrates list
        $originalBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(500); // 360

        $superLowBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(500); // 360
        $lowBitrateFormat =(new X264('libmp3lame', 'libx264'))->setKiloBitrate(100720); // 720
        $midBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(101080); // 1080
        $highBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(101440); // 1440

        preg_match('/livewire-tmp(.*)/', $this->path, $regex);
        FFMpeg::fromDisk('local')->open($regex[0])
            ->export()->onProgress(function ($percentage) {
                $this->setProgressNow($percentage);
            })->toDisk('tags')->inFormat($originalBitrateFormat)->save($this->tag->tag.'/'.$streamhash.'.mp4');

        $media = Video::create([
            'file' => $streamhash.'.mp4'
        ]);
        $media->tag()->save($this->tag);

    }
}
