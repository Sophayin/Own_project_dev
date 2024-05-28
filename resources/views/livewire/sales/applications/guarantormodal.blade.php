<div class="row d-flex mb-2">
    <div class="col-lg-4 col-md-6 col-sm-12">
        <label class="form-label text">{{__('Full Name (Khmer)')}} </label>
        <input type="text" class="form-control @error('guarantor_name_translate') is-invalid @enderror" wire:model="guarantor_name_translate" placeholder="{{__('Enter Full Name')}} ">
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <label class="form-label text">{{__('Full Name (English)')}}</label>
        <input type="text" class="form-control @error('guarantor_name') is-invalid @enderror" wire:model="guarantor_name" placeholder="{{__('Enter Full Name (English)')}} ">
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <label class="form-label text">{{__('Phone Number')}} </label>
        <input type="text" class="form-control @error('guarantor_phone') is-invalid @enderror" wire:model="guarantor_phone" placeholder="{{__('Enter Phone Number')}} " />
    </div>
</div>