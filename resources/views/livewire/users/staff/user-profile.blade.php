<div>
    <section class="section">
        <div class="card">
            <form action="" wire:submit.prevent="updateProfile">
                <div class="card-title">
                    <h6 style="margin-left: 10px; margin-top: -3px;" class="text fw-semibold">My Profile</h6>
                    <div class="justify-content-center mt-3" style="margin-left: -30px !important;">
                        <div class="upload">
                            @if($profile)
                            <img src="{{$profile->temporaryUrl() }}" width=160 height=160 alt="">
                            @else
                            <img src="{{asset(Auth::user()->profile ?? '')}}" width=160 height=160 alt="">
                            @endif
                            <div class="round">
                                <input type="file" wire:model="profile">
                                <i class="fa fa-camera" style="color: #fff;"> <i class="bi bi-camera-fill"></i></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" wire:model="name" class="form-control" value="{{Auth::user()->name}}">
                        </div>
                        <div class="col-6">
                            <label for="name">User Name<span class="text-danger">*</span></label>
                            <input type="text" wire:model="username" class="form-control" value="{{Auth::user()->username}}">
                        </div>
                        <div class="col-6 mt-3">
                            <label for="name">Email<span class="text-danger">*</span></label>
                            <input type="text" wire:model="email" class="form-control" value="{{Auth::user()->email}}">
                        </div>
                        <div class="col-6 mt-3">
                            <label for="name">Phone Number<span class="text-danger">*</span></label>
                            <input type="text" wire:model="phone" class="form-control" value="{{Auth::user()->phone}}">
                        </div>
                        <div class="col-12 mt-3">
                            <label for="form-select">Role</label>
                            <select wire:model="type" class="form-select form-select-lg">
                                <option value="{{Auth::user()->type}}">{{Auth::user()->type}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <button type="submit" class="btn btn-primary button_save">Update</button>
                </div>
            </form>
        </div>
    </section>
</div>