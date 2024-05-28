<a class="dropdown-item d-flex align-items-center" wire:click="logout" href="#">
    <i class="bi bi-box-arrow-right"></i>
    <span>{{__('Sign Out')}}</span>
    <div wire:loading wire:target="logout">
        Processing...
    </div>
</a>