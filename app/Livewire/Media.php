<?php

namespace App\Livewire;

use Livewire\Component;

class Media extends Component
{
    public $upload_file_name;

    public function upload()
    {
    }
    public function render()
    {
        return view('livewire.media');
    }
}
