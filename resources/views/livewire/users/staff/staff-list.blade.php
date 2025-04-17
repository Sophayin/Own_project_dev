<div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class=" d-flex justify-content-between mt-3">
                            <h5>{{__('User List')}}</h5>
                            <a wire:click="open_modal_register" class="btn btn-primary button_save p-2">
                                <i class="bi bi-plus-circle"></i>
                                {{__('Add New')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $n = 1; ?>
        @foreach($staff as $key => $item)
        <div class="col-lg-3 mb-4">
            <div class="card-body mb-4">
                <div class="border-0 shadow-sm">
                    <div class="d-flex mb-3 justify-content-between">
                        <div class="p-2 d-flex">
                            <div class="">
                                <a wire:click="edit_current_password({{ $item->id }})" class="text-default rounded-pill btn btn-sm">
                                    <i style="font-size: 1.2rem;" class="bi bi-person-lock"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end pointer">
                            <div class="p-2 mt-1">
                                <div class="col-lg-12 col-sm-6 text-default">
                                    <a wire:click="edit_user({{ $item->user_id }})" class="rounded-pill btn btn-sm btn text-default">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex p-1">
                        <div class="col-lg-6 p-2" style="margin-top: -20px;">
                            <h6 class="p-1"><i class="bi bi-cart-plus p-2"></i> Username</h6>
                            <h6 class="p-1"> <i class="bi bi-brightness-alt-high-fill p-2"></i> Full Name
                            </h6>
                            <h6 class="p-1"> <i class="bi bi-brightness-high-fill p-2"></i> Email</h6>
                            <h6 class="p-1"> <i class="bi bi-brightness-alt-low-fill p-2"></i> Phone</h6>
                            <h6 class="p-1"> <i class="bi bi-cup-hot p-2"></i> Position <strong
                                    class="text-danger"></strong></h6>
                        </div>
                        <div class="col-lg-6 p-2" style="margin-top: -17px;">
                            <h6>{{$item->user->username}}</h6>
                            <h6 class="mt-3"> <strong>{{$item->user->name}} </strong></h6>
                            <h6 class="mt-3"> <strong>{{$item->user->email}} </strong></h6>
                            <h6 class="mt-4"> <strong>{{$item->user->phone}} </strong></h6>
                            <h6 class="mt-3"> <strong>{{$item->role->name?? ''}} </strong></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </section>

    @livewire('users.staff.staff-create')
    @livewire('users.staff.staff-update')
    @livewire('users.staff.staff-change-password')

</div>