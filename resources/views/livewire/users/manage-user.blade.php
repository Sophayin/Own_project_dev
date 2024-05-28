<div>
    @if($action == 'list')
        @livewire('users.staff.staff-list',['action'=> $action])
    @endif

    @if($action == 'role')
        @livewire('users.role.role-list',['action'=> $action])
    @endif
</div>



