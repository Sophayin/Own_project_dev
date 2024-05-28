<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allowence Report</title>
</head>

<body>
    <div class="table-responsive">
        <table class="table" style="border:none;">
            <thead>
                <tr>
                    <th colspan="2">{{__('From Date')}}: {{ date('d-m-y', strtotime($start_date)) }}</th>
                    <th colspan="2">{{__('To Date')}}: {{ date('d-m-y', strtotime($end_date)) }}</th>
                </tr>
                <tr class="text-center">
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('No.')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Code')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7">{{__('Agency Name')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7">{{__('Agency Name (English)')}} </th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7">{{__('Position')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Own Sale')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Own Sale')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Sale By Indirect Team')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Total Recruit')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Total Recruit')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Target')}}</th>
                    <th colspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Payment')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Total Payment')}} </th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Bank Account / Name')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Bank Name')}}</th>
                </tr>
                <tr>
                    <th class="text-center text-secondary text-sm font-weight-bolder opacity-7">{{__('Salary')}}</th>
                    <th class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Incentive')}} </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($agencyIncentives as $i => $agenIncentive )
                <tr class="text-center">
                    <td class="text-secondary text-sm index-id">{{++$i}}</td>
                    <td class="text-secondary text-sm">{{$agenIncentive->agency_code}}</td>
                    <td class="text-secondary text-sm">{{$agenIncentive->agency->full_name_translate ?? ''}}</td>
                    <td class="text-secondary text-sm">{{$agenIncentive->agency->full_name ?? ''}}</td>
                    <td class="text-secondary text-sm">{{$agenIncentive->agency->position->name ?? ''}} ({{$agenIncentive->agency->position->abbreviation ?? ''}})</td>
                    <td class="text-secondary text-sm">{{$agenIncentive->own_sale}}</td>
                    <td class="text-secondary text-sm">{{$agenIncentive->sale_by_team}}</td>
                    <td class="text-secondary text-sm">{{$agenIncentive->indirect_sale_team}}</td>
                    <td class="text-secondary text-sm">{{$agenIncentive->total_sale}}</td>
                    <td class="text-secondary text-sm">{{$agenIncentive->total_recruit}}</td>
                    <?php $award = get_award($agenIncentive->total_sale, $agenIncentive->total_recruit, $agenIncentive->agency->position_id); ?>
                    <td class="text-center">
                        @if($award)
                        <?php $color = '#484848'; ?>
                        @if($award == 'Bronze')
                        <?php $color = '#CD7F32'; ?>
                        @elseif ($award == 'Gold')
                        <?php $color = '#D4AF37'; ?>
                        @elseif($award == 'Silver')
                        <?php $color = '#C0C0C0'; ?>
                        @endif
                        <span style="background: {{$color}};" class="badge rounded-pill ">{{__($award)}}</span>
                        @endif
                    </td>
                    <td class="text-secondary text-sm">{{ "$" . number_format($agenIncentive->salary,2)}}</td>
                    <td class="text-secondary text-sm">{{ "$" . number_format($agenIncentive->incentive,2)}}</td>
                    <td class="text-secondary text-sm">{{ "$" . number_format($agenIncentive->total_payroll,2)}}</td>
                    <td class="text-secondary text-sm">
                        <?php $bankInfo = json_decode($agenIncentive->agency->bank_info, true); ?>
                        @if (!empty($bankInfo))
                        @foreach ($bankInfo as $bank)
                        @if (isset($bank['status']) && $bank['status'] === true)
                        <div>{{ $bank['account_name'] }} : {{ $bank['account_number'] }}</div>
                        @endif
                        @endforeach
                        @endif
                    </td>
                    <td class="text-secondary text-sm">
                        <?php $bankInfo = json_decode($agenIncentive->agency->bank_info, true); ?>
                        @if (!empty($bankInfo))
                        @foreach ($bankInfo as $bank)
                        @if (isset($bank['status']) && $bank['status'] === true)
                        <div> {{ $bank['name'] }}</div>
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