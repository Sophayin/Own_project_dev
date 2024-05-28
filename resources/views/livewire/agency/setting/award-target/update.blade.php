<div>
    <div wire:ignore.self class="modal fade" id="openModalSetAwardTarget" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form wire:submit.prevent="updateAwardTarget">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Update Award Target For')}} <b>{{__($positionName)}}</b></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 121px;" class="text-center text-secondary text-sm opacity-7">{{ __('Target/Award')}}</th>
                                        <th class="text-center text-secondary text-sm opacity-7">{{__('Target Sale')}}</th>
                                        <th class="text-center text-secondary text-sm opacity-7">{{__('Target Recruit')}}</th>
                                        <th class="text-center text-secondary text-sm opacity-7">{{ __('Salary')}}
                                        <th class="text-center text-secondary text-sm opacity-7">{{ __('Incentive')}}
                                        <th class="text-center text-secondary text-sm opacity-7">{{ __('Override Fee')}}</th>
                                    </tr>
                                </thead>
                                <thead>
                                    @foreach($awards as $key => $row)
                                    <tr class="text" style="vertical-align: middle;">
                                        <td class="text-left">{{ __($awards[$key]['name'])}}</td>
                                        <td>
                                            <input type="number" class="form-control text-center @error(' awards.{$key}.pivot.target_sale') is-invalid @enderror" wire:model="awards.{{$key}}.pivot.target_sale">
                                            @error("awards.{$key}.pivot.target_sale") <span class="invalid-feedback">{{ __($message) }}</span>@enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-center" wire:model="awards.{{$key}}.pivot.target_recruit">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-center" wire:model="awards.{{$key}}.pivot.salary">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-center" wire:model="awards.{{$key}}.pivot.incentive">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control text-center" wire:model="awards.{{$key}}.pivot.override_fee">
                                        </td>
                                    </tr>
                                    @endforeach
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        <span wire:loading>{{ __('Saving...')}}</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>