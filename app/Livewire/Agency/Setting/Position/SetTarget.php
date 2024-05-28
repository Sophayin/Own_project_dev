<?php

namespace App\Livewire\Agency\Setting\Position;

use App\Models\Position;
use Livewire\Component;

class SetTarget extends Component
{
    public $position, $target_sale, $target_recruit;
    protected $listeners = ['setTarget'];

    public function render()
    {
        return view('livewire.agency.setting.position.set-target');
    }

    protected $rules = [
        'target_sale' => 'required',
        'target_recruit' => 'required',
    ];

    public function setTarget($positionId)
    {
        $position = Position::find($positionId);
        $this->position = $position;
        $this->target_sale = $position->target_sale;
        $this->target_recruit = $position->target_recruit;
    }

    public function saveTarget()
    {
        $this->validate();
        $position = Position::find($this->position->id);
        $position->target_sale = $this->target_sale;
        $position->target_recruit = $this->target_recruit;
        $position->save();
        create_transaction_log('Set Targe : ' . $this->position->name, 'set target',  'target Salt:  ' . $this->target_sale, "target recruit: " . $this->target_recruit, $this->position->name);

        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => "Successfully set target! "
        ]);
        $this->redirect('/agency/setting', navigate: true);
    }
}
