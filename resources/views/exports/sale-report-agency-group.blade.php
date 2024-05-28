<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sale Report Agency By Group</title>
</head>

<body>
    <div class="table-responsive p-0">
        <table class="table table-sm">
            <thead>
                <tr>
                    <td class="text text-sm text-secondary opacity-5"> {{__('Agency Code')}} </td>
                    <td class="text text-secondary text-sm opacity-7">{{__('Agency Name')}}</td>
                    <td class="text text-secondary text-sm opacity-7">{{__('Position')}}</td>
                    <td class="text text-secondary text-sm opacity-7">{{__('Manage By')}}</td>
                    <!--<td class="text text-secondary text-sm opacity-7">{{__('Shop Name')}} </td>-->
                    <td class="text text-center text-secondary text-sm opacity-7">{{__('Total Sale')}} </td>
                    <td class="text text-center text-secondary text-sm opacity-7">{{__('Total Recruit')}}</td>
                    <td class="text text-center text-secondary text-sm opacity-7">{{__('Award')}}</td>
                </tr>
            </thead>
            <tbody>
                @foreach($agencies as $key => $agency)
                <?php $position = App\Models\Position::find($agency->position_id); ?>
                <?php $leader = App\Models\Agency::find($agency->agency_id); ?>
                <?php $sub_agencies = App\Models\Agency::where('agency_id', $agency->id)->with("children.children.children.children")->get(); ?>
                <tr>
                    <th class="text-secondary text-sm opacity-7">{{$agency->code}}</th>
                    <th class="text-secondary text-sm opacity-7">{{$agency->full_name}}</th>
                    <th class="text-secondary text-sm opacity-7">{{$position->abbreviation ?? ''}}</th>
                    <th class="text-secondary text-sm opacity-7">{{$leader->code ?? ''}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{ $agency->total_sale}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{ $agency->total_recruit}}</th>
                    <td class="text-center text text-sm">{{get_award($agency->total_sale, $agency->total_recruit, $agency->position_id)}}</td>
                </tr>
                @foreach($sub_agencies as $key => $_ageny)

                @include('livewire.report.agency.levelagency.agency-list-report', ['agency' => $_ageny, 'key'=> $key])
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>