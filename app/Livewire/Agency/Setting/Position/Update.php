<?php

namespace App\Livewire\Agency\Setting\Position;

use App\Models\Position;
use Livewire\Component;

class Update extends Component
{
    public $position, $name, $description, $abbreviation, $code;
    protected $listeners = ['editPosition'];

    public function render()
    {
        return view('livewire.agency.setting.position.update');
    }

    protected $rules = [
        'name' => 'required',
        'code' => 'required',
        'abbreviation' => ['required'],
    ];

    public function editPosition($positionId)
    {
        $position = Position::find($positionId);
        $this->position = $position;
        $this->name = $position->name;
        $this->abbreviation = $position->abbreviation;
        $this->code = $position->code;
        $this->description = $position->description;
    }

    public function updatePosition()
    {
        $this->validate();
        $position = Position::find($this->position->id);
        $position->name = $this->name;
        $position->abbreviation = $this->abbreviation;
        $position->code = $this->code;
        $position->description = $this->description;
        $position->save();
        create_transaction_log('update Position : ' . $this->name, 'update',  'update ' . $this->abbreviation, $this->name);
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => $this->name . __("Successfully updated")
        ]);
        $this->redirect('/agency/setting', navigate: true);
    }
}
