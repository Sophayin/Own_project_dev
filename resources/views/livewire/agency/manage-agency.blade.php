<div>
    @if($slug == 'list')
    @livewire('agency.agency-list')
    @elseif($slug == 'structure')
    @livewire('agency.structure.structure-list', ['action'=> $slug])

    @elseif($slug == 'training')
    @livewire('agency.training.training-list', ['action'=> $slug])

    @else($slug == 'setting')
    @livewire('agency.setting.setting-list', ['action'=> $slug])
    @endif

</div>