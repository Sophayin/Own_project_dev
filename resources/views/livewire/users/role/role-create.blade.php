<div wire:ignore.self wire:id="..." wire:snapshot="{ state: {...}, memo: {...} }" class="modal fade" id="openModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form wire:submit.prevent="createRole">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Create New Role')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="name" class="form-label">{{__('Name')}} <small class="text-danger">*</small> </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{__('Name')}}" wire:model="name">
                                @error('name')
                                <span class="invalid-feedback">{{ __($message) }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="status" class="form-label">{{__('Status')}}</label>
                                <select id="status" class="form-select form-select-lg" wire:model="role_status">
                                    <option value="1">{{__('Active')}}</option>
                                    <option value="0">{{__('Inactive')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label for="description" class="form-label">{{__('Description')}}</label>
                                <textarea class="form-control" wire:model="description" placeholder="{{__('Type here...')}}" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary button_save">{{__('Save')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>