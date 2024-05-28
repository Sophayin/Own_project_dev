<div>
    @if(!empty($action) && !empty($agency_id) )
    @livewire('agency.suggestion.promote-agency', ['agency_id'=> $agency_id])
    @else
    <section class="section">
        <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="d-flex mb-3">
                <div class="p-2 d-flex">
                    <div class="mt-1 text-sm">{{ __('Promote List') }}</div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 d-none d-sm-block p-2 ml-3">
                            <input class="form-control input_search" placeholder="{{__('Type Search...')}}" type="search" wire:model.live="search">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center text-secondary">{{__('No.')}}</th>
                                    <th class="text-secondary">{{__('Code')}}</th>
                                    <th class="text-secondary">{{__('Agency Name')}}</th>
                                    <th class="text-secondary">{{__('Position')}}</th>
                                    <th class="text-center text-secondary">{{__('Gender')}}</th>
                                    <th class="text-center text-secondary">{{__('Phone Number')}}</th>
                                    <th class="text-center text-secondary">{{__('Income')}}</th>
                                    <th class="text-center text-secondary">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($agency_suggestion))
                                @foreach($agency_suggestion as $N => $agency)
                                <tr style="vertical-align: middle;">
                                    <td class="text-sm text-center">{{++$N}}</td>
                                    <td class="text-sm text-start"> {{$agency['code']}} </td>
                                    <td class="text-sm ">{{$agency['full_name_translate']}}</td>
                                    <td class="text-sm">{{__($agency['position'])}} </td>
                                    <td class="text-sm text-center">{{__($agency['gender'])}}</td>
                                    <td class="text-sm text-center">{{$agency['phone']}}</td>
                                    <td class="text-sm text-end">{{$agency['income']}}</td>
                                    <td class="text-center">
                                        <a wire:navigate href="{{route('agency.list', 'list?action=promote&agency_id='.$agency['id'])}}">
                                            <span class="badge text-bg-light">
                                                {{__('Promote')}} <span class="text-success"><i class="bi bi-caret-up-fill"></i></span>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-center">{{__("No Record Found.!")}}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>