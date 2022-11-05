<?php

namespace App\Http\Livewire\Tag;

use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public function render()
    {
        return view('livewire.tag.create');
    }
}
