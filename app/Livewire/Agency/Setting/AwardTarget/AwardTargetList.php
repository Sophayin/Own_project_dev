<?php

namespace App\Livewire\Agency\Setting\AwardTarget;

use App\Models\Position;
use Livewire\Component;

class AwardTargetList extends Component
{

    public $search = '';

    protected $listeners = ['refresh_award_target' => 'render'];

    public function openModalCreateAwardTarget()
    {

        $this->dispatch('modal.openModalCreateAwardTarget');
    }

    public function editAwardTarget($id)
    {

        $this->dispatch('modal.openModalSetAwardTarget');
        $this->dispatch('editAwardTarget', positionId: $id);
    }

    public function render()
    {
        $txtSearch = trim($this->search);

        $positions = Position::with('awardTargets')
            ->whereHas('awardTargets', function () {
            })
            ->where(function ($query) use ($txtSearch) {
                $query->where('name', 'ilike', '%' . $txtSearch . '%')
                    ->orWhere('abbreviation', 'ilike', '%' . $txtSearch . '%')
                    ->orWhere('code', 'ilike', '%' . $txtSearch . '%');
            })->get();

        return view('livewire.agency.setting.award-target.award-target-list', ['positions' => $positions]);
    }
}
