<?php

namespace App\Http\Livewire\Tag;

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

    public function updatedMedia()
    {
        //TODO: If video -> Create thumb for preview
        $this->validate([
            'media' => 'required|file',
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
