<?php

namespace App\Livewire\Agency\Training;

use App\Models\Position;
use Livewire\Component;

class TrainingList extends Component
{
    public $generatedNumber;
    public $positions;



    public function render()
    {
        $this->positions = Position::all();
        return view('livewire.agency.training.training-list');
    }
}
