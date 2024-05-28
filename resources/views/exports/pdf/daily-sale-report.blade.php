<div>
    <style>
        table,
        td {
            border: 1px solid gray;
            border-collapse: collapse;
            font-size: 12px;
            color: gray;
        }

        th {
            border: 1px solid grey;
            font-size: 12px;
            color: gray;
            width: 100%;
        }
    </style>
    <div class="table-responsive">
        <table class="table" style="border:none;">
            <thead>
                <tr style="border:none;">
                    <th colspan="2" style="border:none;">
                        <img src="data:image/png;base64,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" alt="Logo">
                    </th>
                    <th colspan="10" style="border:none; font-size: 15px;padding-bottom: 15px">
                        <h5 class="ml-5 text-danger Daily_report">{{env("APP_HEADER_NAME_KH")}}</h5>
                        <h5 class="text-danger fw-light">{{env("APP_HEADER_NAME")}}</h5>
                        <h3 style="color: blue;">{{ __('Daily Sale Report') }}</h3>
                        <h5 class="text-danger">{{__('Monthly')}} {{trans(date('F', strtotime($start_date))) }} {{__('Year')}} {{date('Y', strtotime($start_date))}}
                            ( {{date('d', strtotime($start_date)).'/' .__(date('F', strtotime($start_date))) .'/'.date('Y', strtotime($start_date))}} )
                            <i class="bi bi-arrow-right-short"></i>
                            ( {{date('d', strtotime($end_date)).'/' .__(date('F', strtotime($end_date))) .'/'.date('Y', strtotime($end_date))}} )
                        </h5>
                    </th>
                </tr>
                <tr style="border:none; padding-bottom: 15px;">
                    <th colspan="2" style="border:none; display: inline-block">
                        <p colspan="2">{{__('City')}}: {{$city_id ? \App\Models\City::find($city_id)->name : __('All City')}}</p>
                    </th>
                    <th colspan="2" style="border:none; display: inline-block">
                        <p>{{__('Shop Name')}}: {{ $selected_shop ? \App\Models\Shop::find($selected_shop)->shop_name : __('All Shop') }}</p>
                    </th>
                </tr>
                <tr>
                    <th colspan="7" style="border:none; font-size: 12px;padding-bottom: 10px"></th>
                </tr>
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
    <htmlpagefooter name="page-footer">

    </htmlpagefooter>
</div>