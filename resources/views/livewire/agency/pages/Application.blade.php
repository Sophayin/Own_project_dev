<div>
    <section class="section">
        <div class="tab-pane " id="application" role="tabpanel" aria-labelledby="application-tab">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text_header">
                            <th class="text-center text-secondary text-sm opacity-7">{{__('No.')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Date')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Shop Name')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Client Name')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Gender')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Phone Number')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Address')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Product Name')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Price')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Approved By')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($agency->applications->count() > 0)
                        @foreach($agency->applications as $index=> $app)
                        <tr class="text text-center">
                            <td class="text-secondary text-sm">{{++$index}}</td>
                            <td class="text-secondary text-sm">{{ date("d/m/Y", strtotime($app->created_at)) }}</td>
                            <td class="text-secondary text-sm">{{$app->shop->shop_name ?? ''}}</td>
                            <td class="text-secondary text-sm">{{ $app->client_name }}</td>
                            <td class="text-secondary text-sm">{{ $app->gender }}</td>
                            <td class="text-secondary text-sm">{{ $app->phone }}</td>
                            <td class="text-secondary text-sm">{{$app->address && $app->address->city? get_translation($app->address->city):  ""}}
                            </td>
                            <td class="text-secondary text-sm">{{ $app->product_name }}</td>
                            <td class="text-secondary text-sm">{{ $app->product_price }}</td>

                            <td class="text-secondary text-sm"> {{$app->loan_company->name ?? ''}} </td>
                            <td class="cursor-pointer status text-secondary text-sm">
                                {{__(get_application_status($app->status)['label'])}}
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="11" class="text-center">
                                {{__("No Record Found.!")}}
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>