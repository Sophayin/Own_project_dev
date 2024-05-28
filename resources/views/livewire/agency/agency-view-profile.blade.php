<div>
    <section class="section">
        <div class="card ">
            <div class="row d-flex mt-2">
                <div class="col-lg-2 col-md-5 col-sm-6 justify-content-center mt-3">
                    <div class="upload">
                        <img src="{{asset($agency->agency_profile)}}" width=160 height=160 alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Agency Name')}} </div>
                        <div class="col-9 ml-5"> : {{$agency->full_name}}</div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Code')}} </div>
                        <div class="col-9 ml-5"> : {{$agency->code}}</div>
                    </div>
                    <div class="d-flex">
                        <div class="col-4">{{__('Position')}} </div>
                        <div class="col-9 ml-5"> : {{__($agency->position->name)}} ({{$agency->position->abbreviation}})</div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Leader Name')}}</div>
                        <div class="col-9 ml-5"> : {{$agency->parent->full_name ?? ''}} </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Status')}}</div>
                        <div class="col-9"> :
                            @if($agency->status)
                            <span> {{ __(get_agency_status($agency->status)['label']) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Referrer Code')}}</div>
                        <div class="col-9 ml-5"> : {{$agency->referrer_code}}</div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Address')}}</div>
                        <div class="col-9 ml-5"> :
                            {{$agency->address ? $agency->address->house_no.',' : ''}}
                            {{$agency->address ? $agency->address->street_no.',' : ''}}
                            {{ $agency->address ? ($agency->address->village ? get_translation($agency->address->village).',' : '') : '' }}
                            {{ $agency->address ? ($agency->address->commune ? get_translation($agency->address->commune).',' : '') : '' }}
                            {{ $agency->address ? ($agency->address->district ? get_translation($agency->address->district).',' : '') : '' }}
                            {{ $agency->address ? ($agency->address->city ? get_translation($agency->address->city).',' : '') : '' }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Gender')}} </div>
                        <div class="col-9 ml-5"> : {{__($agency->gender)}}</div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Age')}} </div>
                        <div class="col-9 ml-5"> : {{$agency->age}} </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Date of Birth')}} </div>
                        <div class="col-9 ml-5"> :
                            @php
                            $birth = json_decode($agency->date_of_birth, true);
                            @endphp
                            @if($birth)
                            {{$birth['day']}}, {{__($birth['month'])}},{{$birth['year']}}
                            @else
                            N/A
                            @endif
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">
                            <nobr>{{__('Khmer Identity Card')}}</nobr>
                        </div>
                        <div class="col-8 ml-5"> : {{$agency->khmer_identity_card}}</div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">
                            <nobr>{{__('Bank Information')}} </nobr>
                        </div>
                        <div class="col-8 ml-5"> :
                            <?php $getbank = json_decode($agency->bank_info, true); ?>
                            @if(!empty($getbank) )
                            @foreach($getbank as $bank)
                            <span>{{$bank['name']}} : {{$bank['account_number']}}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Phone Number')}}</div>
                        <div class="col-8 ml-5"> : {{$agency->phone}}</div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Telegram Phone')}}</div>
                        <div class="col-9 ml-5"> : {{$agency->phone_telegram}}</div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="col-4">{{__('Remark')}}</div>
                        <div class="col-9 ml-5"> : {{$agency->remark}}</div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{$activeTab == 'history' ? 'active':''}}" wire:navigate href="{{route('agency.list', 'list?action=profile&agency_id='.$agency->id.'&tab=history')}}" id="home-tab">{{__('History')}} </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{$activeTab == 'agencymember' ? 'active':''}}" wire:navigate href="{{route('agency.list', 'list?action=profile&agency_id='.$agency->id.'&tab=agencymember')}}" id="agency-tab">{{__('Agency Member')}}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{$activeTab == 'application' ? 'active':''}} " wire:navigate href="{{route('agency.list', 'list?action=profile&agency_id='.$agency->id.'&tab=application')}}" id="application-tab">{{__('Applications')}}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{$activeTab == 'document' ? 'active':''}} " wire:navigate href="{{route('agency.list', 'list?action=profile&agency_id='.$agency->id.'&tab=document')}}" id="document-tab">{{__('Document List')}}</a>
                </li>
            </ul>
            @if($activeTab == 'history')
            @include('livewire.agency.view-profile-tabs.history')

            @elseif($activeTab == 'agencymember')
            @include('livewire.agency.view-profile-tabs.agency-member')

            @elseif($activeTab == 'application')
            @include('livewire.agency.view-profile-tabs.applications')

            @elseif($activeTab == 'document')
            @include('livewire.agency.view-profile-tabs.document-list')
            @endif
        </div>
    </section>
</div>