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
            <div class="p-2 d-flex">
                <div class="mt-1 text-sm">{{__('Expense List')}}</div>
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
                <div class="d-flex mb-3 justify-content-between">
                    <div class="d-flex p-2">
                        <!-- <div class="col-lg-6 mt-1 p-2">
                            <input class="form-control" placeholder="{{__('Type Search...')}}" type="search" wire:model.live.debounce="search">
                        </div> -->
                        <!-- Date -->
                        <div class="col-lg-6 d-flex mt-1 p-2">
                            <div class="input-group">
                                <input type="date" class="input-sm form-control datepicker" wire:model="start_date" />
                            </div>
                            <div class="input-group">
                                <input type="date" class="input-sm form-control datepicker" wire:model="end_date" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="p-2">
                            <div class="col-lg-12 col-sm-6">
                                <h6>{{__('Total For April')}}</h6>
                                <h4 class="text-center">${{__('150.00')}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex p-2">
                @foreach($applications as $app)
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card bg-primary rounded d-flex">
                            <div class="d-flex mb-3 justify-content-between">
                                <div class="p-2 d-flex">
                                    <div class="mt-1 text-white">{{__('Noted For')}} {{$app->created_at->format('Y-m-d')}}</div>
                                </div>
                                <div class="d-flex justify-content-end pointer" wire:click="btn_edit_application({{$app->id}})">
                                    <div class="p-2">
                                        <div class="col-lg-12 col-sm-6 text-info">
                                            <i class="bi bi-pencil-square"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex p-2">
                            <div class="col-lg-5 p-2" style="margin-top: -20px;">
                                <h6 class="p-1"><i class="bi bi-cart-plus p-2"></i> Items</h6>
                                <h6 class="p-1"> <i class="bi bi-brightness-alt-high-fill p-2"></i> Breakfast</h6>
                                <h6 class="p-1"> <i class="bi bi-brightness-high-fill p-2"></i> Lunch</h6>
                                <h6 class="p-1"> <i class="bi bi-brightness-alt-low-fill p-2"></i> Dinner</h6>
                                <h6 class="p-1"> <i class="bi bi-brightness-high-fill p-2"></i> Coffee X <strong class="text-danger">({{$app->amount_coffee}})</strong></h6>
                                <h6 class="p-1"> <i class="bi bi-brightness-alt-low-fill p-2"></i> Gasoline</h6>
                            </div>
                            <div class="col-lg-7 p-2" style="margin-top: -17px;">
                                <h6>Item Cost</h6>
                                <h6 class="mt-4"> <strong>៛ {{number_format($app->breakfast,2)}}</strong></h6>
                                <h6 class="mt-3"> <strong>៛ {{number_format($app->lunch,2)}}</strong></h6>
                                <h6 class="mt-3"> <strong>៛ {{number_format($app->dinner,2)}}</strong></h6>
                                <h6 class="mt-3"> <strong>៛ {{number_format($app->coffee_price,2)}}</strong></h6>
                                <h6 class="mt-3"> <strong>៛ {{number_format($app->gasoline_price,2)}}</strong></h6>
                            </div>
                            <div class="col-lg-12">
                                <h6 class="p-1"><i class="bi bi-brush p-2"></i> Remark
                                    <p class="p-3">
                                        @if($app->remark)
                                        {{$app->remark}}
                                        @else
                                        -
                                        @endif
                                    </p>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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