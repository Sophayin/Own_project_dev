<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Reports</title>
</head>

<body>
    <div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">{{__('From Date')}}: {{ date('d-m-y', strtotime($start_date)) }}</th>
                        <th colspan="2">{{__('To Date')}}: {{ date('d-m-y', strtotime($end_date)) }}</th>
                    </tr>
                    <tr class="text-center">
                        <th class="text-center text-secondary text-sm opacity-7">{{__('No.')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Agency Name')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Agency Name (latin)')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Position')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Target Recruit')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Target Sale')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Total Recruit')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Total Sale')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Incentive')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Commission')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Salary')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Overriding')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Start Date')}}</th>
                        <th class="text-center text-secondary text-sm opacity-7">{{__('Remark')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agenciesPayroll as $payroll)
                    <tr class="text-center">
                        <td>{{$payroll->id}}</td>
                        <td class="text-secondary text">{{$payroll->agency->full_name}}</td>
                        <td class="text-secondary text">{{$payroll->agency->full_name_translate}}</td>
                        <td class="text-secondary text">{{get_translation($payroll->agency->position)}}</td>
                        <td class="text-secondary text">{{$payroll->target_recruit}}</td>
                        <td class="text-secondary text">{{$payroll->target_sale}}</td>
                        <td class="text-secondary text">{{$payroll->total_recruit}}</td>
                        <td class="text-secondary text">{{$payroll->total_sale}}</td>
                        <td class="text-secondary text">{{$payroll->incentive}}</td>
                        <td class="text-secondary text">{{$payroll->commission_fee}}</td>
                        <td class="text-secondary text">{{$payroll->salary}}</td>
                        <td class="text-secondary text">{{$payroll->override_fee}}</td>
                        <td class="text-secondary text">{{$payroll->created_at->format('d/m/Y')}}</td>
                        <td class="text-secondary text">{{$payroll->remark}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>