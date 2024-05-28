<div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class=" d-flex justify-content-between mt-3 mb-3">
                            <input class="form-control input_search" placeholder="{{__('Search Position...')}}" type="search" wire:model.live.debounce="search" style="width: 250px;">
                            <a wire:click="openModalCreateAwardTarget">
                                <button class="btn btn-primary">
                                    <i class="bi bi-plus-circle"></i>
                                    {{__('Add New Position')}}
                                </button>
                            </a>
                        </div>
                        <div class="responsive mt-4">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Target/Award')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Target Sale')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Target Recruit')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm">{{__('Salary')}}</th>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Incentive')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Override Fee')}}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm">
                                            <nobr>{{__('Action')}}</nobr>
                                        </th>
                                    </tr>
                                </thead>
                                <thead>
                                    @foreach($positions as $key => $item)
                                    <tr class="group-header">
                                        <th colspan="6" class="text-center" style="background-color: #f8f9fa;">{{ get_translation($item) }} ({{$item->abbreviation}})</th>
                                        <th class="text-center" style="background-color: #f8f9fa;">
                                            <a style="border-color:azure;" class="rounded-pill btn btn-sm btn btn-outline-success" wire:click="editAwardTarget({{ $item->id }})">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </th>
                                    </tr>
                                    @foreach($item->awardTargets as $row)
                                    <tr>
                                        <td class="text-sm">
                                            <span>{{__($row->name)}}</span>
                                        </td>
                                        <td class="text-sm text-center">{{ $row->pivot->target_sale }}</td>
                                        <td class="text-sm text-center">{{ $row->pivot->target_recruit }}</td>
                                        <td class="text-sm text-end">
                                            <nobr>$ {{ number_format($row->pivot->salary, 2) }}</nobr>
                                        </td>
                                        <td class="text-sm text-end">
                                            <nobr>$ {{ number_format($row->pivot->incentive, 2)}}</nobr>
                                        </td>
                                        <td class="text-sm text-end">
                                            <nobr>$ {{number_format( $row->pivot->override_fee, 2) }}</nobr>
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @livewire('agency.setting.award-target.create')
    @livewire('agency.setting.award-target.update')
    <style>
        .group-header {
            background-color: #f8f9fa;
        }
    </style>
</div>