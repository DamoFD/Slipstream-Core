<?php

namespace App\Jobs\Tag;

use App\Enums\VideoType;
use App\Jobs\x264Optimization;
use App\Models\Tag;
use App\Models\Video;
use FFMpeg;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Imtigger\LaravelJobStatus\Trackable;
use Mockery\Exception;

class StoreFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    protected $file, $tag, $type;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Tag $tag, $file, $type)
    {
        $this->prepareStatus(['tag_id' => $tag->id]);
        $this->tag = $tag;
        $this->file = $file;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        switch ($this->type){
            case VideoType::Original():
                $ffmpeg = FFMpeg::openUrl($this->file['path']); // TODO: Check
                $media = Video::create([
                    'file' => $this->file['name'],
                    'info'      => [
//                'size'              => round($this->file->getSize()/1000000), // to MB
//                'extension'         => $this->file->extension(),
                        'codec_name'        => $ffmpeg->getVideoStream()->get('codec_name'),
                        'codec_long_name'   => $ffmpeg->getVideoStream()->get('codec_long_name'),
                        'bit_rate'          => $ffmpeg->getVideoStream()->get('bit_rate'),
                        'width'             => $ffmpeg->getVideoStream()->get('width'),
                        'height'            => $ffmpeg->getVideoStream()->get('height'),
                        'r_frame_rate'      => $ffmpeg->getVideoStream()->get('r_frame_rate'),
                        'avg_frame_rate'    => $ffmpeg->getVideoStream()->get('avg_frame_rate'),
                        'tags'              => $ffmpeg->getVideoStream()->get('tags'),]
                ]);
                $media->tag()->save($this->tag);
                \Storage::disk('tags')->put($this->tag->tag.'/'.$this->file['name'], file_get_contents($this->file['path']), 'public');
                toastr()->addSuccess('Tag ready!');
                break;
            case VideoType::X264():
                x264Optimization::dispatch($this->getJobStatusId(), $this->tag, $this->file['path']);
                break;
            case VideoType::HLS():
                break;
            default:
                throw new Exception('Wrong type');

        }


    }
}
