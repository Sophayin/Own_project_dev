<div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class=" d-flex justify-content-between mb-3 mt-3">
                            <h5 class="text">{{__('Performance')}}</h5>
                        </div>
                        <div class="row">
                            <div class="container d-flex p-2">
                                <div class="col-lg-2 d-none d-sm-block p-2 ml-3">
                                    <input class="form-control input_search" placeholder="{{__('Type Search...')}}" type="search" wire:model.live.debounce.500ms="search">
                                </div>
                                <div class="col-lg-3 p-2 ">
                                    <select class="form-select form-select-lg mb-3" wire:model.live='position_id'>
                                        <option value="">--{{__('All Position')}}--</option>
                                        @foreach ($positions as $item)
                                        <option value="{{ $item->id }}">
                                            {{ get_translation($item) }} ({{$item->abbreviation}})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Date -->
                                <div class="col-lg-4 d-flex mt-2" id="sandbox-container">
                                    <div class="input-group">
                                        <input type="text" class="input-sm form-control" id="start_date" wire:model="start_date" />
                                        <span class="input-group-text" id="basic-addon1" style="height: 40px; margin-top: 1px;"><i class="bi bi-calendar"></i></span>
                                    </div>
                                    <div class="input-group">
                                        <input type="text" class="input-sm form-control" id="end_date" wire:model="end_date" />
                                        <span class="input-group-text" id="basic-addon1" style="height: 40px; margin-top: 1px;"><i class="bi bi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text_header">
                                        <th class="text-center text-secondary text-sm">{{__('No.')}}</th>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Agency Code')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Agency Name')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm" style="background-color:beige">
                                            <nobr>{{__('Own Sale')}} </nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Sale by Team')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm" style="background-color:beige">
                                            <nobr>{{__('Direct Recruit')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Recruit by Team')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm" style="background-color:beige">
                                            <nobr>{{__('Total Sale')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm" style="background-color:beige">
                                            <nobr>{{__('Total Recruit')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Award')}}</nobr>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agencies as $N => $ageny)
                                    <tr>
                                        <td class="text-sm text-center">{{++$N}}</td>
                                        <td class="text-sm">{{$ageny->code}}</td>
                                        <td class="text-sm">
                                            <nobr>{{$ageny->full_name}}</nobr>
                                        </td>
                                        <td class="text-sm text-center" style="background-color:beige">{{$ageny->direct_sale ? $ageny->direct_sale : ''}}</td>
                                        <td class="text-sm text-center">{{$ageny->sale_by_team ? $ageny->sale_by_team : '' }}</td>
                                        <td class="text-sm text-center" style="background-color:beige">{{$ageny->direct_recruit ? $ageny->direct_recruit : ''}}</td>
                                        <td class="text-sm text-center">{{$ageny->recruit_by_team}}</td>
                                        <td class="text-sm text-center" style="background-color:beige">{{$ageny->direct_sale + $ageny->sale_by_team}}</td>
                                        <td class="text-sm text-center" style="background-color:beige">{{$ageny->direct_recruit + $ageny->recruit_by_team}}</td>
                                        <?php $award = get_award($ageny->direct_sale + $ageny->sale_by_team, $ageny->direct_recruit + $ageny->recruit_by_team, $ageny->position_id); ?>
                                        <td class="text-center">
                                            @if($award)
                                            <?php $color = '#484848'; ?>
                                            @if($award == 'Bronze')
                                            <?php $color = '#CD7F32'; ?>
                                            @elseif ($award == 'Gold')
                                            <?php $color = '#D4AF37'; ?>
                                            @elseif($award == 'Silver')
                                            <?php $color = '#C0C0C0'; ?>
                                            @endif
                                            <span style="background: {{$color}};" class="badge rounded-pill ">{{__($award)}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row  mb-3 mt-3">
                                @if($agencies->count())
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
<script type="text/javascript">
    //--selected date--
    jQuery(document).ready(function() {
        $('#start_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'XX',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        $('#end_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'XX',
            uiLibrary: 'bootstrap5',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        $('#start_date, #end_date').on('change', function() {
            @this.set('start_date', $('#start_date').val());
            @this.set('end_date', $('#end_date').val());
        });
    });
</script>
@endpush