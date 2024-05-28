<div>
    <section class="section">
        <h5 class="text p-1">{{__('Download Region')}}</h5>
        <div class="card h-100 mt-3">
            <div class="row d-flex p-3">
                <div class="col-4">
                    <label class="text p-1">{{__('Select City For Downloading')}} <span class="text-danger">*</span></label>
                    <select wire:model.live="city_id" class="form-select form-select-lg  @error('city_id') is-invalid @enderror" aria-label="Large select example">
                        <option value="">{{__('Choose City')}}</option>
                        @foreach ($cities as $city )
                        <option value="{{$city->id}}">{{get_translation($city)}}</option>
                        @endforeach
                    </select>
                    @error('city_id') <small class="invalid-feedback">{{ __($message) }}</small> @enderror <br>
                </div>
                <div class="col-2 p-2 mt-4">
                    <button wire:click="downloadCity" class="btn btn-primary button_save">{{ __('Download') }}</button>
                </div>
            </div>
        </div>
    </section>
</div>