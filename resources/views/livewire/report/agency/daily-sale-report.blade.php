<div>
    <section class="section">
        <h3 class="p-3">
            <a wire:navigate href="{{route('report', 'agency')}}">
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
                    <h5 class="text-primary Daily_report">{{ __('Daily Sale Report') }}</h5>
                    <div class="text-danger">{{__('Monthly')}} {{trans(date('F', strtotime($start_date))) }} {{__('Year')}} {{date('Y', strtotime($start_date))}}
                        ( {{date('d', strtotime($start_date)).'/' .__(date('F', strtotime($start_date))) .'/'.date('Y', strtotime($start_date))}} )
                        <i class="bi bi-arrow-right-short"></i>
                        ( {{date('d', strtotime($end_date)).'/' .__(date('F', strtotime($end_date))) .'/'.date('Y', strtotime($end_date))}} )
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="d-flex p-2">
                    <div class="col-lg-1 d-none d-sm-block p-2 " style="width: 10%;">
                        <select wire:model.live="city_id" class="form-select border-0 bg-light">
                            <option value="">{{__('All City')}} </option>
                            @foreach ($getCities as $city)
                            <option value="{{ $city->id }}"> {{get_translation($city)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 d-none d-sm-block p-2" style="width: 12%;">
                        <select wire:model.live="selected_shop" class=" form-select border-0 bg-light">
                            <option value="">{{__('All Shop')}} </option>
                            @foreach ($getShops as $shop)
                            <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 d-none d-sm-block p-2" style="width: 12%;">
                        <select wire:change="onFilterStatus($event.target.value)" class=" form-select border-0 bg-light">
                            <option value="">{{__('All')}}</option>
                            @foreach(get_application_status() as $status)
                            <option value="{{$status['id']}}">{{__($status['label'])}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Date -->
                    <div class="col-lg-4 d-flex mt-2" id="sandbox-container">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" id="start_date" wire:model.live="start_date" style="height: 33px;" />
                            <span class="input-group-text" id="basic-addon1" style="height: 33px; margin-top: 1px;"><i class="bi bi-calendar"></i></span>
                        </div>
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" id="end_date" wire:model.live="end_date" style="height: 33px;" />
                            <span class="input-group-text" id="basic-addon1" style="height: 33px; margin-top: 1px;"><i class="bi bi-calendar"></i></span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive ">
                    <table class="table table-sm ">
                        <thead>
                            <tr class="text_header">
                                <th class="text-center text-secondary text-sm opacity-7">
                                    {{__('No.')}}
                                </th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Date')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Shop Name')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">
                                    <nobr>{{__('Client Name')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm opacity-7">
                                    <nobr>{{__('Client Phone Number')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm opacity-7">{{__('Client Address')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">
                                    <nobr>{{__('Agency Code')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm opacity-7">
                                    <nobr>{{__('Referee')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm opacity-7">
                                    <nobr>{{__('Referee Phone')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm opacity-7">
                                    <nobr>{{__('Product Name')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm opacity-7"> {{__('Price')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7"> {{__('Respond By')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7"> {{__('Status')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7"> {{__('Date Follow Up')}}</th>
                                <th class="text-center text-secondary text-sm opacity-7"> {{__('Reason')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $i => $item)
                            <tr class="text text-center">
                                <td class="text-secondary text-sm index-id">
                                    {{++$i}}
                                </td>
                                <td class="text-secondary text-sm">{{$item->created_at->format('d/M/Y')}}</td>
                                <td class="text-secondary text-sm">
                                    <nobr>{{$item->shop->shop_name ?? ''}}</nobr>
                                </td>
                                <td class="text-secondary text-sm">
                                    <nobr>{{$item->client_name}}</nobr>
                                </td>
                                <td class="text-secondary text-sm">{{$item->phone}}</td>
                                <td class="text-secondary text-sm">{{$item->address && $item->address->city? get_translation($item->address->city):  ""}}
                                </td>
                                <td class="text-secondary text-sm">{{$item->agency_code}}</td>
                                <td class="text-secondary text-sm">{{$item->guarantor_name}}</td>
                                <td class="text-secondary text-sm">{{$item->guarantor_phone}}</td>
                                <td class="text-secondary text-sm">{{$item->product_name}}</td>
                                <td class="text-secondary text-sm">${{number_format($item->product_price,0,2)}}</td>
                                <td class="text-secondary text-sm">{{$item->respond_by}}</td>
                                <td class="cursor-pointer status">
                                    <?php $color_status = $item->status == 1 ? 'info' : ($item->status == 2 ? 'success' : 'danger'); ?>
                                    <span class="text-{{$color_status}}">{{__(get_application_status($item->status)['label'])}}</span>
                                </td>
                                <td class="text-secondary text-sm">{{$item->updated_at->format('d/m/Y')}}</td>
                                <td class=" text-secondary text-sm">
                                    @if($item->application_status->isNotEmpty())
                                    <ul class="text-wrap">
                                        @foreach($item->application_status as $status)
                                        @if($status->reason)
                                        <li class="text-start">
                                            <nobr>{{ $status->reason ? get_translation($status->reason) : '' }}</nobr>
                                        </li>
                                        @endif
                                        @if($status->reason_text)
                                        <li class="text-start">
                                            <nobr>{{ $status->reason_text }} </nobr>
                                        </li>
                                        @endif
                                        @endforeach
                                    </ul>
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
                @if($applications != null && $applications->count() >0)
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