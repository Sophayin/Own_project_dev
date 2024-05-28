<div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <h5 class="m-3">{{__('System Log') }}</h5>
                    <hr>
                    <div class="card-body">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="30">{{__('No.')}}</th>
                                    <th scope="col">{{__('Created By')}}</th>
                                    <th scope="col">{{__('Email')}}</th>
                                    <th scope="col">{{__('Role')}}</th>
                                    <th class="text-center">{{__('Action')}}</th>
                                    <th class="text-center">{{__('Description')}}</th>
                                    <th class="text-center">{{__('Time')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n = 1; ?>
                                @foreach($systemLogs as $key => $item)
                                <tr style="vertical-align:middle">
                                    <td class="text">{{$n++}}</td>
                                    <td class="text text-sm">{{{($item->created_by_user)}}}</td>
                                    <td class="text text-sm">{{$item->user->email ?? ''}}</td>
                                    <td class="text text-sm">{{$item->staff->role->name ?? ''}}</td>
                                    <td class="text text-sm">{{__($item->action)}}</td>
                                    <td class="text text-sm">{{$item->description}}</td>
                                    <td class="text text-sm">{{$item->created_at->diffForHumans(['parts' => 4, 'join' => ' ', 'short' => true])}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row  mb-3 mt-3">
                            @if($systemLogs->count())
                            <div class="col-sm-1" style="width: 90px;">
                                <select class="form-select" wire:model.live="limit" aria-label="Default">
                                    <option value="15">15</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            @endif
                            <div class="col ">
                                {{$systemLogs->links('livewire.customer-pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>