<div>
    <style>
        table,
        td {
            justify-content: center;
            border: 1px solid gray;
            border-collapse: collapse;
            font-size: 12px;
            color: gray;
            text-align: center;
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
                    <th colspan="5" style="border:none; font-size: 15px;padding-bottom: 15px">
                        <h3 style="color: blue;">{{ __('Postions') }}</h3>
                    </th>
                </tr>
                <tr>
                    <th colspan="7" style="border:none; font-size: 12px;padding-bottom: 10px"></th>
                </tr>
                <tr class="text_header">
                    <th class="text-center text-secondary text-sm opacity-7">
                        {{__('No.')}}
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Name')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Abbreviation')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <nobr>{{__('Code')}}</nobr>
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <nobr>{{__('Khmer')}}</nobr>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($positions as $i => $position)
                <tr class="text text-center">
                    <td class="text-secondary text-sm index-id">
                        {{$position->id}}
                    </td>
                    <td class="text-secondary text-sm">{{$position->name}}</td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$position->abbreviation}}</nobr>
                    </td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$position->code}}</nobr>
                    </td>
                    <td class="text-secondary text-sm">
                        <?php $getkhmer = json_decode($position->languages, true); ?>
                        @if(!empty($getkhmer) )
                        <div>{{ $getkhmer['name'] }}</div>
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