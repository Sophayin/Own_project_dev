<div>
    <div class="row d-flex">
        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
            <label for="text" class="form-label text">{{__('City')}} {{session('local')}}</label>
            <select wire:change="onChange('city', $event.target.value)" wire:model="city_id" class="form-select form-select-lg @error('city_id') is-invalid @enderror">
                <option value="">--{{__('Choose City')}}--</option>
                @foreach($cities as $city)
                <option value="{{$city->id}}">
                    {{get_translation($city)}}
                </option>
                @endforeach
            </select>
            @error('city_id') <small class="fw-light text-danger">{{__($message)}}</small> @enderror
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
            <label for="exampleFormControlInput1" class="form-label text">{{__('District')}} </label>
            <select wire:change="onChange('district', $event.target.value)" wire:model="district_id" class="form-select form-select-lg @error('district_id') is-invalid @enderror">
                <option value="">--{{__('Choose District')}}--</option>
                @foreach($districts as $district)
                <option value="{{$district->id}}">
                    {{get_translation($district)}}
                </option>
                @endforeach
            </select>
            @error('district_id') <small class="fw-light text-danger">{{__($message)}}</small> @enderror
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
            <label for="" class="form-label text">{{__('Commune')}} </label>
            <select wire:change="onChange('commune', $event.target.value)" wire:model="commune_id" class=" form-select form-select-lg @error('commune_id') is-invalid @enderror" aria-label="Default select example">
                <option selected value="">--{{__('Choose Commune')}}--</option>
                @foreach($communes as $commune)
                <option value="{{$commune->id}}">
                    {{get_translation($commune)}}
                </option>
                @endforeach
            </select>
            @error('commune_id') <small class="fw-light text-danger">{{__($message)}}</small> @enderror
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <label class="form-label text">{{__('Village')}}</label>
            <select wire:model="village_id" class="form-select form-select-lg" aria-label="Choose Village">
                <option selected value="">--{{__('Choose Village')}}--</option>
                @foreach($villages as $village)
                <option value="{{$village->id}}">
                    {{get_translation($village)}}
                </option>
                @endforeach
            </select>
            @error('village_id') <small class="fw-light text-danger">{{__($message)}}</small> @enderror
        </div>
    </div>
    <div class="row d-flex">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <label class="form-label text">{{__('House No.')}}</label>
            <input type="text" class="form-control" wire:model="house_no" placeholder="{{__('House No.')}}">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
            <label class="form-label text">{{__('Street No.')}}</label>
            <input type="text" class="form-control" wire:model="street_no" placeholder="{{__('Street No.')}}" />
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <label class="form-label text">{{__('Google Longtitude')}}</label>
            <input type="text" class="form-control" wire:model="longitude" placeholder="{{__('Google Longtitude')}}" />
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <label class="form-label text">{{__('Google Latitude (Optional)')}}</label>
            <input type="text" class="form-control" wire:model="latitude" placeholder="{{__('Google Latitude (Optional)')}}" />
        </div>
    </div>
</div>

@push('scripts')
<script>
    Livewire.on('findAgencyLeader', postId => {
        jQuery(document).ready(function() {
            $('#select_city').select2();
        });
    })

    jQuery(document).ready(function() {
        $('#select_city').on('change', function(e) {
            @this.set('city_id', $(this).val());
        });
    });
</script>
@endpush