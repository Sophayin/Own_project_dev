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
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Approved By')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($agency->applications->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">{{__("No Record Found.!")}}</td>
                        </tr>
                        @else
                        @foreach($agency->applications as $i=> $app)
                        <tr class="text text-center">
                            <td class="text-sm index-id">{{++$i}}</td>
                            <td class="text-sm">{{ date("d/m/Y", strtotime($app->created_at)) }}</td>
                            <td class="text-sm">{{$app->shop->shop_name ?? ''}}</td>
                            <td class="text-sm">{{ $app->client_name }}</td>
                            <td class="text-sm">{{ $app->gender }}</td>
                            <td class="text-sm">{{ $app->phone }}</td>
                            <td class="text-sm"> {{$app->loan_company->name?? ''}} </td>
                            <td class="cursor-pointer status">
                                {{__(get_application_status($app->status)['label'])}}
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>