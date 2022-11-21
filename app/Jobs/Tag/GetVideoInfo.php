<?php

namespace App\Jobs\Tag;

use App\Models\Tag;
use FFMpeg;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetVideoInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Tag $tag;
    protected $type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Tag $tag, $type)
    {
        $this->tag = $tag;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $ff = FFMpeg::fromDisk('tags')->open($this->tag->tag.'\\'.$this->tag->taggable->file);

        $data = (array) $ff->getStreams()[0];
        $key = array_key_first($data); // weird workaround to access raw keys.
        $this->tag->taggable()->update(['info' => json_encode($data[$key]), 'type' => $this->type]);
    }
}
