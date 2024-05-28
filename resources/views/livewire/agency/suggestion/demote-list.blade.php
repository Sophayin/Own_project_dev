<div>
    @if(!empty($action) && !empty($agency_id) )
    @livewire('agency.suggestion.demote', ['agency_id'=> $agency_id])

    @else
    <section class="section">
        <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="d-flex mb-3">
                <div class="p-2 app_section d-flex">
                    <div class="mt-1 text-sm">{{ __('Demote List') }}</div>
                </div>
            </div>
            <div class="col col-xxl-12 col-xl-12 card col-lg-12 col-md-12 col-sm-12">
                <div class="container d-flex p-2">
                    <div class="col-lg-3 d-none d-sm-block p-2 ml-3">
                        <input class="form-control input_search" placeholder="{{__('Type Search...')}}" type="search" wire:model.live="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text_header">
                                <th class="text-center text-secondary">{{__('No.')}}</th>
                                <th class="text-secondary">{{__('Code')}}</th>
                                <th class="text-secondary">{{__('Agency Name')}}</th>
                                <th class="text-secondary">{{__('Position')}}</th>
                                <th class="text-center text-secondary">{{__('Gender')}}</th>
                                <th class="text-end text-secondary">{{__('Phone Number')}}</th>
                                <th class="text-end text-secondary">{{__('Income')}}</th>
                                <th class="text-center text-secondary">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agencies as $N => $agency)
                            <tr style="vertical-align: middle;">
                                <td class="text-sm text-center">{{++$N}}</td>
                                <td class="text-sm text-start">{{$agency->code}} </td>
                                <td class="text-sm">{{$agency->full_name}}</td>
                                <?php $position = App\Models\Position::find($agency->position_id); ?>
                                <td class="text-sm tet-center">{{ __($position->abbreviation )}} </td>
                                <td class="text-sm text-center">{{__($agency->gender)}}</td>
                                <td class="text-sm text-end">{{$agency->phone}}</td>
                                <td class="text-sm text-end">{{$agency->income}}</td>
                                <td class="text-center">
                                    <a wire:navigate href="{{route('agency.list', 'list?action=demote&agency_id='.$agency->id)}}">
                                        <span class="badge text-bg-light">
                                            {{__('Demote')}} <span class="text-danger"><i class="bi bi-caret-down"></i></span>
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$agencies->links('livewire.customer-pagination')}}

                </div>
            </div>
        </div>
    </section>
    @endif
</div>