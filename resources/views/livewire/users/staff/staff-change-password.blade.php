<div wire:ignore.self class="modal fade" id="openModalChangePassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form wire:submit.prevent="changeUserPassword">
            <div class="modal-content card-body">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Change Password')}} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col">
                                <label for="Current Password" class="form-label">{{__('Current Password')}} <small class="text-danger">*</small></label>
                                <input type="text" class="form-control custom-input @error('current_password') is-invalid @enderror" placeholder="{{ __('Current Password')}}" wire:model="current_password">
                                @error("current_password")
                                <span class="invalid-feedback">{{ __($message) }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="password" class="form-label">{{__('Password')}}<small class="text-danger">*</small></label>
                                <input type="text" class="form-control custom-input @error('password') is-invalid @enderror" placeholder="{{__('Password')}}" wire:model="password">
                                @error('password')<span class="invalid-feedback">{{ __($message) }}</span>@enderror
                            </div>
                            <div class="col">
                                <label for="confirm-password" class="form-label">{{__('Confirm Password')}}<small class="text-danger">*</small></label>
                                <input type="text" class="form-control custom-input @error('password_confirmation') is-invalid @enderror" placeholder="{{__('Re-type Password')}}" wire:model="password_confirmation">
                                @error('password_confirmation') <span class="invalid-feedback">{{ __($message) }}</span>
                                @enderror
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