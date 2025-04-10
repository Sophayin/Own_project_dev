<div wire:ignore.self class="modal fade" id="openModal">
    <div class="modal-dialog modal-lg">
        <form action="" wire:submit.prevent="submit">
            <div class="modal-content card-body">
                <div class="modal-header">
                    <h5 class="form-label text fw-semibold">{{__('Other Expense')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Client_section -->
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6 mt-2">
                                <label class="form-label text fw-semibold">{{__('Expend Date')}}</label>
                                <div class="input-group">
                                    <input type="date" class="form-control custom-input" wire:model="expend_date"
                                        placeholder="" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 mt-3">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <label class="form-label fw-semibold">{{__('Cloth')}} <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control custom-input " wire:model="cloth"
                                    placeholder="{{__('Cloth')}}">
                                @error('cloth') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <label class="form-label fw-semibold">{{__('Cloth Price')}} <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control custom-input " wire:model="cloth_price"
                                    placeholder="{{__('Cloth Price')}}">
                                @error('breakfast') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                                <label class="form-label fw-semibold"> {{__('Accessary')}} </label>
                                <input type="text" class="form-control custom-input" wire:model="accessary"
                                    placeholder="{{__('Accessary')}}">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                                <label class="form-label fw-semibold"> {{__('Accessary Price')}} </label>
                                <input type="text" class="form-control custom-input" wire:model="accessary_price"
                                    placeholder="{{__('Accessary Price')}}">
                            </div>
                        </div>
                        <div class="row mb-3 mt-1">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <label class="form-label fw-semibold">{{__('Event')}} <small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control custom-input " wire:model="event"
                                    placeholder="{{__('Event')}}">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <label class="form-label fw-semibold"> {{__('Event Expense')}} </label>
                                <input type="text" class="form-control custom-input" wire:model="event_expense"
                                    placeholder="{{__('Event Expend')}}">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                                <label class="form-label fw-semibold"> {{__('Taxi')}} </label>
                                <input type="text" class="form-control custom-input" wire:model="taxi"
                                    placeholder="{{__('Taxi')}}">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mt-3">
                                <label class="form-label fw-semibold"> {{__('Taxi Fee')}} </label>
                                <input type="text" class="form-control custom-input" wire:model="taxi_fee"
                                    placeholder="{{__('Taxi Feee')}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-label fw-semibold"> {{__('Remarks')}} </label>
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