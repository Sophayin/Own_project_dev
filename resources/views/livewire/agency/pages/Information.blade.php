<div class="tab-pane fade show active mt-3 " id="home" role="tabpanel" aria-labelledby="home-tab">
    <form action="get" wire:submit.prevent="update">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="form-label text fw-semibold">{{__('Agency Name (Khmer)')}} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('full_name_translate') is-invalid @enderror" wire:model="full_name_translate" placeholder="{{__('Enter Full Name (Khmer)')}}">
                @error('full_name_translate') <small class="invalid-feedback">{{__( $message) }}</small> @enderror <br>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="full_name" class="form-label text fw-semibold">{{__('Agency Name (English)')}} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('full_name') is-invalid @enderror" wire:model="full_name" placeholder="{{__('Enter Full Name (English)')}}">
                @error('full_name') <small class="invalid-feedback">{{__($message) }}</small> @enderror
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4">
                <label class="form-label text fw-semibold">{{__('Code')}} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('code') is-invalid @enderror" wire:model="code" placeholder="{{__('Code')}}">
                @error('code') <small class="invalid-feedback">{{ __($message) }}</small> @enderror <br>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4">
                <label class="form-label text fw-semibold">{{__('Registered Date')}}</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="register_date" wire:model="registration_date" placeholder="{{$registration_date}}" />
                    <span class="input-group-text" style="height: 40px; margin-top: 1px;" id="basic-addon1"><i class="bi bi-calendar"></i></span>
                </div>
            </div>
        </div>
        <!-- Date of Birth -->
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="row">
                    <label class="form-label text fw-semibold">{{__('Date of Birth')}}</label>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <select class="form-select form-select-lg" wire:model="date_of_birth.day">
                            <option value="">--{{__('Day')}}--</option>
                            @foreach ($getDays as $day)
                            <option value="{{ $day }}">{{ $day}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <select class="form-select form-select-lg" wire:model="date_of_birth.month">
                            <option value="">--{{__('Month')}}--</option>
                            @foreach ($getMonth as $month)
                            <option value="{{ $month }}">{{__($month) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <select class="form-select form-select-lg" wire:model.live="selectedYear" wire:model="date_of_birth.year">
                            <option value="">--{{__('Year')}}--</option>
                            @foreach ($getYears as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-12">
                <label class="form-label text fw-semibold">{{__('Age')}} </label>
                <input type="text" class="form-control" wire:model="age" placeholder="{{__('Enter Age')}}">
            </div>
            <div class="col-lg-2 col-md-6 col-sm-12">
                <label for="gender" class="form-label text fw-semibold">{{__('Gender')}} </label>
                <select wire:model="gender" class="form-select form-select-lg">
                    <option value="Male">{{__('Male')}}</option>
                    <option value="Female">{{__('Female')}}</option>
                </select>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="khmer_identity_card" class="form-label text fw-semibold">{{__('Khmer Identity Card')}} <small class="text-danger">*</small></label>
                <input type="text" wire:model="khmer_identity_card" class="form-control @error('khmer_identity_card') is-invalid @enderror" placeholder="{{ __('Enter Khmer identity card')}}">
                @error('khmer_identity_card') <small class="invalid-feedback">{{ __($message) }}</small> @enderror <br>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-2 col-md-6 col-sm-12">
                <label class="form-label text fw-semibold">{{ __('Phone Number')}} <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" placeholder="{{ __('Enter Phone Number') }}">
                @error('phone') <small class="invalid-feedback">{{ __($message) }}</small> @enderror <br>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-12">
                <label class="form-label text fw-semibold">{{__('Telegram Phone')}} </label>
                <input type="text" class="form-control @error('telegram_phone') is-invalid @enderror" wire:model="phone_telegram" placeholder="{{__('Enter Telephone Number')}}">
                @error('telegram_phone') <small class="invalid-feedback">{{ __($message) }}</small> @enderror <br>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="form-label text fw-semibold">{{__('Occupation')}} <span class="text-danger">*</span></label>
                <select wire:model="occupation_id" class="form-select form-select-lg @error('occupation_id') is-invalid @enderror" aria-label="Default select example">
                    <option value="">--{{__('Occupation')}}--</option>
                    @foreach($occupation as $occupat)
                    <option value="{{$occupat->id}}">{{get_translation($occupat)}}</option>
                    @endforeach
                </select>
                @error('occupation_id') <small class="invalid-feedback">{{__($message) }}</small> @enderror <br>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="income" class="form-label text fw-semibold">{{__('Monthly Income')}}</label>
                <select class="form-select form-select-lg" wire:model="income">
                    <option value="">--{{__('Choose Income')}}--</option>
                    <option value="NA">N/A</option>
                    <option value="<$150">
                        <$150 </option>
                    <option value="$151-$300">$151-$300</option>
                    <option value="$301-$500">$301-$500</option>
                    <option value="$501-$700">$501-$700</option>
                    <option value="$701-$1000">$701-$1000</option>
                    <option value="> $1000"> >$1000 </option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <!-- Referer Code -->
            <div class="col-lg-2 col-md-6 col-sm-12 ">
                <label class="form-label text fw-semibold">{{__('Code of Referrer')}}</label>
                <input type="text" class="form-control" wire:model.blur="origin_referrer_code" wire:blur="findAgencyLeaderByreferrer" placeholder="{{__('Referrer Code')}}">
                @if($invalidMessage) <small class="invalid-feedback">{{ $invalidMessage }}</small>@endif
            </div>
            <!-- Leader -->

            <div class="col-lg-2 col-md-6 col-sm-12">
                <label class="form-label text fw-semibold">{{__('Approved Note')}} <small class="text-danger">*</small></label>
                <input type="file" wire:model="file_name" class="form-control document @error('file_name') is-invalid @enderror">
                @error('file_name') <small class="invalid-feedback">{{__($message) }}</small> @enderror <br>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label class="form-label text fw-semibold">{{__('Agency Leader')}} <small>({{__('Direct')}})</small></label>
                <select class="form-select form-select-lg" wire:model.lazy="leader_id" id="selectleader" style="width: 100%;">
                    <option value="">--{{__('Choose Leader')}}--</option>
                    @foreach($agency_leader as $agen)
                    <option value="{{$agen->id}}" {{$agen->id == $leader_id ? 'selected': ''}}> {{ $agen->code ? '('.$agen->code.') - ' : "" }} {{$agen->full_name }}</option>
                    @endforeach
                </select>
            </div>
            @if($indirect_leader_id)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <label for="text" class="form-label text fw-semibold">{{__('Leader')}} <small>({{__('Indirect')}})</small> </label>
                <input type="text" class="form-control" wire:model="indirect_leader_code">
            </div>
            @endif
        </div>

        <!-- Bank Info -->
        <div class="row mb-3">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="col-lg-12 d-flex">
                    @if($bank_info)
                    <span wire:click="bankModal" class="pointer fw-semibold" style="color: #034c72;">
                        <i class="bi bi-plus-circle"></i> {{__('Bank Information')}}
                    </span>
                    @else
                    <span wire:click="bankModal" class="pointer link-offset-2 p-2 w-100 fw-semibold" style="color: #034c72;">
                        {{__('Bank Information')}} <i class="bi bi-pencil-square"></i>
                    </span>
                    <span wire:click="clearBanInfo" class="p-1 justify-content-end">
                        <a style=" border-color:azure;" class="rounded-pill btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash3"></i>
                        </a>
                    </span>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text text-secondary">{{__('Set Default')}}</th>
                                <th class="text text-secondary">{{__('Bank Name')}}</th>
                                <th class="text text-secondary">{{__('Account Number')}} </th>
                                <th class="text text-secondary">{{__('Account Name')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bank_info as $key => $item)
                            <tr class="text-center">
                                <td class="text-sm">
                                    @if(isset($item['status']))
                                    @if($item['status'] === true){{ __('Default') }}
                                    @endif
                                    @endif
                                </td>
                                <td class="text-sm">{{ $item['name'] }}</td>
                                <td class="text-sm">{{ $item['account_number'] }}</td>
                                <td class="text-sm">{{ $item['account_name'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <label class="form-label text fw-semibold">{{__('Remark')}} </label>
                <textarea type="text" rows="5" class="form-control" wire:model="remark" placeholder="{{__('Type here...')}}"></textarea>
            </div>
        </div>
        <div class="modal-footer justify-content-center mt-4 mb-3">
            <button type="submit" class="btn btn-primary d-flex justify-content-center button_save">{{__('Update')}}</button>
        </div>
    </form>

    <!-- Bank Modal -->
    <div wire:ignore.self class="modal fade" id="bankModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="submit">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('Bank Information')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('livewire.agency.bank-info')
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" wire:click="saveBankInfo" class=" btn btn-primary button_save" data-bs-dismiss="modal">{{__('Done')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    jQuery('#register_date').datepicker({
        autoclose: true,
        todayHighlight: true,
        language: 'XX',
        uiLibrary: 'bootstrap5',
        format: "yyyy-mm-dd",
        minDate: '-12m',
        maxDate: '0',
    }).datepicker("setDate", 'now');
    jQuery('#register_date').on('change', function(e) {
        @this.set('registration_date', jQuery(this).val());
    });

    Livewire.on('findAgencyLeader', postId => {
        jQuery(document).ready(function() {
            jQuery('#selectleader').select2();
        });
    })
    jQuery(document).ready(function() {
        jQuery('#selectleader').select2();
        jQuery('#selectleader').on('change', function(e) {
            @this.set('leader_id', jQuery(this).val());
        });
    });
</script>
@endpush