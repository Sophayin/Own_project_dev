<div>
    <div wire:ignore.self class="modal fade" id="openModalCreateAwardTarget" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form wire:submit.prevent="insertAwardTarget">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Create Award Target')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="position_id" class="form-label text">{{__('Position')}}<span class="text-danger">*</span></label>
                                    <select wire:model="position_id" wire:change="onPositionChange" class="form-select @error ('position_id') is-invalid @enderror" aria-label="Default select example">
                                        <option value="">--{{__('Select Position')}}--</option>
                                        @foreach($positions as $row)
                                        <option value="{{$row->id}}">{{get_translation($row)}} ({{$row->abbreviation}})</option>
                                        @endforeach
                                    </select>
                                    @error('position_id') <small class="error text-danger fw-lighter">{{ __($message) }}</small> @enderror <br>
                                </div>
                                <div class="col">
                                    <label for="award_id" class="form-label text">{{ __('Target/Award') }}<span class="text-danger">*</span></label>
                                    <select wire:model="award_id" class="form-select @error ('award_id') is-invalid @enderror" aria-label="Default select example">
                                        <option value="">--{{__('Select Award')}}--</option>
                                        @foreach($awards as $row)
                                        <option value="{{$row->id}}" {{ isset($row->position->award_id) && $row->position->award_id ==  $row->id ? 'disabled':''}}>{{__($row->name)}}</option>
                                        @endforeach
                                    </select>
                                    @error('award_id') <small class="error text-danger fw-lighter">{{ __($message) }}</small> @enderror <br>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="target_sale" class="form-label">{{ __('Target Sale')}} <small class="text-danger">*</small> </label>
                                    <input type="number" class="form-control text-center @error('target_sale') is-invalid @enderror" placeholder="{{ __('Target Sale')}}" wire:model="target_sale">
                                    @error('target_sale') <span class="invalid-feedback">{{ __($message) }}</span> @enderror
                                </div>
                                <div class="col">
                                    <label for="target_recruit" class="form-label">{{ __('Target Recruit')}}<small class="text-danger">*</small> </label>
                                    <input type="number" class="form-control text-center @error('target_recruit') is-invalid @enderror" placeholder="{{ __('Target Recruit')}}" wire:model="target_recruit">
                                    @error('target_recruit') <span class="invalid-feedback">{{ __($message) }}</span> @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <label for="salary" class="form-label">{{__('Salary')}} </label>
                                    <input type="number" class="form-control text-center " placeholder="{{__('Salary')}}" wire:model.number="salary">
                                </div>
                                <div class="col">
                                    <label for="incentive" class="form-label">{{ __('Incentive')}}</label>
                                    <input type="number" class="form-control text-center" placeholder="{{__('Incentive')}}" wire:model.number="incentive">
                                </div>
                                <div class="col">
                                    <label for="override_fee" class="form-label">{{__('Override Fee')}}</label>
                                    <input type="number" class="form-control text-center" placeholder="{{__('Override Fee')}}" wire:model.number="override_fee">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        <!--<span wire:loading>{{__('Saving...')}}</span>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <style>
        option:disabled {
            background-color: #f8d7da !important;
            color: #721c24 !important;
        }

        .custom-style {
            color: red !important;
            font-size: 16px;
        }
    </style>
</div>