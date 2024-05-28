<div>
    @if($action == 'create')
    @livewire('agency.create')
    @elseif($action == 'update')
    @livewire('agency.update', ['agency_id'=> $agency_id])
    @elseif($action == 'profile')
    @livewire('agency.agency-view-profile', ['agency_id'=> $agency_id])
    @elseif($action == 'view')
    @livewire('agency.structure-view', ['agency_id'=> $agency_id])
    @elseif($action == 'promote')
    @livewire('agency.suggestion.suggestion-list')
    @elseif($action == 'demote')
    @livewire('agency.suggestion.demote-list')
    @elseif($action == 'import')
    @livewire('agency.import-file')
    @elseif($action == 'download')
    @livewire('agency.download-region')
    @else
    <section class="section">
        <div class="col col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="d-flex mb-3 justify-content-between">
                <div class="app_section d-flex">
                    <div class="mt-1 text-sm">{{ __('Agency List') }} - {{__('Status')}}</div>
                    <div>
                        <select wire:change="onFilterStatus($event.target.value)" class="form-control form-select border-0 bg-transparent">
                            <option value="">{{__('All')}}</option>
                            @foreach(get_agency_status() as $status)
                            <option value="{{$status['id']}}">{{__($status['label'])}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="p-2">
                        <a wire:click="button_demote_agnecy">
                            <button class="btn btn-danger">
                                <i class="bi bi-arrow-down"></i>
                                {{__('Demote')}}
                            </button>
                        </a>
                    </div>
                    <div class="p-2">
                        <a wire:click="button_promote_agnecy">
                            <button class="btn btn-success">
                                <i class="bi bi-arrow-up"></i>
                                {{__('Promote')}}
                            </button>
                        </a>
                    </div>
                    <div class="p-2">
                        <a wire:click="add_new_agency">
                            <button class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i>
                                {{__('Add New Agency')}}
                            </button>
                        </a>
                    </div>
                    <div class="p-2">
                        <a wire:click="import_file">
                            <button class="btn btn-secondary">
                                <!--<i class="bi bi-box-arrow-in-left"></i>-->
                                <i class="bi bi-arrow-bar-down"></i>
                                {{__('Import File')}}
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row mt-3 p-3">
                    <div class="col-lg-3">
                        <input class="form-control input_search " placeholder="{{__('Type Search...')}} {{__('Code')}},{{__('Agency Name')}}" type="search" wire:model.live="search">
                    </div>
                    <div class="col-lg-2">
                        <select wire:model.lazy="city_id" class="form-select form-select-lg mb-3">
                            <option value="">--{{__('All City')}}--</option>
                            @foreach($getCities as $city)
                            <option value="{{$city->id}}">{{get_translation($city)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select wire:model.lazy="filter_agency_position" class="form-select form-select-lg">
                            <option value="">--{{ __('All Position')}}--</option>
                            @foreach($positions as $item)
                            <option value="{{$item->id}}">{{get_translation($item)}} ({{$item->abbreviation}})</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Date -->
                    <div class="col-lg-4 d-flex" id="sandbox-container">
                        <div class="input-group">
                            <input type="text" class="form-control" id="start_date" wire:model="start_date" />
                            <span class="input-group-text" id="basic-addon1" style="height: 40px; margin-top: 1px;"><i class="bi bi-calendar"></i></span>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="end_date" wire:model="end_date" />
                            <span class="input-group-text" id="basic-addon1" style="height: 40px; margin-top: 1px;"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center text-secondary text-sm">{{__('No.')}}</th>
                                    <th class="text-center text-secondary text-sm">{{__('Code')}}</th>
                                    <th class="text-secondary text-sm">
                                        <nobr>{{__('Agency Name')}}</nobr>
                                    </th>
                                    <th class="text-center text-secondary text-sm">
                                        <nobr>{{__('Gender')}}</nobr>
                                    </th>
                                    <th class=" text-secondary text-sm">{{__('Phone')}}</th>
                                    <th class="text-center text-secondary text-sm">{{__('Occupation')}}</th>
                                    <th class="text-center text-secondary text-sm">{{__('Income')}}</th>
                                    <th class="text-center text-secondary text-sm">
                                        <nobr>{{__('Leader')}}</nobr>
                                    </th>
                                    <th class="text-center text-secondary text-sm">{{__('Joined Date')}}</th>
                                    <th class="text-center text-secondary text-sm">
                                        <nobr>{{__('Working Day')}}</nobr>
                                    </th>
                                    <th class="text-center text-secondary text-sm">{{__('Status')}}</th>
                                    <th width="89" class="text-center text-secondary text-sm">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($agencies->isEmpty())
                                <tr>
                                    <td colspan="12" class="text-sm text-center">{{__('No Record Found.!')}}</td>
                                </tr>
                                @else
                                @foreach($agencies as $agency)
                                <tr style="vertical-align: middle;">
                                    <td class="text-sm text-center">
                                        {{ $loop->index + ($agencies->perPage() * ($agencies->currentPage() - 1)) + 1 }}
                                    </td>
                                    <td class="text-sm text-center">
                                        @if($agency->code)
                                        <span class="text right pointer" onclick="copyAgencyLink('{{ $agency->code }}')" id="agencyCode">
                                            {{$agency->code}}
                                        </span>
                                        @else
                                        <a href="#" wire:click="update_Code_Agency({{$agency->id}})">
                                            <i class="bi bi-plus-circle-dotted p-1"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td class="text-sm">
                                        <nobr>{{$agency->full_name}}</nobr>
                                    </td>
                                    <td class="text-sm text-center">{{__($agency->gender)}}</td>
                                    <td class="text-sm">
                                        <nobr>{{$agency->phone}}</nobr>
                                    </td>
                                    <td class="text-sm text-center">
                                        <nobr>{{$agency->occupation ? get_translation($agency->occupation) : ''}}</nobr>
                                    </td>
                                    <td class="text-sm text-center">{{$agency->income}}</td>
                                    <td class="text-sm text-center">
                                        {{$agency->parent->code ?? ''}}
                                    </td>
                                    <td class="text-sm text-center">
                                        <nobr>
                                            {{date('d/M/Y', strtotime($agency->created_at))}}
                                        </nobr>
                                    </td>
                                    <td class="text-sm text-center">
                                        <nobr>
                                            <?php $working_day = Carbon\Carbon::parse($agency->created_at)->diffInDays(Carbon\Carbon::now()->addDay()->startOfDay()) + 1; ?>
                                            {{$working_day}}
                                            {{($working_day <= 1 ? __('Day') : __('Days'))}}
                                        </nobr>
                                    </td>
                                    <td class="text-sm text-center">
                                        <button style="border-color:transparent;" type="button" wire:click="update_status_agency({{$agency->id}})" class="btn btn-outline-secondary rounded-pill">
                                            {{__(get_agency_status($agency->status)['label'])}}
                                        </button>
                                    </td>
                                    <td class="text-end">
                                        <nobr>
                                            @if($agency->position_id != 5)
                                            <a style="border-color:transparent;" wire:click="buttun_assign_shop({{$agency->id}})" class="rounded-pill btn btn-sm btn btn-outline-secondary">
                                                <i class="bi bi-shop"></i>
                                            </a>
                                            @endif
                                            <a style="border-color:transparent;" wire:click="btn_edit_agency({{$agency->id}})" class="rounded-pill btn btn-sm btn btn-outline-success">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a style=" border-color:azure;" wire:navigate href="{{route('agency.list', 'list?action=profile&agency_id='.$agency->id)}}" class="rounded-pill btn btn-sm btn-outline-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </nobr>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{$agencies->links('livewire.customer-pagination')}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @livewire('other.shop.assign-shop')


    <!--Generate Code Modal -->
    <div wire:ignore.self class="modal fade" id="updateCode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="" wire:submit.prevent="updateCode">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('Generate New Agency Code')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('livewire.agency.update-code')
                    </div>
                    <div class="modal-footer justify-content-center">
                        @if($code)
                        <button type="submit" class="btn btn-primary button_save">{{__('Generate Code')}}</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- updat Status -->
    <div wire:ignore.self class="modal fade" id="statusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" wire:submit.prevent="updateStatus">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('Update Status')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('livewire.agency.agency-status')
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class=" btn btn-primary button_save" data-bs-dismiss="modal">{{__('Update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
@push('scripts')
<script>
    function copyAgencyLink(agencyCode) {
        //copied the link
        var url = "{{url('/agency-register?referrer_code=')}}" + agencyCode;
        var input = document.createElement('input');
        input.setAttribute('value', url);
        document.body.append(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);

        //--Add Tooltip on copying
        var clickedElement = event.target;
        clickedElement.innerHTML = "<span data-bs-toggle='tooltip' data-bs-placement='top' title='Copied the link'>" + agencyCode + "</span>";
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        setTimeout(function() {
            clickedElement.innerHTML = agencyCode;
        }, 1000);
    }
    //--selected date--
    jQuery(document).ready(function() {
        jQuery('#start_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'XX',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        jQuery('#end_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'XX',
            uiLibrary: 'bootstrap5',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        jQuery('#start_date, #end_date').on('change', function() {
            @this.set('start_date', jQuery('#start_date').val());
            @this.set('end_date', jQuery('#end_date').val());
        });
    });
</script>
@endpush