<div>
    <section class="section">
        <form action="" wire:submit.prevent="promote">
            <div class="d-flex mb-2">
                <h6 class="mt-2">
                    <a wire:navigate href="{{route('agency.list', 'list?action=promote')}}"><i class="bi bi-arrow-left-circle-fill"></i>
                        <small class="text-sm">
                            {{__('Back')}}
                        </small>
                    </a>
                    <i class="bi bi-chevron-right"></i>
                    {{__('Promote')}} &nbsp;
                </h6>
                <button type="submit" class="btn btn-primary button_save"> {{__('Promote')}}</button>
            </div>
            <div class="card">
                <div class="row card-body mt-3">
                    <!-- Agency Profile-->
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 justify-content-center mt-3" style="width: 15%;">
                        <div class="upload border-1" style="margin-right: 30px;">
                            <img src="{{asset($agency->agency_profile)}}" width=160 height=160 alt="">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="d-flex col-12">
                            <p class="col-3 text">{{__('Full Name')}} </p>
                            <p class=" col-9 ml-5 text"> : {{$agency->full_name}} </p>
                        </div>
                        <div class="d-flex col-12">
                            <p class="col-3 text">{{__('Code')}} </p>
                            <p class=" col-9 ml-5 text"> : {{$agency->code}}</p>
                        </div>
                        <div class="d-flex col-12">
                            <p class="col-3 text">{{__('Gender')}} </p>
                            <p class=" col-9 ml-5 text"> : {{__($agency->gender)}} </p>
                        </div>
                        <div class="d-flex col-12">
                            <p class="col-5 text">{{__('Current Position')}} </p>
                            <p class="col-7 ml-5 text"> : {{__($agency->position->name) ?? ''}} </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col">
                                <!--Choose Position-->
                                <label for="position_id" class="text">{{__('Position')}} <span class="text-danger">*</span></label>
                                <select wire:model.live="position_id" class="form-select form-select-lg @error('position_id') is-invalid @enderror">
                                    <option value="%">--{{__('Choose Position')}}--</option>
                                    @foreach ($position_list as $item )
                                    <option value="{{$item->id}}"> {{get_translation($item)}} ({{$item->abbreviation}})</option>
                                    @endforeach
                                </select>
                                @error('position_id')<small class="fs-light fw-light text-danger">{{__($message)}}</small>@enderror <br>
                            </div>

                            <div class="col">
                                <!--Choose New Leader-->

                                <label for="leader_id" class="text">{{__('Choose New Leader')}} <span class="text-danger">*</span></label>
                                <select wire:model.live="leader_id" class="@error('leader_id') is-invalid @enderror selectleader" id="selectleader" style="width: 100%;">
                                    <option value="0">--{{__('Choose Leader')}}--</option>
                                    @foreach($agency_leader_list as $agen)
                                    <option value="{{$agen->id}}" {{$agen->id == $leader_id ? 'selected': ''}}>({{$agen->code}}) - {{$agen->full_name}}</option>
                                    @endforeach
                                </select>
                                @error('leader_id')<small class="fs-light fw-light text-danger">{{__($message)}}</small>@enderror <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="label_current_leader_code" class="text">{{__('Current Leader')}}</label>
                                <input type="text" wire:model="current_leader_code" class="form-control" placeholder="{{__('Current Leader')}}">
                            </div>
                            <div class="col">
                                <label for="agency_code" class="text">{{__('New Code')}} </label>
                                <input type="text" wire:model="agency_code" class="form-control @error('agency_code') is-invalid @enderror" placeholder="{{(__('New Code'))}}">
                                @error('agency_code')<small class="fs-light fw-light text-danger">{{__($message)}}</small>@enderror <br>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-data="{ activeTab: 1 }">
                    <div class="container">
                        <div class="row">
                            <!-- Tabs -->
                            <div class="nav flex-column nav-pills mt-3 d-flex" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item " role="presentation">
                                        <a x-on:click.prevent="activeTab = 1" :class="{ 'active': activeTab === 1 }" class="nav-link" id="v-pills-tab1" data-bs-toggle="pill" href="#v-pills-home">{{__('Referrer List')}}</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a x-on:click.prevent="activeTab = 2" :class="{ 'active': activeTab === 2 }" class="nav-link" id="v-pills-tab2" data-bs-toggle="pill" href="#v-pills-commission">{{__('Upload Document')}}</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Tab Content -->
                            <div class="col-md-12">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div x-show="activeTab === 1" class="tab-pane fade show active" id="v-pills-home">
                                        <!-- Referrer list -->
                                        @include('livewire.agency.suggestion.referrer')
                                    </div>
                                    <div wire:ignore x-show="activeTab === 2" class="tab-pane fade" id="v-pills-commission">
                                        <!-- Uplod Document -->
                                        @include('livewire.agency.suggestion.upload-document',['prop'=> 'upload_document'])
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

@push('scripts')
<script>
    Livewire.on('loadLeaderSelected', postId => {
        jQuery(document).ready(function() {
            $('#selectleader').select2();
        });
    });

    jQuery(document).ready(function() {
        $('#selectleader').select2();
        $('#selectleader').on('change', function(e) {
            @this.set('leader_id', e.target.value);
        });
    });
</script>
@endpush