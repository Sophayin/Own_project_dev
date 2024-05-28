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
                    <h5 class="text-primary Daily_report">{{ __('Report on Commionsion Fees to LCs') }}</h5>
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
                    <div class="col-lg-1 d-none d-sm-block p-2 " style="width: 13%;">
                        <select wire:model.live="positionId" class="form-control form-select border-0 bg-light" style="height: 40px; margin-left: 3px;">
                            <option value="">{{__('All Position')}} </option>
                            @foreach ($positions as $position)
                            <option value="{{ $position->id }}"> {{get_translation($position)}} ({{$position->abbreviation}})</option>
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
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('No.')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">
                                    <nobr>{{__('Agency Name (English)')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm opacity-7">
                                    <nobr>{{__('Agency Name (Khmer)')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Position')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Target Sale')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Total Sale')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Commission')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Total Payment')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Leader Name')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Leader Code')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Bank Account / Name')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Bank Name')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agenciesPayroll as $i => $payroll)
                            <tr class="text-center">
                                <td class="text-secondary text-sm index-id">{{++$i}}</td>
                                <td class="text-secondary text-sm">{{$payroll->agency->full_name}}</td>
                                <td class="text-secondary text-sm">{{$payroll->agency->full_name_translate}}</td>
                                <td class="text-secondary text-sm">{{get_translation($payroll->agency->position)}} ({{($payroll->agency->position->abbreviation)}})</td>
                                <td class="text-secondary text-sm">{{$payroll->target_sale}}</td>
                                <td class="text-secondary text-sm">{{$payroll->total_sale}}</td>
                                <td class="text-secondary text-sm">{{"$" . number_format($payroll->commission_fee,2)}}</td>
                                <td class="text-secondary text-sm">{{"$" . number_format($payroll->total_payroll,2)}}</td>
                                <td class="text-secondary text-sm">{{$payroll->agency->parent->full_name?? ''}}</td>
                                <td class="text-secondary text-sm">{{$payroll->agency->parent->code?? ''}}</td>
                                <td class="text-secondary text-sm">
                                    <?php $bankInfo = json_decode($payroll->agency->bank_info, true); ?>
                                    @if (!empty($bankInfo))
                                    @foreach ($bankInfo as $bank)
                                    @if (isset($bank['status']) && $bank['status'] === true)
                                    <div>{{ $bank['account_name'] }} : {{ $bank['account_number'] }}</div>
                                    @endif
                                    @endforeach
                                    @endif
                                </td>
                                <td class="text-secondary text-sm">
                                    <?php $bankInfo = json_decode($payroll->agency->bank_info, true); ?>
                                    @if (!empty($bankInfo))
                                    @foreach ($bankInfo as $bank)
                                    @if (isset($bank['status']) && $bank['status'] === true)
                                    <div>{{ $bank['name'] }}</div>
                                    @endif
                                    @endforeach
                                    @endif
                                </td>
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
                        <a class="dropdown-item" href="#" wire:click="download_pdf">
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