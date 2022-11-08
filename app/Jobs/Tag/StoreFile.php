<?php

namespace App\Jobs\Tag;

use App\Models\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        \Storage::disk('tags')->put($this->file['tag'].'/'.$this->file['name'], file_get_contents($this->file['path']), 'public');
//        $file = \Storage::get($this->file);
//        \Storage::move($this->file, $this->tag->tag.'/'.'asdasdasd.mp4');
////        $file->storeAs($this->tag->tag, >file->hashName(), 'tags');
        toastr()->addSuccess('Tag ready!');
    }
}
