<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruit</title>
</head>

<body>
    <div class="table-responsive ">
        <table class="table ">
            <thead>
                <tr>
                    <th colspan="2" style="border:none; display: inline-block">
                        <p>{{__('Positions')}}: {{ $position_id ? \App\Models\Position::find($position_id)->name : __('All Positions') }}</p>
                    </th>
                    <th colspan="1">{{__('From Date')}}: {{ date('d-m-y', strtotime($start_date)) }}</th>
                    <th colspan="1">{{__('To Date')}}: {{ date('d-m-y', strtotime($end_date)) }}</th>
                </tr>
                <tr>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <div class="d-flex">
                            {{__('No.')}}
                        </div>
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Code')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Agency Name')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Agency Name (latin)')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Gender')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Register Date')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Working Day')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Summary')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Address')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Khmer Identity Card')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Leader')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7"> {{__('Bank Account Number')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agencies as $i => $agency)
                <tr class="text text-center">
                    <td> {{++$i}} </td>
                    <td>{{$agency->code}}</td>
                    <td>{{$agency->full_name_translate}}</td>
                    <td>{{$agency->full_name}}</td>
                    <td>{{__($agency->gender)}}</td>
                    <td>{{$agency->created_at->format('d-m-y')}}</td>
                    <td>
                        {{ Today()->diffInDays(Carbon\Carbon::parse($agency->created_at)) }} {{__("Days")}}
                    </td>
                    <td>{{$agency->remark}}</td>
                    <td> {{$agency->address ? ($agency->address->city? $agency->address->city->name: ""): ""}} </td>
                    <td>{{$agency->khmer_identity_card}}</td>
                    <td>{{$agency->parent->code ??  ""}}</td>
                    <td>
                        <?php $getbank = json_decode($agency->bank_info, true); ?>
                        @if(!empty($getbank) )
                        @foreach($getbank as $bank)
                        <div>{{$bank['name']}} : {{$bank['account_number']}} </div>
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