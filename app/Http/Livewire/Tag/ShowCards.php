<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Livewire\Component;

class ShowCards extends Component
{
    protected $listeners = ['refreshTags' => '$refresh'];

    public function render()
    {
        $tags = Tag::latest()->get();
        return view('livewire.tag.show-cards')->with(compact('tags'));
    }
}
