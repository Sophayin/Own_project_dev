<?php

namespace App\Livewire\Agency\Structure;

use App\Models\Agency;
use Livewire\Component;
use Livewire\WithPagination;

class StructureList extends Component
{
    public $agency_id;
    use WithPagination;
    public $action, $search;
    protected $queryString = ['action', 'agency_id'];

    public function render()
    {
        $this->dispatch('findAgencyLeader');
        $agencies = Agency::whereNotNull('code')
            ->whereHas('children')
            ->where('position_id', '!=', 5);
        if ($this->search) {
            $txtSearch = trim($this->search);
            $agencies = $agencies->when($txtSearch, function ($q) use ($txtSearch) {
                $q->where('full_name', 'ilike', '%' . $txtSearch . '%');
                $q->orWhere('code', 'ilike', '%' . $txtSearch . '%');
            });
        }
        return view('livewire.agency.structure.structure-list', [
            'agencies' => $agencies->paginate(15)
        ]);
    }
}
