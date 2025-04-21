<div>
    @if(App::getLocale('locale') == 'en')
    <div class="box">
        <img wire:click="switchLanguage('kh')" src="{{asset('assets/flag/kh.png')}}" class="flag pointer" alt="" width="100" height="100">
    </div>
    @else
    <div class="box">
        <img wire:click="switchLanguage('en')" src="{{asset('assets/flag/usa.png')}}" class="flag pointer" alt="" width="100" height="100">
    </div>
    @endif
</div>