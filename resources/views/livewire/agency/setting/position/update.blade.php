<div>
    <div wire:ignore.self class="modal fade" id="openModalUpdate" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form wire:submit.prevent="updatePosition">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Position Update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="name" class="form-label">Position Name <small
                                            class="text-danger">*</small> </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Name"
                                           wire:model="name">
                                    @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="abbreviation" class="form-label">Abbreviation <small
                                            class="text-danger">*</small> </label>
                                    <input type="text" class="form-control @error('abbreviation') is-invalid @enderror"
                                           placeholder="Abbreviation"
                                           wire:model="abbreviation">
                                    @error('abbreviation')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="code" class="form-label">Code <small
                                            class="text-danger">*</small></label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                               placeholder="Code" wire:model="code">
                                        @error('code')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <h6 class="text_section">Description</h6>
                                    <div class="form-floating">
                                        <textarea class="form-control" wire:model="description"
                                                  placeholder="Type remark here...." id="floatingTextarea2"
                                                  style="height: 100px"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary button_save">Save</button>
                        <span wire:loading>Saving...</span>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
