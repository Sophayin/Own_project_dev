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
                    <th colspan="7" style="border:none; font-size: 15px;padding-bottom: 15px">
                        <h3 style="color: blue;">{{ __('Shop List') }}</h3>
                    </th>
                </tr>
                <tr>
                    <th colspan="7" style="border:none; font-size: 12px;padding-bottom: 10px"></th>
                </tr>
                <tr class="text_header">
                    <th class="text-center text-secondary text-sm opacity-7">
                        {{__('No.')}}
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Shop Name')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Shop Name (Khmer)')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Abbreviation')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <nobr>{{__('Phone')}}</nobr>
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <nobr>{{__('Telegram')}}</nobr>
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <nobr>{{__('Facebook page')}}</nobr>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($shops as $i => $shop)
                <tr class="text text-center">
                    <td class="text-secondary text-sm index-id">
                        {{$shop->id}}
                    </td>
                    <td class="text-secondary text-sm">{{$shop->shop_name}}</td>
                    <td class="text-secondary text-sm">
                        <?php $getkhmer = json_decode($shop->shop_name_translate, true); ?>
                        @if(!empty($getkhmer) )
                        <div>{{ $getkhmer['name'] }}</div>
                        @endif
                    </td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$shop->abbreviation}}</nobr>
                    </td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$shop->phone}}</nobr>
                    </td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$shop->telegram}}</nobr>
                    </td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$shop->facebook_page}}</nobr>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <htmlpagefooter name="page-footer">

    </htmlpagefooter>
</div>