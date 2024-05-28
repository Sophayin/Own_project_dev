<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overrride Commission Report</title>
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
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Agency Name')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Agency Name (English)')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Position')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Own Sale')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Direct Sale')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Sale By Indirect Team')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Total Sale')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Recruit By Team')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Total Recruit')}}</th>
                    <th colspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Target')}}</th>
                    <th colspan="1" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Payment')}}</th>
                    <th rowspan="2" class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Total Payment')}} </th>
                </tr>
                <tr>
                    <th class="text-center text-secondary text-sm font-weight-bolder opacity-7">{{__('Salary/Incentive')}}</th>
                    <th class="text-center text-secondary text-sm font-weight-bolder opacity-7"> {{__('Overriding Commission/Sale')}} </th>
                    <th class="text-center text-secondary text-sm font-weight-bolder opacity-7">{{__('Overrriding Commission')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agenciesPayroll as $i=> $payroll)
                <tr class="text-center">
                    <td class="text-secondary text-sm index-id">{{++$i}}</td>
                    <td class="text-secondary text-sm">{{$payroll->agency->code?? ''}}</td>
                    <td class="text-secondary text-sm">{{$payroll->agency->full_name}}</td>
                    <td class="text-secondary text-sm">{{$payroll->agency->full_name_translate}}</td>
                    <td class="text-secondary text-sm">{{get_translation($payroll->agency->position)}} ({{$payroll->agency->position->abbreviation?? ''}})</td>
                    <td class="text-secondary text-sm">{{$payroll->direct_sale}}</td>
                    <td class="text-secondary text-sm">{{$payroll->sale_by_team}}</td>
                    <td class="text-secondary text-sm">{{$payroll->sale_by_team}}</td>
                    <td class="text-secondary text-sm">{{$payroll->total_sale}}</td>
                    <td class="text-secondary text-sm">{{$payroll->recruit_by_team}}</td>
                    <td class="text-secondary text-sm">{{$payroll->total_recruit}}</td>
                    <td class="text-secondary text-sm">{{"$". number_format($payroll->salary,2)}}</td>
                    <td class="text-secondary text-sm">{{"$". number_format($payroll->incentive,2)}}</td>
                    <td class="text-secondary text-sm">{{"$". number_format($payroll->override_fee,2)}}</td>
                    <td class="text-secondary text-sm">{{"$". number_format($payroll->total_payroll,2)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>