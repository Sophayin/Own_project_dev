<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Commission Reports</title>
</head>

<body>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="2">{{__('From Date')}}: {{ date('d-m-y', strtotime($start_date)) }}</th>
                    <th colspan="2">{{__('To Date')}}: {{ date('d-m-y', strtotime($end_date)) }}</th>
                </tr>
                <tr>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('No.')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Agency Name (English)')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Agency Name (Khmer)')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Position')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Target Sale')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Total Sale')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Commission')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Total Payment')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Under BM/CA')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Leader Code')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Bank Account')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Bank Name')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agenciesPayroll as $i=> $payroll)
                <tr class="text-center">
                    <td class="text-secondary text-sm index-id">{{++$i}}</td>
                    <td class="text-secondary text-sm">{{$payroll->agency->full_name}}</td>
                    <td class="text-secondary text-sm">{{$payroll->agency->full_name_translate}}</td>
                    <td class="text-secondary text-sm">{{get_translation($payroll->agency->position)}} ({{($payroll->agency->position->abbreviation)}})</td>
                    <td class="text-secondary text-sm">{{$payroll->target_sale}}</td>
                    <td class="text-secondary text-sm">{{$payroll->total_sale}}</td>
                    <td class="text-secondary text-sm">{{ "$". number_format($payroll->commission_fee,2)}}</td>
                    <td class="text-secondary text-sm">{{ "$". number_format($payroll->total_payroll,2)}}</td>
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
</body>

</html>