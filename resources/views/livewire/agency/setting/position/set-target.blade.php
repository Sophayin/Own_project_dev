<div>
    <div wire:ignore.self class="modal fade" id="openModalSetTarget" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form wire:submit.prevent="saveTarget">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Set Target')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="target_sale" class="form-label">{{__('Target Sale')}}<small class="text-danger">*</small> </label>
                                    <input type="number" class="form-control @error('target_sale') is-invalid @enderror" placeholder="Target Sale" wire:model="target_sale">
                                    @error('target_sale')
                                    <span class="invalid-feedback">{{__($message) }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="target_recruit" class="form-label">{{__('Target Recruit')}} <small class="text-danger">*</small> </label>
                                    <input type="number" class="form-control @error('target_recruit') is-invalid @enderror" placeholder="Target Recruit" wire:model="target_recruit">
                                    @error('target_recruit')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary button_save">{{__('Save')}}</button>
                        <span wire:loading>Saving...</span>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>