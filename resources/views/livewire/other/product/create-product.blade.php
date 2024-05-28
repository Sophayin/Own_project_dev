<div wire:ignore.self class="modal fade" id="openModal">
    <div class="modal-dialog modal-xl">
        <form action="" wire:submit.prevent="createNewProduct">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text fw-semibold">{{__('Add New Product')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4 mb-3">
                            <label class="text fw-semibold">{{__('Product Name')}} <small class="text-danger">*</small></label>
                            <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" placeholder="{{__('Product Name')}}">
                            @error('title') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                        </div>
                        <div class="col-4 mb-3">
                            <label class="form-label text fw-semibold">{{ __('Condition')}}</label>
                            <select class="form-select form-select-lg @error('condition') is-invalid @enderror" wire:model="condition" style="margin-top: -8px;">
                                <option value="New">{{__('New')}}</option>
                                <option value="Used">{{__('Used')}}</option>
                            </select>
                            @error('condition') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                        </div>
                        <div class="col-4 mb-3">
                            <label class="text fw-semibold">{{__('Price')}}</label>
                            <input type="text" id="price" wire:model="price" class="form-control @error('price') is-invalid @enderror" placeholder="{{__('Price')}}">
                            @error('price') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                        </div>
                        <div class="col-4 mb-3">
                            <label class="text fw-semibold">{{__('Year of Manufacture')}}</label>
                            <input type="text" wire:model="year_of_manufacture" class="form-control @error('year_of_manufacture') is-invalid @enderror" placeholder="{{__('Year of Manufacture')}}">
                            @error('year_of_manufacture') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                        </div>
                        <div class="col-4 mb-3">
                            <label class="text fw-semibold">{{__('Code')}}</label>
                            <input type="text" wire:model="code" class="form-control @error('code') is-invalid @enderror" placeholder="{{__('Code')}}">
                            @error('code') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                        </div>
                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <label class="form-label text fw-semibold">{{__('Description')}} </label>
                            <textarea type="text" class="form-control" wire:model="description" placeholder="{{__('Type here...')}}"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" wire:click="createNewProduct" class=" btn btn-primary button_save">{{__('Create')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>