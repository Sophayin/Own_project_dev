<div>
    @if($action == 'view')
    @livewire('agency.structure.structure-view', ['agency_id'=> $agency_id])

    @else
    <section class="section">
        <div class="card">
            <div class="card-body ">
                <div class="raw mt-3">
                    <div class="col-md-3">
                        <input class="form-control " placeholder="{{__('Type Search...')}} [ {{__('Code')}},{{__('Agency Name')}} ]" type="search" wire:model.live="search">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-secondary text-center text-sm">{{__('No.')}}</th>
                                <th class="text-secondary text-sm">{{__('Code')}}</th>
                                <th class="text-secondary text-sm">{{__('Full Name')}}</th>
                                <th class="text-secondary text-sm">{{__('Phone Number')}}</th>
                                <th class="text-secondary text-end text-sm">{{__('Register Date')}}</th>
                                <th class="text-secondary text-center text-sm">{{__('Option')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agencies as $index => $agency)
                            <tr>
                                <td class="text-sm text-center">{{ ++$index }}</td>
                                <td class="text-sm text-start">{{ $agency->code }}</td>
                                <td class="text-sm">{{ $agency->full_name }}</td>
                                <td class="text-sm">{{ $agency->phone }}</td>
                                <td class="text-sm text-end">{{ $agency->created_at->format('d/M/Y') }}</td>
                                <td class="text-sm text-center">
                                    <a style="border-color:transparent;" wire:navigate href="{{route('agency.list', 'structure?action=view&agency_id='.$agency->id)}}" class="rounded-pill btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $agencies->links('livewire.customer-pagination') }}
                </div>
            </div>
        </div>
    </section>
    @endif
</div>