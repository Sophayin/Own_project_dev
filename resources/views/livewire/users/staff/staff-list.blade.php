<div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class=" d-flex justify-content-between mt-3">
                            <h5>{{__('User List')}}</h5>
                            <a wire:click="open_modal_register" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i>
                                {{__('Add New')}}
                            </a>
                        </div>
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th width="30" class="text-center text-secondary text-sm opacity-7">{{__('No.')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Picture')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Full Name')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('UserName')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Email')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Phone Number')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Position')}}</th>
                                    <th width="120" class="text-center text-secondary text-sm opacity-7">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $n = 1; ?>
                                @foreach($staff as $key => $item)
                                <tr style="vertical-align:middle" class="text-center">
                                    <td scope="row">{{$n++}}</td>
                                    <td>
                                        <img src="{{ staff_profile($item->user->profile) }}" width="45" height="75" class="d-block img-thumbnail" style="border:solid transparent;" alt="{{$item->user->name}}">
                                    </td>
                                    <td class="text-sm">{{$item->user->name}}</td>
                                    <td class="text-sm">{{$item->user->username}}</td>
                                    <td class="text-sm">{{$item->user->email}}</td>
                                    <td class="text-sm">{{$item->user->phone}}</td>
                                    <td class="text-sm">{{$item->role->name}}</td>
                                    <td class="text-sm" align="center">
                                        <a style="border-color:azure;" wire:click="edit_current_password({{ $item->id }})" class="rounded-pill btn btn-sm btn-outline-secondary">
                                            <i style="font-size: 1.2rem;" class="bi bi-person-lock"></i>
                                        </a>
                                        <a style="border-color:azure;" wire:click="edit_user({{ $item->user_id }})" class="rounded-pill btn btn-sm btn btn-outline-success">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row  mb-3 mt-3">
                            @if($staff->count())
                            <div class="col-sm-1">
                                <select class="form-select" wire:model.live="limit" aria-label="Default">
                                    <option value="15">15</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            @endif
                            <div class="col ">
                                {{$staff->links('livewire.customer-pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @livewire('users.staff.staff-create')
    @livewire('users.staff.staff-update')
    @livewire('users.staff.staff-change-password')

</div>