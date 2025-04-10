<div wire:ignore.self class="modal fade" id="openModal">
    <div class="modal-dialog modal-lg">
        <form action="" wire:submit.prevent="submit">
            <div class="modal-content card-body">
                <div class="modal-header">
                    <h5 class="form-label text fw-semibold">{{__('Add Daily Expense')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
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
                        <div class="row mb-3 mt-3">
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
                <div class="modal-footer justify-content-center">
                    <div class="p-2">
                        <div class="col-lg-12 col-sm-6">
                            <button type="submit" class="btn btn-primary button_save">{{__('Save')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>