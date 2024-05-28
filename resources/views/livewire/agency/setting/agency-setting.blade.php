<div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mt-3">
                    <div class="row mb-2">
                        <div class="col text-center">
                            <label>{{__($label)}}</label>
                            <input class="form-control text-center @error('valueInput') is-invalid @enderror" placeholder="{{__('Commission Fee')}}" type="number" wire:model="valueInput">
                            @error('valueInput')
                            <span class="invalid-feedback">{{ __($message) }}</span>
                            @enderror
                        </div>
                        @if($prop == 'commission_fee')
                        <div class="col text-center">
                            <label>{{__('Override Fee')}}</label>
                            <input class="form-control text-center @error('override_fee') is-invalid @enderror" placeholder="{{__('Override Fee')}}" type="number" wire:model="override_fee">
                            @error('override_fee')
                            <span class="invalid-feedback">{{ __($message) }}</span>
                            @enderror
                        </div>
                        @endif
                        <div class="modal-footer justify-content-center">
                            <button type="button" wire:click="update" class="btn btn-primary mt-4">{{__('Save')}}</button>
                            <span wire:loading class="mt-4">{{__('Saving...')}}</span>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>