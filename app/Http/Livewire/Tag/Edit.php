<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{

    public Tag $tag;
    public $title;

    protected $rules = [

        'tag.title' => 'required|string',
        'tag.description' => ''
    ];

    public function mount(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function render()
    {
        return view('livewire.tag.edit')->with(['tag'=>$this->tag]);
    }

    public function update()
    {
        $this->validate();
        $this->tag->save();
        $this->emit('refreshTags');
        toastr()->addSuccess('Tag updated!');
        $this->closeModal();
    }



    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
