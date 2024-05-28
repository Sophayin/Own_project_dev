<?php

namespace App\Livewire\Agency;

use Livewire\Component;

class ManageAgency extends Component
{
    public $slug = 'list';

    public function render()
    {
        return view('livewire.agency.manage-agency')->title("Agency - " . ucfirst($this->slug));
    }
    public function mount($slug)
    {
        $this->slug = $slug;
    }
}
