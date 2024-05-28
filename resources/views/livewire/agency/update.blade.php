<div>
    <section class="section">
        <form action="" wire:submit.prevent="update">
            <h6 class="main_application ">
                <a wire:navigate href="{{route('agency.list','list')}}">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                    <small class="text-sm"> {{__('Back')}}</small>
                </a>
            </h6>
            <div class="col col-xxl-12 col-xl-12 card col-lg-12 col-md-12 col-sm-12 ">
                <div class="container-fluid mb-2 mt-3">
                    <div class="row d-flex mb-2">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 justify-content-center mt-3">
                            <div class="upload">
                                @if($agency_profile)
                                <img src="{{$agency_profile->temporaryUrl() }}" width=160 height=160 alt="">
                                @else
                                <img src="{{asset($agency->agency_profile)}}" width=160 height=160 alt="">
                                @endif
                                <div class="round">
                                    <input type="file" wire:model="agency_profile">
                                    <i class="fa fa-camera" style="color: #fff;"> <i class="bi bi-camera-fill"></i></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-6">
                            <div class="d-flex">
                                <p class="col-2">{{__('Agency Name')}} </p>
                                <p class="col-10 ml-5"> : {{$agency->full_name}}</p>
                            </div>
                            <div class="d-flex">
                                <p class="col-2">{{__('Code')}} </p>
                                <p class="col-10 ml-5"> : {{$agency->code}}</p>
                            </div>
                            <div class="d-flex">
                                <p class="col-2">{{__('Position')}} </p>
                                <p class="col-10 ml-5"> : {{ $agency->position ? get_translation($agency->position) : ''}} ({{$agency->position->abbreviation ?? ''}})</p>
                            </div>
                            <div class="d-flex">
                                <p class="col-2">{{__('Leader Name')}}</p>
                                <p class="col-10"> : {{$agency->parent->full_name ?? ''}}</p>
                            </div>
                            <div class="d-flex">
                                <p class="col-2">{{__('Status')}}</p>
                                <p class="col-10"> :
                                    {{ __(get_agency_status($agency->status)['label']) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{$activeTab == 'information' ? 'active':''}}" wire:navigate href="{{route('agency.list', 'list?action=update&agency_id='.$agency->id.'&tab=information')}}" id="home-tab">{{__('Information')}} </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{$activeTab == 'address' ? 'active':''}}" wire:navigate href="{{route('agency.list', 'list?action=update&agency_id='.$agency->id.'&tab=address')}}" id="address-tab">{{__('Address')}}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{$activeTab == 'application' ? 'active':''}} " wire:navigate href="{{route('agency.list', 'list?action=update&agency_id='.$agency->id.'&tab=application')}}" id="application-tab">{{__('Applications')}}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{$activeTab == 'upload' ? 'active':''}} " wire:navigate href="{{route('agency.list', 'list?action=update&agency_id='.$agency->id.'&tab=upload')}}" id="upload-tab">{{__('Upload Document')}}</a>
                        </li>
                    </ul>
                    @if($activeTab == 'information')
                    @include('livewire.agency.pages.Information')

                    @elseif($activeTab == 'address')
                    @include('livewire.agency.pages.Address')

                    @elseif($activeTab == 'application')
                    @include('livewire.agency.pages.Application', ['agency' => $agency])

                    @else($activeTab == 'upload')
                    @include('livewire.agency.pages.Upload')
                    @endif
                </div>
            </div>
        </form>
    </section>
</div>