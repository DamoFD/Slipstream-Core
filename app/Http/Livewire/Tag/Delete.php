<?php

namespace App\Http\Livewire\Tag;

use App\Models\Tag;
use App\Services\TagService;
use Exception;
use LivewireUI\Modal\ModalComponent;

class Delete extends ModalComponent
{

    public Tag $tag;

    public function mount(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function render()
    {
        return view('livewire.tag.delete');
    }

    public function delete(TagService $tagService)
    {
        try{
            $tagService->delete($this->tag);

            $this->emit('refreshTags');
            toastr()->addWarning('Tag deleted!');
            $this->closeModal();
            //Close edit modal too.
            $this->closeModal(); // TODO: Check proper fix for closing multiple modals
        }catch (Exception $e){
            toastr()->addError('Something went wrong while deleting tag<br>Message: '.$e->getMessage());
        }

    }
}
