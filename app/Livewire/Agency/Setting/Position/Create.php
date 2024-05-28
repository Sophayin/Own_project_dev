<?php

namespace App\Livewire\Agency\Setting\Position;

use App\Models\Position;
use Livewire\Component;

class Create extends Component
{
    public $name_kh, $name, $description, $abbreviation, $code;

    public function render()
    {
        return view('livewire.agency.setting.position.create');
    }

    protected $rules = [
        'name' => 'required',
        'code' => 'required',
        'abbreviation' => ['required'],
    ];

    public function createPosition()
    {
        $this->validate();
        $errors = $this->getErrorBag();
        if (count($errors)) {
            return $errors;
        }
        $position = new Position();
        $position->name = $this->name;
        $position->abbreviation = $this->abbreviation;
        $position->code = $this->code;
        $position->description = $this->description;
        $position->save();
        create_transaction_log('create Position : ' . $this->name, 'create', $this->description,  ' Position Code ' . $this->code);
        $this->dispatch("alert.message", [
            'type' => 'success',
            'message' => $this->name . " Successfully created "
        ]);
        $this->redirect('/agency/setting', navigate: true);
    }
}
