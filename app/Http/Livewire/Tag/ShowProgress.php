<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use Livewire\Component;

class ShowProgress extends Component
{

    public $job, $tag;

    public function mount($tag){
        $this->tag = $tag;
        $this->job = $this->tag->job;
    }

    public function getProgressProperty()
    {
        return $this->job->progress_now;
    }
    public function getStatusProperty()
    {
        return $this->job->status;
    }

    public function render()
    {
        if($this->job->status == "finished"){
            $this->emit('refreshTags');
        }
        return view('livewire.tag.show-progress')->with(['progress' => $this->progress, 'status' => $this->status]);
    }
}
