<div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mt-3">
                            <h5>{{__('Notification List')}}</h5>

                        </div>

                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="30" class="text-center text-secondary text-sm opacity-7">{{__('No.')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Agency Name')}}</th>

                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Description')}}</th>
                                    <!--<th width="90" class=" text-secondary text-sm opacity-7">{{__('Status')}}</th>-->
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Date')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n = 1; ?>
                                @foreach($notifications as $key => $item)
                                <tr style="vertical-align:middle">
                                    <td class="text text-center">{{++$key}}</td>
                                    <td class="text text-center">{{$item->title}}</td>
                                    <td class="text">{{$item->description}}</td>
                                    <td class="text text-sm" align="center">
                                        {{$item->created_at->diffForHumans(['parts' => 4, 'join' => ' ', 'short' => true])}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row  mb-3 mt-3">
                            <div class="col">
                                {{$notifications->links('livewire.customer-pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>