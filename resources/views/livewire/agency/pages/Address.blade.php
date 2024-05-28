<div class="tab-pane" id="address" role="tabpanel" aria-labelledby="profile-tab">
    <form action="" wire:submit.prevent="update">
        <div class="row mt-3">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <label class="form-label ">{{__('City')}} <small class="text-danger">*</small></label>
                <select wire:change="onChange('city',$event.target.value)" class="form-select form-select-lg" wire:model="city_id">
                    <option value="">--{{__('Choose City')}}--</option>
                    @foreach($cities as $city)
                    <option value="{{$city->id}}">{{get_translation($city)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <label class="form-label text">{{__('District')}}</label>
                <select wire:change="onChange('district', $event.target.value)" class="form-select form-select-lg" wire:model="district_id">
                    <option value="">--{{__('Choose District')}}--</option>
                    @foreach($districts as $district)
                    <option value="{{$district->id}}">{{get_translation($district)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <label class="form-label text">{{__('Commune')}} </label>
                <select wire:change="onChange('commune', $event.target.value)" class="form-select form-select-lg" wire:model="commune_id">
                    <option value="">--{{__('Choose Commune')}}--</option>
                    @foreach($communes as $commune)
                    <option value="{{$commune->id}}">{{get_translation($commune)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <label class="form-label text">{{__('Village')}}</label>
                <select class="form-select form-select-lg " wire:model="village_id">
                    <option value="">--{{__('Choose Village')}}--</option>
                    @foreach($villages as $village)
                    <option value="{{$village->id}}">{{get_translation($village)}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <label class="form-label">{{__('House No.')}} </label>
                <input type="text" class="form-control" wire:model="house_no" placeholder="{{__('House No.')}}">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <label class="form-label">{{__('Street No.')}}</label>
                <input type="text" class="form-control" wire:model="street_no" placeholder="{{__('Street No.')}}">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <label class="form-label text">{{__('Google Latitude (Optional)')}}</label>
                <input type="text" class="form-control" wire:model="latitude" placeholder="{{__('Google Latitude (Optional)')}}">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <label class="form-label ">{{__('Google Longtitude')}}</label>
                <input type="text" class="form-control" wire:model="longitude" placeholder="{{__('Google Longtitude')}}">
            </div>
        </div>
        <div class="modal-footer justify-content-center mt-3 mb-3">
            <button type="bubmit" class="btn btn-primary button_save">{{__('Update')}}</button>
        </div>
    </form>
</div>