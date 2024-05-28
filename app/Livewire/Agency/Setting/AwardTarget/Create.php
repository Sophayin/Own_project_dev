<?php

namespace App\Livewire\Agency\Setting\AwardTarget;

use App\Models\Award;
use App\Models\AwardTarget;
use App\Models\Position;
use Livewire\Component;

class Create extends Component
{
    public $awards = [], $positions = [], $award_id, $position_id, $target_sale, $target_recruit, $salary, $incentive, $override_fee;

    public function mount(): void
    {
        $this->positions = Position::where('id', '<>', 5)->get();
    }

    public function render()
    {
        return view('livewire.agency.setting.award-target.create');
    }

    public function onPositionChange()
    {
        $this->awards = Award::with(['position' => function ($q) {
            $q->where('position_id', $this->position_id);
        }])->orderBy('id')->get();

        $this->award_id = null;
    }

    protected $rules = [
        'award_id' => 'required',
        'position_id' => 'required',
        'target_sale' => 'required',
        'target_recruit' => 'required',
    ];
    public function messages()
    {
        return [
            'position_id.required' => 'The position field is required.',
            'award_id.required' => 'The award field is required.',
        ];
    }


    public function insertAwardTarget()
    {
        $this->validate();
        $awardTarget = new AwardTarget();
        $awardTarget->award_id = $this->award_id;
        $awardTarget->position_id = $this->position_id;
        $awardTarget->target_sale = $this->target_sale;
        $awardTarget->target_recruit = $this->target_recruit ?? 0;
        $awardTarget->salary = $this->salary ?? 0;
        $awardTarget->incentive = $this->incentive ?? 0;
        $awardTarget->override_fee = $this->override_fee ?? 0;
        $awardTarget->save();
        create_transaction_log('create award target : ', 'update', "salary:$this->salary, Incentive: $this->incentive, override Fee: $this->override_fee", $this->award_id);

        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => __("Successfully created")
        ]);
        $this->reset();
        $this->mount();
        $this->dispatch('modal.closeModalCreateAwardTarget');
        $this->dispatch('refresh_award_target');
    }
}
