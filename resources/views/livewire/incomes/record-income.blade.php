<div wire:ignore.self class="modal fade" id="openModal">
    <div class="modal-dialog modal-lg">
        <form action="" wire:submit.prevent="set_expend_target">
            <div class="modal-content card-body">
                <div class="modal-header">
                    <h5 class="form-label text fw-semibold">{{__('Add Income')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Client_section -->
                        <div class="row d-flex">
                            <div class="col-lg-6 mt-2 mb-3">
                                <label class="form-label fw-semibold"> {{__('Sources')}} </label>
                                <input type="text" wire:model="source" class="form-control custom-input" placeholder="source">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 mt-2">
                                <label class="form-label text fw-semibold">{{__('Getting date')}}</label>
                                <div class="input-group">
                                    <input type="date" class="form-control custom-input" wire:model="getting_date"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-6 mt-2">
                                <label class="form-label text fw-semibold">{{__('For Month')}}</label>
                                <div class="input-group">
                                    <input type="Month" class="form-control custom-input" wire:model="month"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                                <label class="form-label fw-semibold">{{__('Amount')}} <small
                                        class="text-danger">*</small></label>
                                <input type="text"
                                    class="form-control custom-input @error('amount') is-invalid @enderror"
                                    wire:model="amount" placeholder="$ 00.00 ">
                                @error('amount') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mt-2">
                                <label class="form-label fw-semibold">{{__('Sent Wife')}} <small
                                        class="text-danger">*</small></label>
                                <input type="text"
                                    class="form-control custom-input @error('sent_wife') is-invalid @enderror"
                                    wire:model="sent_wife" placeholder="$ 00.00 ">
                                @error('sent_wife') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                <label class="form-label fw-semibold">{{__('Get From Wife')}} <small
                                        class="text-danger">*</small></label>
                                <input type="text"
                                    class="form-control custom-input @error('sent_wife') is-invalid @enderror"
                                    wire:model="get_from_wife" placeholder="$ 00.00 ">
                                @error('get_from_wife') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                            </div>
                            <div class="col-lg-12 mt-4">
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