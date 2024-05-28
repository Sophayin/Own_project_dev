<div wire:ignore.self class="modal fade" id="openModalCommission" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <form wire:submit.prevent="createUser" style="height: 100vh">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text">{{ __('Generate Commission') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-5 p-2">
                                <div class="row">
                                    <div class="col-2 mt-2 p-0">
                                        <p class="text-end text">{{__('Date')}} </p>
                                    </div>
                                    <div class="col-4">
                                        <input type="date" class="form-control mb-2 bg-light ml-2" wire:model.live="start_date">
                                    </div>
                                    <div class="col-1 mt-1">
                                        <i class="bi bi-arrow-right-short fs-4"></i>
                                    </div>
                                    <div class="col-4">
                                        <input type="date" class="form-control bg-light mb-2 ml-2" wire:model.live="end_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-1 p-2">
                                <select class="form-select" multiple wire:model.live='agency_position_ids' style="width: 100%;">
                                    @foreach ($agency_positions as $item)
                                    <option value="{{ $item->id }}">
                                        {{ get_translation($item) }} ({{$item->abbreviation}})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr class="text_header">
                                        <th scope="col">
                                            <input type="checkbox" value="all" wire:model.live='check_all' class="form-check-input">
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7">
                                            <nobr> {{ __('Agency Name') }}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7"> {{ __('Own Sale') }} </th>
                                        <th class="text-center text-secondary text-sm opacity-7" style="background-color:beige"> {{ __('Total Sale') }}</th>
                                        <th class="text-center text-secondary text-sm opacity-7" style="background-color:beige"> {{ __('Total Recruit') }}</th>

                                        <th class="text-center text-secondary text-sm opacity-7"> {{ __('Commission Fee') }} </th>
                                        <th class="text-center text-secondary text-sm opacity-7"> {{ __('Override Fee') }} </th>
                                        <th class="text-center text-secondary text-sm opacity-7" style="background-color:beige"> {{ __('Total Payment') }} </th>
                                        <th class="text-center text-secondary text-sm opacity-7">
                                            <nobr>{{ __('Award') }}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7"> {{ __('Remark') }} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($sales))
                                    @foreach ($sales as $index => $sale)
                                    <tr class="text" style="vertical-align: middle;">
                                        <td><input type="checkbox" wire:model.live='selected_items' value="{{ $index }}" class="form-check-input"></td>
                                        <td>
                                            <nobr>
                                                <div class="text-sm">{{ $sale['agency_name'] }}</div>
                                                <small>{{__('Code')}}: {{$sale['agency_code']}}</small>
                                            </nobr>
                                        </td>
                                        <td><input class="form-control text-center" readonly name="sales[{{ $index }}][direct_sale]" type="number" wire:model.lazy='sales.{{ $index }}.own_sale'> </td>
                                        <td style="background-color:beige"><input class="form-control text-center" readonly name="sales[{{ $index }}][total_sale]" type="number" wire:model.lazy='sales.{{ $index }}.total_sale'> </td>
                                        <td style="background-color:beige"><input class="form-control text-center" readonly name="sales[{{ $index }}][total_recruit]" type="number" wire:model.lazy='sales.{{ $index }}.total_recruit'> </td>

                                        <td><input class="form-control text-center" name="sales[{{ $index }}][commission_fee]" type="number" wire:model.lazy='sales.{{ $index }}.commission_fee'> </td>
                                        <td><input class="form-control text-center" name="sales[{{ $index }}][override_fee]" type="number" wire:model.lazy='sales.{{ $index }}.override_fee'> </td>
                                        <td style="background-color:beige"><input class="form-control text-center" name="sales[{{ $index }}][total_payment]" type="number" wire:model.lazy='sales.{{ $index }}.total_payment' required /> </td>
                                        <td class="text-center">
                                            <nobr>
                                                <span style="background: #484848;" class="badge rounded-pill ">{{__($sale['label_award'])}}</span>
                                            </nobr>
                                        </td>
                                        <td>
                                            <input class=" form-control text-center" name="sales[{{ $index }}][remark]" type="text" placeholder="{{__('Remark')}}" wire:model.lazy='sales.{{ $index }}.remark'>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="15" class="text-center">
                                            <p>{{__('No Record Found.!')}}</p>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" wire:click='submit' class="btn btn-primary button_save">{{ __('Save') }}</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
    <script>
        Livewire.on('loadPosition', postId => {
            jQuery(document).ready(function() {
                jQuery('#selectPosition').select2({
                    dropdownParent: jQuery("#openModalCommission")
                });
            });
        })
        jQuery(document).ready(function() {
            jQuery('#selectPosition').select2({
                dropdownParent: jQuery("#openModalCommission")
            });
            jQuery('#selectPosition').on('change', function(e) {
                @this.set('agency_position_ids', jQuery(this).val());
            });
        });
    </script>
    @endpush
</div>