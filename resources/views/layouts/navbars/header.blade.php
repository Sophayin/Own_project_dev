<?php

use App\Models\Department;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

if (Auth::user()->role_user) {
    $role_id = Auth::user()->role_user->role_id;
} else {
    $role_id = Auth::user()->staff->role_id;
}
$department = Department::where('slug', '/' . Request::segment(1))->first();
?>
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between text">
        <a href="" class="logo d-flex align-items-center">
            <img src="{{asset('assets/auth/image.png')}}" alt="Super Admin">
        </a>
        <i class="bi bi-list toggle-sidebar-btn d-none"></i>
    </div>
    <div class="search-bar" style="margin-left: 31px;">
        @if($department)
        <?php
        $parent = Department::find($department->id);
        $depart_children = Department::where(['parent_id' => $department->id])
            ->where('type', 'menu')
            ->whereHas('role_permission', function ($query) use ($role_id) {
                $query->where('role_id', $role_id);
            })
            ->orderBy('sort', 'asc')->get();
        ?>
        @if($depart_children)
        <ul class="nav nav-tabs d-flex" role="tablist">
            @foreach($depart_children as $depart)
            <?php $action = $depart->slug == 'user' ? '' : ""; ?>
            <li class="nav-item flex-fill" role="presentation">
                <a class="nav-link {{ strcmp($depart->slug, '/'.Request::path()) ? '' : 'active'}}"
                    href="{{$depart->slug}}" wire:navigate role="tab">
                    <span style="position: relative;top: -1px; right:4px">{!! $depart->icon !!}</span>
                    <span>{{get_translation($depart)}}</span>
                </a>
            </li>
            @endforeach
        </ul>
        @endif
        @endif

    </div><!-- End Search Bar -->
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle" href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <!-- End Search Icon-->
            <li class="nav-item d-flex">
                <livewire:Component.SwitchLanguage />
            </li>
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ staff_profile(Auth::user()->profile) }}" class="rounded-circle"
                        style="border:solid transparent;" alt="{{Auth::user()->name}}">
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{Auth::user()->name}}</h6>
                        <span>{{Auth::user()->staff->role->name ?? ""}}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center"
                            href="{{route('user-profile',Auth::user()->id)}}">
                            <i class="bi bi-person"></i>
                            <span>{{__('My Profile')}}</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <livewire:Auth.logout />
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
</header>