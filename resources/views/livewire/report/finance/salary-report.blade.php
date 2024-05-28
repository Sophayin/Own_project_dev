<div>
    <section class="section">
        <h3 class="p-3">
            <a wire:navigate href="{{route('report', 'finance')}}">
                <i class="bi bi-arrow-left-short"></i>
            </a>
        </h3>
        <div class="container-fluid" id="printable-div">
            <div class="row">
                <h4 class="col-lg-3 col-md-3 col-sm-0 d-block">
                    <img src="{{asset('assets/svg/logo121.png')}}" alt="{{env('APP_HEADER_NAME_KH')}}" width="150px">
                </h4>
                <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                    <h5 class="ml-5 text-danger Daily_report">{{env("APP_HEADER_NAME_KH")}}</h5>
                    <h5 class="text-danger fw-light">{{env("APP_HEADER_NAME")}}</h5>
                    <h5 class="text-primary Daily_report">{{__('Salary Report')}} BD/BM/CA</h5>
                    <div class="text-danger">{{__('Monthly')}} {{trans(date('F', strtotime($start_date))) }} {{__('Year')}} {{date('Y', strtotime($start_date))}}
                        ( {{date('d', strtotime($start_date)).'/' .__(date('F', strtotime($start_date))) .'/'.date('Y', strtotime($start_date))}} )
                        <i class="bi bi-arrow-right-short"></i>
                        ( {{date('d', strtotime($end_date)).'/' .__(date('F', strtotime($end_date))) .'/'.date('Y', strtotime($end_date))}} )
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="d-flex p-2">
                    <div class="col-lg-1 d-none d-sm-block p-2 " style="width: 15%;">
                        <select wire:model.live="city_id" class="form-control form-select border-0 bg-light" style="height: 40px; margin-left: 3px;">
                            <option value="">{{__('All City')}} </option>
                            @foreach ($getCities as $city)
                            <option value="{{ $city->id }}">{{get_translation($city) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 p-2 d-flex">
                        <div class="row d-flex">
                            <!-- Date -->
                            <div class="col-lg-12 d-flex" id="sandbox-container">
                                <div class="input-group">
                                    <input type="text" class="input-sm form-control" id="start_date" wire:model.live="start_date" style="height: 38px;" />
                                    <span class="input-group-text" id="basic-addon1" style="height: 38px; margin-top: 1px;"><i class="bi bi-calendar"></i></span>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="input-sm form-control" id="end_date" wire:model.live="end_date" style="height: 38px;" />
                                    <span class="input-group-text" id="basic-addon1" style="height: 38px; margin-top: 1px;"><i class="bi bi-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center text-secondary text-sm opacity-7">{{__('No.')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Agency Name')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Agency Name (English)')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Position')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Target Recruit')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Target Sale')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Total Recruit')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Total Sale')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Incentive')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Commission')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Salary')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Overriding')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Total Payment')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Start Date')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Remark')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agenciesPayroll as $i => $payroll)
                            <tr class="text-center">
                                <td class="text-secondary text-sm index-id">{{++$i}}</td>
                                <td class="text-secondary text-sm">{{$payroll->agency->full_name}}</td>
                                <td class="text-secondary text-sm">{{$payroll->agency->full_name_translate}}</td>
                                <td class="text-secondary text-sm">{{get_translation($payroll->agency->position)}}</td>
                                <td class="text-secondary text-sm">{{$payroll->target_recruit}}</td>
                                <td class="text-secondary text-sm">{{$payroll->target_sale}}</td>
                                <td class="text-secondary text-sm">{{$payroll->total_recruit}}</td>
                                <td class="text-secondary text-sm">{{$payroll->total_sale}}</td>
                                <td class="text-secondary text-sm">{{$payroll->incentive}}</td>
                                <td class="text-secondary text-sm">{{$payroll->commission_fee}}</td>
                                <td class="text-secondary text-sm">{{$payroll->salary}}</td>
                                <td class="text-secondary text-sm">{{$payroll->override_fee}}</td>
                                <td class="text-secondary text-sm">{{$payroll->total_payroll}}</td>
                                <td class="text-secondary text-sm">{{$payroll->created_at->format('d/m/Y')}}</td>
                                <td class="text-secondary text-sm">{{$payroll->remark}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div class="mb-3">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-2 d-flex justify-content-center">
                @if($agenciesPayroll !=null && $agenciesPayroll->count() >0)
                <button class="btn btn-primary button_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{__('Download')}}
                </button>
                <ul class="dropdown-menu justify-content-center">
                    <li class="d-flex justify-content-center text">
                        <a class="dropdown-item" href="#" wire:click='download_pdf'>
                            <i class="bi bi-download"></i> PDF (.pdf)
                        </a>
                    </li>
                    <li class="d-flex justify-content-center text">
                        <a class="dropdown-item" href="#" wire:click='download_excel'>
                            <i class="bi bi-download"></i> Excel (.xlsx)
                        </a>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    //--selected date--
    jQuery(document).ready(function() {
        $('#start_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'XX',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        $('#end_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'XX',
            uiLibrary: 'bootstrap5',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        $('#start_date, #end_date').on('change', function() {
            @this.set('start_date', $('#start_date').val());
            @this.set('end_date', $('#end_date').val());
        });
    });
</script>
@endpush