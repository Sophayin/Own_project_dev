<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Reports By Shop</title>
</head>

<body>
    <div class="table ">
        <table class="table ">
            <thead>
                <tr>
                    <th colspan="3" style="border:none; display: inline-block">
                        <p>{{__('Shop Name')}}: {{ $selected_shop ? \App\Models\Shop::find($selected_shop)->shop_name : __('All Shop') }}</p>
                    </th>
                    <th colspan="2">{{__('From Date')}}: {{ date('d-m-y', strtotime($start_date)) }}</th>
                    <th colspan="2">{{__('To Date')}}: {{ date('d-m-y', strtotime($end_date)) }}</th>
                </tr>
                <tr>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <div class="d-flex">
                            {{__('No')}}
                        </div>
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Date')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Shop Name')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Client Name')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Client Phone Number')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Client Address')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Agency Code')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Referee')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Referee Phone')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Product Name')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Price')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Respond By')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Status')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Date Follow Up')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Reason')}}</th>
                </tr>
            </thead>
            <tbody>

                @foreach($applications as $i => $application)
                <tr class="text">
                    <td>
                        {{++$i}}
                    </td>
                    <td>{{$application->created_at->format('d-m-y')}}</td>
                    <td>{{$application->shop->shop_name}}</td>
                    <td>{{$application->client_name}}</td>
                    <td>{{$application->phone}}</td>
                    <td>{{$application->address ? ($application->address->city ?$application->address->city->name: ""): ""}}
                    </td>
                    <td>{{$application->agency? $application->agency->code: ""}}</td>
                    <td>{{$application->guarantor_name}}</td>
                    <td>{{$application->guarantor_phone}}</td>
                    <td>{{$application->product->title}}</td>
                    <td>{{$application->product->price}}</td>
                    <td>{{$application->respond_by}}</td>
                    <td>
                        <button style="border-color:transparent;" type="button" class="btn btn-outline-secondary text rounded-pill btn-sm">
                            {{__(get_application_status($application->status)['label'])}}
                        </button>
                    </td>
                    <td>{{$application->updated_at->format('d/m/Y')}}</td>
                    @if($application->application_status->isNotEmpty())
                    <td class=" text-secondary text-sm">
                        @foreach($application->application_status as $status)
                        <small>{{ $status->reason_text ?? "" }}</small>
                        <small>{{ $status->reason->name ?? "" }}</small>
                        @endforeach
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>