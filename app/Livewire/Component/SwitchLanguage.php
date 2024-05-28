<?php

namespace App\Livewire\Component;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class SwitchLanguage extends Component
{

    public function render()
    {
        return view('livewire.component.switch-language');
    }

    public function switchLanguage($lang)
    {
        Session::put('locale', $lang);
        App::setLocale($lang);
        $currentUrl = url()->previous();
        $this->redirect($currentUrl, navigate: true);
        $this->dispatch('languageChanged');
    }
}
