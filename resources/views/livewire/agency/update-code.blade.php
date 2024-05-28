<div>
    <div class="row d-flex">
        <div class="col-lg-6 col-sm-12 mt-3 mb-3">
            <label>{{__('Leader')}} </label>
            <select wire:model.live="agency_id" wire:click="generateNewCode" class="form-select form-select-lg ">
                <option value="0">{{__('Choose Leader')}}</option>
                @foreach($agency_leader as $agen)
                <option value="{{$agen->id}}" {{$agen->code == $leader_code ? 'selected': ''}}>{{$agen->code ? '('.$agen->code .') - ' : ""}} {{$agen->full_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-6 col-sm-12 mt-3 mb-3">
            <label>{{__('New Agency Code')}}</label>
            <input wire:model="code" type="text" class="form-control" value="{{$code}}" readonly>
        </div>
    </div>
</div>