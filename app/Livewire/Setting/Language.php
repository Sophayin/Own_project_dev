<?php

namespace App\Livewire\Setting;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Language extends Component
{
    public $lang;

    public function onSwitchLanguage()
    {
        Session::put('locale', $this->lang);
        App::setLocale(session('locale'));
        $this->redirect('/setting/language', navigate:true);

    }

    public function render()
    {
        $this->lang = session('locale');
        // App::setLocale($this->lang);
        return view('livewire.setting.language');
    }
}
