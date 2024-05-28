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
                    <th colspan="3" style="border:none; font-size: 15px;padding-bottom: 15px">
                        <h3 style="color: blue;">{{ __('Occupation') }}</h3>
                    </th>
                </tr>
                <tr class="text_header">
                    <th style="width:20px" class="text-center text-secondary text-sm opacity-7">
                        {{__('ID')}}
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Name')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <nobr>{{__('Khmer')}}</nobr>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($occupations as $occupation)
                <tr class="text text-center">
                    <td class="text-secondary text-sm index-id">
                        {{$occupation->id}}
                    </td>
                    <td class="text-secondary text-sm">{{$occupation->name}}</td>
                    <td class="text-secondary text-sm">
                        <?php $getkhmer = json_decode($occupation->languages, true); ?>
                        @if(!empty($getkhmer) )
                        <nobr>{{ $getkhmer['name'] }}</nobr>
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