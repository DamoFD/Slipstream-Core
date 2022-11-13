<?php

namespace App\Http\Livewire;

use App\SlipstreamSettings;
use LivewireUI\Modal\ModalComponent;

class Settings extends ModalComponent
{

    public $settings;

    public function mount(SlipstreamSettings $settings){
        $this->settings = $settings->toCollection();
    }

    public function render()
    {
        return view('livewire.settings');
    }

    public function update(SlipstreamSettings $settings)
    {
        foreach($this->settings as $k=>$setting){
            $settings->$k = $setting;
        }
        $settings->save();
        toastr()->addSuccess('Settings saved!');
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
