<div wire:ignore.self class="modal fade" id="openModalUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form wire:submit="updateRole">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Update Role')}} "{{$name}}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="name" class="form-label">{{__('Name')}} <small class="text-danger">*</small> </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" wire:model="name">
                                @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="sttus" class="form-label">{{__('Status')}} {{$role_status}}</label>
                                <select class="form-select form-select-lg" wire:model="role_status">
                                    <option value="1" {{$role_status == 1 ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{$role_status == 0 ? 'selected' : ''}}>Inactive</option>
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
                    <button type="submit" class="btn btn-primary button_save">{{__('Update')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>