<div>
    <section class="section">
        <form wire:submit="submit">
            <div class="d-flex mb-3 justify-content-between">
                <div class="p-2 d-flex text">
                    <a class="custom-text" wire:navigate href="{{route('sale.list', 'application')}}"><i
                            class="bi bi-arrow-left-circle-fill"></i> {{__('Back')}}</a>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="p-2">
                        <div class="col-lg-12 col-sm-6">
                            <button type="submit" class="btn btn-primary button_save">{{__('Save')}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3 custom_card">
                <div class="card-body">
                    <!-- Client_section -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 mt-2">
                            <label class="form-label text fw-semibold">{{__('Registered Date')}}</label>
                            <div class="input-group">
                                <input type="date" class="form-control custom-input" wire:model="expend_date"
                                    placeholder="{{$expend_date}}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 mt-1">
                        <p class="text_section mt-3 fw-semibold">{{__('Meal Expend')}}</p>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <label class="form-label fw-semibold">{{__('Breakfast')}} <small
                                    class="text-danger">*</small></label>
                            <input type="text"
                                class="form-control custom-input @error('breakfast') is-invalid @enderror"
                                wire:model="breakfast" placeholder="{{__('Enter Breakfast Expend')}}">
                            @error('breakfast') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <label class="form-label fw-semibold"> {{__('Lunch')}} </label>
                            <input type="text" class="form-control custom-input" wire:model="lunch"
                                placeholder="{{__('Enter Lunch expend')}}">
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <label class="form-label fw-semibold"> {{__('Dinner')}} </label>
                            <input type="text" class="form-control custom-input" wire:model="dinner"
                                placeholder="{{__('Enter dinner expend')}}">
                        </div>
                    </div>
                    <div class="row mb-3 mt-1">
                        <p class="text_section mt-3 fw-semibold">{{__('Drink Expend')}}</p>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <label class="form-label fw-semibold">{{__('Amount Coffee')}} <small
                                    class="text-danger">*</small></label>
                            <input type="text"
                                class="form-control custom-input @error('amount_coffee') is-invalid @enderror"
                                wire:model="amount_coffee" placeholder="{{__('Enter amount coffee Expend')}}">
                            @error('amount coffee') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <label class="form-label fw-semibold"> {{__('Coffee Fee')}} </label>
                            <input type="text" class="form-control custom-input" wire:model="coffee_price"
                                placeholder="{{__('Enter coffee price')}}">
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <label class="form-label fw-semibold"> {{__('Party Expend')}} </label>
                            <input type="text" class="form-control custom-input" wire:model="party_expend"
                                placeholder="{{__('Enter party expend')}}">
                        </div>
                    </div>
                    <div class="row mb-3 mt-1">
                        <p class="text_section mt-3 fw-semibold">{{__('Gasoline')}}</p>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <label class="form-label fw-semibold">{{__('Amount Gasoline')}} <small
                                    class="text-danger">*</small></label>
                            <input type="text"
                                class="form-control custom-input @error('amount_coffee') is-invalid @enderror"
                                wire:model="amount_gasoline" placeholder="{{__('Enter amount gasoline Expend')}}">
                            @error('amount_gasoline') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <label class="form-label fw-semibold"> {{__('Gasoline Fee')}} </label>
                            <input type="text" class="form-control custom-input" wire:model="gasoline_price"
                                placeholder="{{__('Enter gasoline price')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <label class="form-label fw-semibold"> {{__('Remark')}} </label>
                            <textarea class="form-control custom-input" wire:model="remark" rows="3">
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- Addres Modal -->
    <div wire:ignore.self class="modal fade" id="addressModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{__('Address')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('livewire.sales.applications.addressmodal')
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" wire:click="saveAddress" class=" btn btn-primary button_save"
                        data-bs-dismiss="modal">{{__('Done')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Guarantor Modal -->
    <div wire:ignore.self class="modal fade" id="guarantorModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{__('Guarantor')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('livewire.sales.applications.guarantormodal')
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" wire:click="addGuarantor" class=" btn btn-primary button_save"
                        data-bs-dismiss="modal">{{__('Done')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    //--selected date--
    jQuery(document).ready(function() {
        jQuery('#register_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'XX',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        jQuery('#register_date').on('change', function() {
            @this.set('registration_date', jQuery('#register_date').val());
        });
    });

    //--selected agency--
    Livewire.on('loadAgency', postId => {
        jQuery(document).ready(function() {
            jQuery('#selectedByAgency').select2();
        });
    })
    jQuery(document).ready(function() {
        jQuery('#selectedByAgency').select2();
        jQuery('#selectedByAgency').on('change', function(e) {
            @this.set('agency_id', jQuery(this).val());
        });
    });
</script>
@endpush