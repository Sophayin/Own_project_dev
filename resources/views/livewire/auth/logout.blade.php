<a class="dropdown-item d-flex align-items-center logout" style="margin-left: 20px !important;" wire:click="logout" href="#">
    <i class="bi bi-box-arrow-right"></i>
    <span style="margin-left: 12px !important;">{{__('Sign Out')}}</span>
    <div wire:loading wire:target="logout">
        Processing...
    </div>
</a>