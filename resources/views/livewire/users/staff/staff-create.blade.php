<div wire:ignore.self class="modal fade" id="openModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form wire:submit.prevent="createUser">
            <div class="modal-content card-body">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add New Staff')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col">
                                <div class="col-12">
                                    <label for="name" class="form-label">{{__('Name')}}<small class="text-danger">*</small> </label>
                                    <input type="text" class="form-control custom-input @error('name') is-invalid @enderror" placeholder="{{__('Name')}}" wire:model="name">
                                    @error('name')
                                    <span class="invalid-feedback">{{ __($message) }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 mt-2">
                                    <label for="username" class="form-label">{{__('UserName')}}<small class="text-danger">*</small></label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text text-default" id="inputGroupPrepend">@</span>
                                        <input type="text" class="form-control custom-input @error('username') is-invalid @enderror" placeholder="{{ __('UserName')}}" wire:model="username">
                                        @error('username')
                                        <span class="invalid-feedback">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col text-center">
                                <div class="upload center @error('profile') is-invalid @enderror">
                                    @if($profile)
                                    <img src="{{$profile->temporaryUrl() }}" width=160 height=160 alt="">
                                    @else
                                    <img src="" width=160 height=160 alt="">
                                    @endif
                                    <div class="round upload">
                                        <input type="file" wire:model="profile" width=160 height=160 alt="">
                                        <i class="fa fa-camera" style="color: #fff;"> <i class="bi bi-camera-fill"></i></i>
                                    </div>
                                </div>
                                @error('profile') <span class="invalid-feedback">{{ __($message) }}</span> @enderror
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col ">
                                <label for="email" class="form-label">{{__('Email')}} <small class="text-danger">*</small></label>
                                <input type="email" class="form-control custom-input @error('email') is-invalid @enderror" placeholder="{{ __('Email')}}" wire:model="email">
                                @error("email")
                                <span class="invalid-feedback">{{ __($message) }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="phone" class="form-label">{{__('Phone Number')}} <small class="text-danger">*</small></label>
                                <input type="text" class="form-control custom-input @error('phone') is-invalid @enderror" placeholder="{{ __('Phone Number')}}" wire:model="phone">
                                @error("phone")
                                <span class="invalid-feedback">{{ __($message) }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-3">
                                <label for="password" class="form-label">{{__('Password')}} <small class="text-danger">*</small></label>
                                <input type="password" class="form-control custom-input @error('password') is-invalid @enderror" placeholder="{{ __('Password')}}" wire:model="password">
                                @error('password')<span class="invalid-feedback">{{ __($message) }}</span>@enderror
                            </div>
                            <div class="col-3">
                                <label for="confirm-password" class="form-label">{{__('Confirm Password')}}<small class="text-danger">*</small></label>
                                <input type="password" class="form-control custom-input @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Re-type Password')}}" wire:model="password_confirmation">
                                @error('password_confirmation') <span class="invalid-feedback">{{ __($message) }}</span> @enderror
                            </div>

                            <div class="col">
                                <label for="confirm-password" class="form-label">{{__('Role')}} <small class="text-danger">*</small></label>
                                <select wire:model="role_id" class=" form-select custom-input form-select-lg @error('role_id') is-invalid @enderror">
                                    <option value="">--{{__('Choose Role')}}--</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}} </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback">{{ __($message) }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary button_save">{{ __('Save')}}</button>
                    <span wire:loading>{{ __('Saving...')}}</span>
                </div>
            </div>
        </form>
    </div>
</div>