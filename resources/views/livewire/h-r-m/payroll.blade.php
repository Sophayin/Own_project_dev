<div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 mt-3">
                            <h5 class="text">{{ __('Payroll') }}</h5>
                            <div class="d-flex justify-content-end">
                                <div class="p-2">
                                    <div class="col-lg-12 col-sm-6">
                                        <button wire:click="open_modal_commission" class="btn btn-primary button_addnew">
                                            <i class="bi bi-plus-circle"></i>
                                            {{__('Generate Commission')}}
                                        </button>
                                    </div>
                                </div>
                                <div class="p-2">
                                    <div class="col-lg-12 col-sm-6">
                                        <button wire:click="open_modal_payroll" class="button_addnew btn btn-primary">
                                            <i class="bi bi-plus-circle"></i>
                                            {{ __('Generate Payroll') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-lg-2 d-none d-sm-block p-2 ml-3">
                                <input class="form-control input_search " placeholder=" {{ __('Type Search...') }}" type="text" wire:model.live="search">
                            </div>
                            <div class="col-lg-1 d-none d-sm-block p-2 ml-3">
                                <select wire:model.live="status" class="form-select form-select-lg mb-3">
                                    <option value="%"> {{ __('All') }}</option>
                                    <option value="1">{{ __('Paid') }}</option>
                                    <option value="0">{{ __('Unpaid') }}</option>
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
                            <div class="col-lg-3 mt-3">
                                <div class="form-group">
                                    <div wire:ignore>
                                        <select class="form-control" id="position-dropdowns" multiple wire:model.live='position_ids'>
                                            @foreach ($positions as $item)
                                            <option value="{{ $item->id }}">
                                                {{ get_translation($item) }} ({{$item->abbreviation}})
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text_header">
                                        <th>
                                            <input type="checkbox" value="all" wire:model.live='check_all' class="form-check-input">
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7">{{ __('Date') }}</th>
                                        <th class="text-center text-secondary text-sm opacity-7">
                                            <nobr>{{ __('Agency Code') }}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7">
                                            <nobr>{{ __('Agency Name') }}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7" style="background-color:beige">
                                            <nobr>{{ __('Total Sale') }}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7" style="background-color:beige">
                                            <nobr>{{ __('Total Recruit') }}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7">
                                            <nobr>{{ __('Incentive') }}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7">
                                            <nobr>{{ __('Commission Fee') }}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7">
                                            <nobr>{{ __('Override Fee') }}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7">{{ __('Salary') }} </th>
                                        <th class="text-center text-secondary text-sm opacity-7" style="background-color:beige">
                                            <nobr>{{ __('Total Payment') }}</nobr>
                                        </th>
                                        <th class="text-center text-secondary text-sm opacity-7">{{ __('Status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payrolls as $index => $payroll)
                                    <tr class="text" style="vertical-align: middle;">
                                        <td class="text text-center">
                                            <input type="checkbox" wire:model.live='selected_payrolls' value="{{ $payroll->id }}" class="form-check-input">
                                        </td>
                                        <td class="text-sm text-center">{{ $payroll->created_at->format('d/M/y') }}</td>
                                        <td class="text-sm text-center">{{ $payroll->agency_code }}</td>
                                        <td class="text-sm text-center">
                                            <nobr>{{ $payroll->agency->full_name ?? '' }}</nobr>
                                        </td>
                                        <td class="text-sm text-center" style="background-color:beige">{{ number_format($payroll->total_sale) }}</td>
                                        <td class="text-sm text-center" style="background-color:beige">{{ number_format($payroll->total_recruit) }}</td>

                                        <td class="text-sm text-end">{{ $payroll->incentive ? "$".number_format($payroll->incentive, 2) : '' }}</td>
                                        <td class="text-sm text-end">{{ $payroll->commission_fee ? "$".number_format($payroll->commission_fee, 2) : '' }}</td>
                                        <td class="text-sm text-end">{{ $payroll->override_fee ? "$".number_format($payroll->override_fee, 2) : ''}}</td>
                                        <td class="text-sm text-end">{{ $payroll->salary ? "$".number_format($payroll->salary, 2) : ''}}</td>
                                        <td class="text-sm text-end" style="background-color:beige">{{ $payroll->total_payroll ? "$".number_format($payroll->total_payroll, 2) : '' }}</td>
                                        <td class=" text-center">
                                            <nobr>
                                                <a href="#" wire:click="update_status_payroll({{ $payroll->id }})" class="badge rounded-pill bg-primary text-white {{ $payroll->status == false ? 'bg-warning' : 'bg-success' }}">{{ $payroll->status == false ? __('Unpaid') : __('Paid') }} </a>
                                            </nobr>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($payrolls->count() > 0)
                        <div class="col-2 p-2 mb-2">
                            <button wire:click="preview" wire:loading.attr="disabled" class="btn btn-sm btn-light">
                                {{ __('Preview & Download') }}
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @livewire('h-r-m.generate-commission')

    @livewire('h-r-m.payroll-generate')

    <div wire:ignore.self class="modal fade" id="statusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" wire:submit.prevent="updateStatus">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ __('Update Status') }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12 mt-3">
                            <label>{{ __('Status') }}</label>
                            <select wire:model="payroll_status" class="form-select form-select-lg">
                                <option value="0">{{ __('Unpaid') }}</option>
                                <option value="1">{{ __('Paid') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class=" btn btn-primary button_save" data-bs-dismiss="modal">{{ __('Update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')

<script>
    Livewire.on('loadLeaderSelected', postId => {
        $(document).ready(function() {
            $('#payroll_select').select2();
        });
    });

    $(document).ready(function() {
        $('#position-dropdowns').select2();
        $('#position-dropdowns').on('change', function(e) {
            let data = $(this).val();
            @this.set('position_ids', data);
        });
    });
    //--selected date--
    $(document).ready(function() {
        $('#start_date').datepicker({
            autoclose: true,
            //todayHighlight: true,
            //language: 'XX',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        $('#end_date').datepicker({
            autoclose: true,
            //todayHighlight: true,
            //language: 'XX',
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