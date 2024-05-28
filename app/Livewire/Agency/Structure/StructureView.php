<?php

namespace App\Livewire\Agency\Structure;

use App\Models\Agency;
use Livewire\Component;

class StructureView extends Component
{
    public function render()
    {
        return view('livewire.agency.structure.structure-view');
    }

    public $agency_id;
    public $data;
    public $agencies = [];

    public function mount($agency_id)
    {
        $this->agency_id = $agency_id;
        $this->agencies = Agency::orderBy('id')
            ->whereHas('children')
            ->whereNotNull('code')
            ->where('position_id', '!=', 5)
            ->get();
        $this->data = Agency::where('id', $agency_id)->whereNotNull('code')->with('children.children.children.children.children.children')->first();
    }

    public function updated()
    {
        return $this->redirect('structure?action=view&agency_id=' . $this->agency_id, navigate: true);
    }
}
