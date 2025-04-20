<div wire:ignore.self class="modal fade" id="openModalUpdate">
    <div class="modal-dialog modal-lg">
        <form action="" wire:submit.prevent="edit">
            <div class="modal-content card-body">
                <div class="modal-header">
                    <h5 class="form-label text fw-semibold">{{__('Update Daily Expense')}}</h5>
                    <button type="button" class="btn-close text" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Client_section -->
                        <div class="row d-flex">
                            <div class="col-lg-6 mt-3 mb-3">
                                <label class="form-label fw-semibold"> {{__('Sources')}} </label>
                                <input type="text" wire:model="source" class="form-control" placeholder="source">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                <label class="form-label text fw-semibold">{{__('Getting date')}}</label>
                                <div class="input-group">
                                    <input type="date" class="form-control custom-input" wire:model="getting_date"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                <label class="form-label text fw-semibold">{{__('Target For')}}</label>
                                <div class="input-group">
                                    <input type="Month" class="form-control custom-input" wire:model="month"
                                        placeholder="" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                                <label class="form-label fw-semibold">{{__('Amount of Expend')}} <small
                                        class="text-danger">*</small></label>
                                <input type="text"
                                    class="form-control custom-input @error('breakfast') is-invalid @enderror"
                                    wire:model="amount" placeholder="$ 99.00 ">
                                @error('breakfast') <small class="invalid-feedback">{{__($message)}}</small> @enderror
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
                            <button type="submit" class="btn btn-primary button_save">{{__('Update')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>