<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Sale Report</title>
</head>

<body>
    <table class="table-border">
        <thead class="thead-inline d-flex">
            <tr>
                <th colspan="2" style="border:none; display: inline-block">
                    <p>{{__('Shop Name')}}: {{ $selected_shop ? \App\Models\Shop::find($selected_shop)->shop_name : __('All Shop') }}</p>
                </th>
                <th colspan="1">{{__('From Date')}}: {{ date('d-m-y', strtotime($start_date)) }}</th>
                <th colspan="2">{{__('To Date')}}: {{ date('d-m-y', strtotime($end_date)) }}</th>
            </tr>
            <tr>
                <th colspan="2">{{__('Date')}}</th>
                <th colspan="3">{{__('Shop Name')}}</th>
                <th colspan="3">{{__('Client Name')}}</th>
                <th colspan="2">{{__('Client Phone Number')}}</th>
                <th colspan="2">{{__('Client Address')}}</th>
                <th colspan="2">{{__('Agency Code')}}</th>
                <th colspan="2">{{__('Referee')}}</th>
                <th colspan="2">{{__('Referee Phone')}}</th>
                <th colspan="4">{{__('Product Name')}}</th>
                <th colspan="2">{{__('Price')}}</th>
                <th colspan="2">{{__('Respond By')}}</th>
                <th colspan="2">{{__('Status')}}</th>
                <th colspan="3">{{__('Approve By')}}</th>
                <th colspan="2">{{__('Date Follow UP')}}</th>
                <th colspan="3">{{__('Reason')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $i => $application)
            <tr>
                <td colspan="2">{{ $application->created_at->format('d/m/Y') }}</td>
                <td colspan="3">{{ $application->shop->shop_name }}</td>
                <td colspan="3">{{ $application->client_name }}</td>
                <td colspan="2">{{ $application->phone }}</td>
                <td colspan="2">{{ $application->address ? ($application->address->city ? get_translation($application->address->city): ""): "" }}</td>
                <td colspan="2">{{ $application->agency ? $application->agency->code : "" }}</td>
                <td colspan="2">{{ $application->guarantor_name }}</td>
                <td colspan="2">{{ $application->guarantor_phone }}</td>
                <td colspan="4">{{ $application->product->title }}</td>
                <td colspan="2">${{number_format($application->product->price,2)}}</td>
                <td colspan="2">{{ $application->respond_by}}</td>

                <td colspan="2">
                    <button style="border-color:transparent;" type="button" class="btn btn-outline-secondary text rounded-pill btn-sm">
                        {{__(get_application_status($application->status)['label'])}}
                    </button>
                </td>
                <td colspan="3">{{ $application->loan_company ? $application->loan_company->name : "" }}</td>
                <td colspan="2">{{ $application->updated_at->format('d/m/Y') }}</td>
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
</body>

</html>