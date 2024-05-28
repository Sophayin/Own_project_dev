<div wire:ignore.self class="modal fade" id="openModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="" wire:submit.prevent="submit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="staticBackdropLabel">{{__('Application Status')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label class="form-label text fw-semibold">{{__('Registered Date')}}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="register_date" wire:model="registration_date" placeholder="{{$registration_date}}" />
                                <span class="input-group-text" style="height: 40px; margin-top: 1px;" id="basic-addon1"><i class="bi bi-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">{{__('Status')}} <span class="text-danger">*</span></label>
                            <select wire:model="status" wire:change="statusChange($event.target.value)" class="form-select form-select-lg @error('status') is-invalid @enderror" aria-label="Default select example">
                                @foreach(get_application_status() as $status)
                                <option value="{{$status['id']}}">{{__($status['label'])}}</option>
                                @endforeach
                            </select>
                            @error('status') <small class="invalid-feedback">{{__($message) }}</small> @enderror
                        </div>
                        <!--Choose Loan Company-->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label class="form-label">{{__($label)}} </label>
                            <select wire:model="loan_company_id" class="form-select form-select-lg @error('loan_company_id') is-invalid @enderror " aria-label="Loan Company">
                                <option value="">--{{__('Loan Company')}}--</option>
                                @foreach($loan_companies as $loan_company)
                                <option value="{{$loan_company->id}}">{{$loan_company->name}}</option>
                                @endforeach
                            </select>
                            @error('loan_company_id') <small class="invalid-feedback">{{__($message) }}</small> @enderror
                        </div>
                    </div>
                    <div class="row mt-2">
                        <!--Respond By-->
                        <div class="col-md-12 col-sm-12">
                            <label class="form-label ">{{__('Respond By')}} <span class="text-danger">*</span></label>
                            <input type="text" wire:model="respond_by" class="form-control @error('respond_by') is-invalid @enderror" placeholder="{{__('Respond By')}}">
                            @error('respond_by') <small class="invalid-feedback">{{ __($message) }}</small> @enderror
                        </div>
                    </div>
                    <!--Reason-->
                    @if($status_type)
                    <div class="row mt-2">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label ">{{__("Reason")}}</label>
                            <select name="reason_id" class="form-select" wire:model="reason_id">
                                <option value="">--{{__("Choose Reason")}}--</option>
                                @foreach ($reasons as $reason )
                                <option value="{{$reason->id}}">{{get_translation($reason)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-2">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label class="form-label">{{__('Description')}}</label>
                            <textarea type="text" wire:model="reason_text" placeholder="{{__('Type Description here')}}" class="form-control"> </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary button_save">{{__('Update')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>


@push('scripts')
<script>
    //--selected date--
    jQuery(document).ready(function() {
        jQuery('#register_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'XX',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        jQuery('#register_date').on('change', function() {
            @this.set('registration_date', jQuery('#register_date').val());
        });
    });
</script>
@endpush