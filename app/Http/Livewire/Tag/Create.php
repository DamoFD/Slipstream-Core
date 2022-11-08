<?php

namespace App\Http\Livewire\Tag;

use App\Helpers\FileHelper;
use App\Jobs\Tag\StoreFile;
use App\Models\Tag;
use App\Models\Video;
use FFMpeg;
use LivewireUI\Modal\ModalComponent;

use Livewire\WithFileUploads;
class Create extends ModalComponent
{
    use WithFileUploads;

    public $file; //file
    public $title, $description; //fields

    public function render()
    {
        return view('livewire.tag.create');
    }

    public function updatedFile()
    {
        //TODO: If video -> Create thumb for preview
        $this->validate([
            'file' => 'required|file|mimetypes:video/mp4,video/mpeg,image/jpeg,image/png,image/bmp',
            'title' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);
    }


    public function upload()
    {
        $title  = $this->title ?? $this->file->getClientOriginalName();
        $hash   = $this->file->hashName();

        $tag = Tag::create([
            'title' => $title,
            'description' => $this->description,
        ]);

        if(FileHelper::isVideo($this->file->path())){

            $ffmpeg = FFMpeg::openUrl($this->file->path());


            $media = Video::create([
                'file' => $hash,
                'info'      => [
                    'size'              => round($this->file->getSize()/1000000), // to MB
                    'extension'         => $this->file->extension(),
                    'codec_name'        => $ffmpeg->getVideoStream()->get('codec_name'),
                    'codec_long_name'   => $ffmpeg->getVideoStream()->get('codec_long_name'),
                    'bit_rate'          => $ffmpeg->getVideoStream()->get('bit_rate'),
                    'width'             => $ffmpeg->getVideoStream()->get('width'),
                    'height'            => $ffmpeg->getVideoStream()->get('height'),
                    'r_frame_rate'      => $ffmpeg->getVideoStream()->get('r_frame_rate'),
                    'avg_frame_rate'    => $ffmpeg->getVideoStream()->get('avg_frame_rate'),
                    'tags'              => $ffmpeg->getVideoStream()->get('tags'),]
            ]);

            $ffmpeg->getFrameFromSeconds(0.1)->export()->toDisk('tags')->save($tag->tag.'/thumb.jpg');

        }


        $media->tag()->save($tag);

        $this->dispatchBrowserEvent('resetform');
        $this->emit('refreshTags');
        toastr()->addInfo('Tag will be available soon!');
        $this->closeModal();


        $fileJob = [
            'tag' => $tag->tag,
            'name' => $hash,
            'path' => $this->file->getRealPath(),
        ];
        StoreFile::dispatch($fileJob);


    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
