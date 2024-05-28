<div class="row d-flex mt-2">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text text-secondary">{{__('Set Default')}}</th>
                <th class="text text-secondary">{{__('Bank Name')}}</th>
                <th class="text text-secondary">{{__('Account Number')}}</th>
                <th class="text text-secondary">{{__('Account Name')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bank_item as $key => $item)
            <tr>
                <td class="text text-center">
                    <input type="radio" class="form-check-input mt-2" wire:click="selectBank({{$key}})" id="bank_{{$key}}" wire:model="bank_item.{{$key}}.status" value="1">
                </td>
                <td class="text">
                    <input type="text" class="form-control" wire:model="bank_item.{{$key}}.name" placeholder="{{__('Bank Name')}}">
                </td>
                <td class="text">
                    <input type="text" class="form-control" wire:model="bank_item.{{$key}}.account_number" placeholder="{{__('Bank Account Number')}}">
                </td>
                <td class="text">
                    <input type="text" class="form-control" wire:model="bank_item.{{$key}}.account_name" placeholder="{{__('Bank Account Name')}}">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div wire:click="addBank" class="col-lg-3 col-md-3 col-sm-6 mt-3 ">
    <span class="pointer">
        <i class="bi bi-plus-circle"></i> {{__('Add new bank')}}
    </span>
</div>