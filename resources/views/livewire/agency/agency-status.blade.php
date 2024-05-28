<div class="row d-flex mb-2">
    <div class="col-lg-12">
        <label class="form-label text">{{__('Status')}}</label>
        <select wire:model="status" class="form-select form-select-lg">
            <option value="0">{{__('Choose Status')}}</option>
            @foreach(get_agency_status() as $status)
            <option value="{{$status['id']}}">{{__($status['label'])}}</option>
            @endforeach
        </select>
    </div>
</div>