<div wire:ignore.self class="modal fade" id="openModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <form action="" wire:submit.prevent="submit_add_shop">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text fw-semibold">{{__('Assign Shop')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <label class="form-label text fw-semibold"> {{__('Shop Name')}} <small class="text-danger">*</small></label>
                        <select wire:model="shop_ids" class="form-select form-select-lg @error('shop_ids') is-invalid @enderror" multiple id="selectShop" style="width: 100%;">
                            @foreach($shops as $shop)
                            <option value="{{$shop->id}}">{{$shop->shop_name_translate}} ({{$shop->abbreviation}})</option>
                            @endforeach
                        </select>
                        @error('shop_ids') <small class="invalid-feedback">{{ __($message) }}</small> @enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class=" btn btn-primary button_save">{{__('Save')}}</button>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
    <script>
        Livewire.on('loadShop', postId => {
            jQuery(document).ready(function() {
                jQuery('#selectShop').select2({
                    dropdownParent: jQuery("#openModal")
                });
            });
        })
        jQuery(document).ready(function() {
            jQuery('#selectShop').select2({
                dropdownParent: jQuery("#openModal")
            });
            jQuery('#selectShop').on('change', function(e) {
                @this.set('shop_ids', jQuery(this).val());
            });
        });
    </script>
    @endpush
</div>