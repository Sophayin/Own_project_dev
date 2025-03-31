<div>
    @if($action === 'create')
    @livewire('sales.applications.create')
    @elseif($action === 'import')
    @livewire('sales.applications.import-file-application')
    @elseif($action === 'update')
    @livewire('sales.applications.update', ['application_id' => $application_id])
    @elseif($action === 'view')
    @livewire('sales.applications.view-application', ['application_id' => $application_id])
    @else
    <section class="section">
        <div class="d-flex mb-3 justify-content-between">
            <div class="p-2 app_section d-flex">
                <div class="mt-1 text-sm">{{__('Application List')}} - {{__('Status')}}</div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="p-2">
                    <div class="col-lg-12 col-sm-6">
                        <a wire:click="btn_add_application">
                            <button class="btn btn-primary button_save ">
                                <i class="bi bi-plus-circle"></i>
                                {{__('Add Expend')}}
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body mt-2">
                <div class="row">
                    <div class="col-lg-2 mt-1">
                        <input class="form-control" placeholder="{{__('Type Search...')}}" type="search" wire:model.live.debounce="search">
                    </div>
                    <!-- Date -->
                    <div class="col-lg-4 d-flex mt-2">
                        <div class="input-group">
                            <input type="date" class="input-sm form-control datepicker" wire:model="start_date" />
                        </div>
                        <div class="input-group">
                            <input type="date" class="input-sm form-control datepicker" wire:model="end_date" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text_header">
                            <th class="text-secondary text-center text-sm">{{__('Date')}}</th>
                            <th class="text-secondary text-sm ">
                                {{__('Breakfast')}}
                            </th>
                            <th class="text-secondary text-sm">
                                {{__('lunch')}}
                            </th>
                            <th class="text-secondary text-sm">
                                {{__('dinner')}}
                            </th>
                            <th class="text-secondary text-sm">
                                {{__('amount coffee')}}
                            </th>
                            <th class="text-secondary text-sm">
                                {{__('coffee_price')}}
                            </th>
                            <th class="text-secondary text-center text-sm">
                                {{__('gasoline')}}
                            </th>
                            <th class="text-secondary text-center text-sm">
                                {{__('gasoline_price')}}
                            </th>
                            <th class="text-secondary text-center text-sm">
                                {{__('party expend')}}
                            </th>
                            <th class="text-secondary text-center text-sm" width="85px">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($applications->isEmpty())
                        <tr>
                            <td colspan="12" class="text-center">{{__("No Record Found.!")}}</td>
                        </tr>
                        @else
                        @foreach($applications as $app)
                        <tr class="text" style="vertical-align: middle;">
                            <td class="text-sm text-center">
                                {{$app->created_at->format('Y-m-d')}}
                            </td>
                            <td class="text-sm">
                                <nobr>៛ {{$app->breakfast}}</nobr>
                            </td>
                            <td class="text-sm">
                                <nobr>៛ {{$app->lunch}}</nobr>
                            </td>
                            <td class="text-sm">៛ {{$app->dinner}}</td>
                            <td class="text-sm">{{$app->amount_coffee}}/ Cup</td>
                            <td class="text-sm">{{$app->coffee_price}}</td>
                            <td class="text-sm text-center">
                                <nobr>{{$app->gasoline}}</nobr>
                            </td>
                            <td class="text-sm">{{$app->gasoline_price}}</td>
                            <td class="text-sm text-center">
                                {{$app->party_expend}}
                            </td>
                            <td class="text-sm text-end">
                                <nobr>
                                    @if(!$app->is_payroll)
                                    <a style="border-color:azure;" wire:click="btn_edit_application({{$app->id}})" class="rounded-pill btn btn-sm btn-outline-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @endif
                                    <a style=" border-color:azure;" wire:click="btn_preview_application({{$app->id}})" class="rounded-pill btn btn-sm btn-outline-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </nobr>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                {{$applications->links('livewire.customer-pagination')}}
            </div>
        </div>
    </section>
    @livewire('sales.applications.application-status')
    @endif
</div>
<script type="text/javascript">
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