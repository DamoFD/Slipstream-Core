<?php

namespace App\Jobs\Tag;

use App\Models\Tag;
use App\Models\Video;
use App\SlipstreamSettings;
use FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Imtigger\LaravelJobStatus\Trackable;
use Str;

class x264Optimization implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    public $timeout = 0;
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

        // Bitrates // TODO: Original bitrate
        $originalBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(500); // 360

        //TODO: To Helper?
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
