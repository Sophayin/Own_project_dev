<div>
    <section class="section">
        <form action="" wire:submit.prevent="submit_demote">
            <div class="d-flex mb-2">
                <h6 class="mt-2">
                    <a wire:navigate href="{{route('agency.list', 'list?action=demote')}}"><i class="bi bi-arrow-left-circle-fill"></i>
                        <small class="text-sm">
                            {{__('Back')}}
                        </small>
                    </a>
                    <i class="bi bi-chevron-right"></i>
                    {{__('Demote')}} &nbsp;
                </h6>
                <button type="submit" class="btn btn-danger"> {{__('Demote')}}</button>
            </div>
            <div class="container-fluid card mb-2 mt-3">
                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 justify-content-center">
                            <div class=" upload">
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
                        <div class=" col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <div class="col-6">
                                    <!--Choose Position-->
                                    <label for="label_position">{{__('Choose Position')}} <span class="text-danger">*</span></label>
                                    <select wire:model.change="position_id" class="form-select form-select-lg @error('position_id') is-invalid @enderror">
                                        <option value="">--{{__('Choose Position')}}--</option>
                                        @foreach ($position_list as $item )
                                        <option value="{{$item->id}}"> {{get_translation($item)}} ({{$item->abbreviation}}) </option>
                                        @endforeach
                                    </select>
                                    @error('position_id')<small class="invalid-feedback">{{__($message)}}</small>@enderror <br>
                                </div>
                                <div class="col-6">
                                    <label for="label_leader_id" class="text">{{__('New Leader')}} <span class="text-danger">*</span></label>
                                    <select wire:model.live="leader_id" class="form-select js-example-templating @error('leader_id') is-invalid @enderror" id="selectleader" style="width: 100%;">
                                        <option value="">--{{__('Choose Leader')}}--</option>
                                        @foreach($agency_leader_list as $agen)
                                        <option value="{{$agen->id}}" {{$agen->id == $leader_id ? 'selected': ''}}>({{$agen->code}}) - {{$agen->full_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('leader_id')<small class="invalid-feedback">{{__($message)}}</small>@enderror <br>
                                </div>
                                <div class="col-6">
                                    <label for="current_leader_code" class="text">{{__('Current Leader')}} </label>
                                    <input type="text" wire:model="current_leader_code" class="form-control " readonly placeholder="{{__('Current Leader')}}">
                                </div>
                                <div class="col-6">
                                    <label for="labele_agency_code" class="text">{{__('New Code')}} </label>
                                    <input type="text" wire:model="agency_code" class="form-control @error('agency_code') is-invalid @enderror" placeholder="{{__('New Code')}}">
                                    @error('agency_code')<small class="invalid-feedback">{{__($message)}}</small>@enderror <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-data="{ activeTab: 1 }">
                    <div class="row">
                        <!--Tabs -->
                        <div class="nav flex-column nav-pills mt-3 d-flex" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item " role="presentation">
                                    <a x-on:click.prevent="activeTab = 1" :class="{ 'active': activeTab === 1 }" class="nav-link" id="v-pills-tab1" data-bs-toggle="pill" href="#v-pills-home">{{__('Agency Member')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div x-show="activeTab === 1" class="tab-pane fade show active" id="v-pills-home">
                                    <div class="tab-pane fade show active mt-3 " id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-secondary">{{__('No.')}} </th>
                                                        <th class="text-center text-secondary">{{__('Code')}}</small></th>
                                                        <th class="text-center text-secondary">{{__('Agency Name')}}</small></th>
                                                        <th class="text-center text-secondary">{{__('Gender')}}</small></th>
                                                        <th class="text-center text-secondary">{{__('Phone Number')}}</small></th>
                                                        <th class="text-center text-secondary">{{__('Leader')}}</small></th>
                                                        <th class="text-center text-secondary">{{__('Referrer')}}</small></th>
                                                        <th class="text-center text-secondary">{{__('Register Date')}}</small></th>
                                                        <th class="text-center text-secondary">{{__('Status')}}</small></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($recruitagencies->count() > 0)
                                                    @foreach ($recruitagencies as $key => $agency )
                                                    <tr class="text-center">
                                                        <td class="text-sm">
                                                            <input class="form-check-input" id="flexCheck{{$agency->id .'-'.$agency->id}}" type="checkbox" wire:model.live="selectedAgencies" value="{{$agency->id}}">
                                                            <label class="form-check-label" for="flexCheck{{$agency->id .'-'.$agency->id}}">{{++$key}}</label>
                                                        </td>
                                                        <td class="text-sm">{{$agency->code}}</td>
                                                        <td class="text-sm">{{$agency->full_name}}</td>
                                                        <td class="text-sm">{{__($agency->gender)}}</td>
                                                        <td class="text-sm">{{$agency->phone}}</td>
                                                        <td class="text-sm">{{$agency->parent->code?? ''}}</td>
                                                        <td class="text-sm">{{$agency->referrer_code }}</td>
                                                        <td class="text-sm">{{date("d/m/Y",strtotime($agency->registered_date))}}
                                                        <td class="text-sm">{{__(get_agency_status($agency->status)['label'])}}</td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <td colspan="9" class="text-center">{{__('No Record Found.!')}}</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
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