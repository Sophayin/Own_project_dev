<div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body mb-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="30">{{__('No.')}}</th>
                                    <th class="text-center text-secondary text">{{__('Position')}}</th>
                                    <th class="text-center text-secondary text">{{__('Code')}}</th>
                                    <!--<th class="text-center text-secondary text-sm opacity-7">{{trans('translations.set_target')}}</th>-->
                                    <!--<th class="text-center">Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n = 1; ?>
                                @foreach($positions as $key => $item)
                                <tr style="vertical-align:middle">
                                    <td class="text-center text">{{$n++}}</td>
                                    <td class="text-center text">{{get_translation($item)}} ({{$item->abbreviation}})</td>
                                    <td class="text-center text">{{$item->code}}</td>
                                    <!--<td class="text-center text">-->
                                    <!--<a style="border-color:azure;" wire:click="openModalSetTarget({{ $item->id }})" class="rounded-pill btn btn-sm btn btn-outline-success">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>-->
                                    <!--</td>-->
                                    <!--<td align="center">
                                        <a style="border-color:azure;" wire:click="editPosition({{ $item->id }})" class="rounded-pill btn btn-sm btn btn-outline-success">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>-->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row  mb-3 mt-3">
                            @if($positions->count())
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
                                {{$positions->links('livewire.customer-pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @livewire('agency.setting.position.create')
    @livewire('agency.setting.position.update')
    @livewire('agency.setting.position.set-target')

</div>