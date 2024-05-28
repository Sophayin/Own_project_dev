<div>
    @if($slug == 'language')
    @livewire('setting.language')

    @elseif($slug == 'exchange-rate')
    @livewire('setting.exchange-rate', ['action'=> $slug])

    @elseif($slug == 'system-log')
    @livewire('setting.system-log', ['action'=> $slug])
    {{-- @endif--}}
    @else($slug == 'language')
    @livewire('setting.language', ['action'=> $slug])
    @endif

</div>