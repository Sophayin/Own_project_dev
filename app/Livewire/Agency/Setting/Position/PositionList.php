<?php

namespace App\Livewire\Agency\Setting\Position;

use App\Models\Position;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class PositionList extends Component
{
    use WithPagination;

    public $search = '', $limit = 15;

    public function render()
    {
        $txtSearch = trim($this->search);

            $positions = Position::Where('code', 'ilike', '%' . $txtSearch . '%')
                ->orWhere(function ($query) use ($txtSearch) {
                    $query->where('name', 'ilike', '%'.$txtSearch.'%')
                        ->orWhere('abbreviation', 'ilike', '%'.$txtSearch.'%');
                });

        $positions = $positions->paginate($this->limit);
        return view('livewire.agency.setting.position.position-list', ['positions' => $positions]);
    }

    public function openModalCreate()
    {
        $this->dispatch('modal.openModal');
    }

    public function openModalSetTarget($id)
    {
        $this->dispatch('setTarget', positionId: $id);
        $this->dispatch('modal.openModalSetTarget');
    }

    public function editPosition($id)
    {
        $this->dispatch('editPosition', positionId: $id);
        $this->dispatch('modal.openModalUpdate');
    }
}
