<?php

namespace App\Http\Livewire\Tag;

use App\Helpers\File;
use App\Helpers\FileHelper;
use App\Models\Tag;
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

        }

        $this->dispatchBrowserEvent('resetform');
        $this->emit('refreshTags');
        toastr()->addSuccess('Media uploaded!');
        $this->closeModal();
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }
}
