<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{

    public Tag $tag;

    public function mount(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function render()
    {
        return view('livewire.tag.edit')->with(['tag'=>$this->tag]);
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
