<?php

namespace App\Livewire\Setting;

use Livewire\Component;

class ManageSetting extends Component
{

    public $slug = 'language';

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        return view('livewire.setting.manage-setting')->title("Setting - " . ucfirst($this->slug));
    }
}
