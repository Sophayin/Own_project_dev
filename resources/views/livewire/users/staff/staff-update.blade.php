<div wire:ignore.self class="modal fade" id="openModalUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl ">
        <form wire:submit.prevent="updateUser">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Staff Update')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mb-2 justify-content-md-center">
                            <div class="col-md-2" style="width: 12.666667%;">
                                <!--<div wire:loading wire:target="profile">Uploading...</div>-->
                                <div class="upload">
                                    @if($profile)
                                    <img src="{{$profile->temporaryUrl() }}" width=160 height=160 alt="">
                                    @else
                                    <img src="{{ asset($old_profile) }}" width=160 height=160 alt="">
                                    @endif
                                    <div class="round upload">
                                        <input type="file" wire:model="profile" width=160 height=160 alt="">
                                        <i class="fa fa-camera" style="color: #fff;"> <i class="bi bi-camera-fill"></i></i>
                                    </div>
                                </div>
                                @error('profile') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="name" class="form-label">{{__('Name')}}<small class="text-danger">*</small> </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="{{__('Name')}}" wire:model="name">
                                @error('name')
                                <span class="invalid-feedback">{{ __($message) }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="username" class="form-label">{{__('UserName')}}<small class="text-danger">*</small></label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="{{__('Username')}}" wire:model="username">
                                    @error('username')
                                    <span class="invalid-feedback">{{ __($message) }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="email" class="form-label">{{__('Your Email')}}<small class="text-danger">*</small></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{__('Email')}}" wire:model="email">
                                @error("email")
                                <span class="invalid-feedback">{{ __($message) }}</span>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="phone" class="form-label">{{__('Phone Number')}} <small class="text-danger">*</small> </label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="{{__('Phone Number')}}" wire:model="phone">
                                @error("phone")
                                <span class="invalid-feedback">{{ __($message) }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label for="confirm-password" class="form-label">{{__('Role')}} <small class="text-danger">*</small></label>
                                <select wire:model="role_id" class="form-select @error('role_id') is-invalid @enderror">
                                    <option>{{__('Choose Role')}}</option>
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
                    <button type="submit" class="btn btn-primary button_save">{{__('Save')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>