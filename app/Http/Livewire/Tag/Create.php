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
    public $title, $description, $type; //fields

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
            $ffmpeg = FFMpeg::openUrl($this->file->path()); // TODO: Check
            // Get thumbnail TODO: Move to job, especially for custom thumbs, trimming & rotating etc
            $ffmpeg->getFrameFromSeconds(0.1)->export()->toDisk('tags')->save($tag->tag.'/thumb.jpg');

            // TODO: Check what processing method have been choosed

            $fileJob = [
                'name' => $hash,
                'path' => $this->file->getRealPath(),
            ];
            StoreFile::dispatch($tag, $fileJob, $this->type);
        }

        $this->dispatchBrowserEvent('resetform');
        $this->emit('refreshTags');
        toastr()->addInfo('Tag will be available soon!');
        $this->closeModal();





    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
