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
                    <th colspan="8" style="border:none; font-size: 15px;padding-bottom: 15px">
                        <h3 style="color: blue;">{{ __('Product List') }}</h3>
                    </th>
                </tr>
                <tr>
                    <th colspan="7" style="border:none; font-size: 12px;padding-bottom: 10px"></th>
                </tr>
                <tr class="text_header">
                    <th class="text-center text-secondary text-sm opacity-7">
                        {{__('No.')}}
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <nobr>{{__('Code')}}</nobr>
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Name')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Year of Manufacture')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">{{__('Condition')}}</th>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <nobr>{{__('Price')}}</nobr>
                    </th>
                    <th class="text-center text-secondary text-sm opacity-7">
                        <nobr>{{__('Description')}}</nobr>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $i => $product)
                <tr class="text text-center">
                    <td class="text-secondary text-sm index-id">
                        {{$product->id}}
                    </td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$product->code}}</nobr>
                    </td>
                    <td class="text-secondary text-sm">{{$product->title}}</td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$product->year_of_manufacture}}</nobr>
                    </td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$product->condition}}</nobr>
                    </td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$product->price}}</nobr>
                    </td>
                    <td class="text-secondary text-sm">
                        <nobr>{{$product->description}}</nobr>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <htmlpagefooter name="page-footer">

    </htmlpagefooter>
</div>