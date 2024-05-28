<div>
    <section class="section">
        <form method="POST" wire:submit="submit">
            <div class="d-flex pl-3">
                <h6 class="main_application ">
                    <a wire:navigate href="{{route('agency.list','list')}}">
                        <i class="bi bi-arrow-left-circle-fill"></i>
                        <small class="text-sm"> {{__('Back')}}</small>
                    </a>
                </h6>
                <h6 class="main_application">
                    <i class="bi bi-chevron-right"></i>
                </h6>
                <h6 class="main_application text ">{{__('Agency')}}</h6>
                <h6 class="main_application">
                    <i class="bi bi-chevron-right"></i>
                </h6>
                <h6 class="main_application text ">{{__('New')}}</h6>
                <button type="submit" class="btn btn-primary button_save" style="margin-top: -7px;">{{__('Save')}}</button>
            </div>
            <div class="card mt-3" id="createApplication">
                <div class="card-body">
                    <!--Position & Code_section -->
                    <div class="row mb-3 mt-3">
                        <div class="col-lg-4 col-md-6 col-sm-12 ">
                            <label class="form-label text fw-semibold">{{__('Position')}} <span class="text-danger">*</span></label>
                            <select wire:model.live="position_id" wire:change="generateNewCode" class="form-select form-select-lg @error ('position_id') is-invalid @enderror">
                                <option value="">--{{__('Choose Position')}}--</option>
                                @foreach($positions as $position)
                                <option value="{{$position->id}}"> {{get_translation($position)}} ({{$position->abbreviation}}) </option>
                                @endforeach
                            </select>
                            @error('position_id') <small class="invalid-feedback">{{__($message) }}</small>@enderror
                        </div>
                        @if($code)
                        <div class="col-lg-4 col-sm-4">
                            <label class="form-label text fw-semibold">{{__('New Agency Code')}}</label>
                            <input wire:model="code" type="text" class="form-control @error('code') is-invalid @enderror" value="{{ $code }}" placeholder="{{__('Enter Agency Code')}}">
                            @error('code') <small class="invalid-feedback">{{__($message) }}</small> @enderror
                        </div>
                        @endif
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label class="form-label text fw-semibold">{{__('Registered Date')}}</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="register_date" wire:model="registration_date" placeholder="{{$registration_date}}" />
                                <span class="input-group-text" style="height: 40px; margin-top: 1px;" id="basic-addon1"><i class="bi bi-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- Agency Information section -->
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="full_name_translate" class="form-label text fw-semibold">{{__('Agency Name (Khmer)')}} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('full_name_translate') is-invalid @enderror" wire:model="full_name_translate" placeholder="{{__('Enter Full Name (Khmer)')}}">
                            @error('full_name_translate') <small class="invalid-feedback">{{__($message) }}</small> @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 ">
                            <label for="full_name" class="form-label text fw-semibold">{{__('Agency Name (English)')}} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" wire:model="full_name" placeholder="{{__('Enter Full Name (English)')}}">
                            @error('full_name') <small class="invalid-feedback">{{__($message) }}</small> @enderror
                        </div>
                        <!-- Date of Birth -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="row d-flex">
                                <label for="date_of_birth" class="form-label text fw-semibold">{{__('Date of Birth')}}</label>
                                <div class="col-lg-4">
                                    <select class="form-select form-select-lg" wire:model="date_of_birth.day">
                                        <option value="">--{{__('Day')}}--</option>
                                        @foreach ($getDays as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 p-0">
                                    <select class="form-select form-select-lg" wire:model="date_of_birth.month">
                                        <option value="">--{{__('Month')}}--</option>
                                        @foreach ($getMonth as $month)
                                        <option value="{{ $month }}">{{__($month) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-select form-select-lg" wire:model.live="selectedYear" wire:model="date_of_birth.year">
                                        <option value="">--{{__('Year')}}--</option>
                                        @foreach ($getYears as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-2 col-md-6 col-sm-12 ">
                            <label class="form-label text fw-semibold">{{__('Age')}}</label>
                            <input type="text" class="form-control" wire:model="age" placeholder="{{__('Age')}}">
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-12">
                            <label class="form-label text fw-semibold">{{__('Gender')}}</label>
                            <select wire:model="gender" class="form-select form-select-lg">
                                <option value="Male">{{__('Male')}}</option>
                                <option value="Female">{{__('Female')}}</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="khmer_identity_card" class="form-label text fw-semibold">{{__('Khmer Identity Card')}} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('khmer_identity_card') is-invalid @enderror" wire:model.blur="khmer_identity_card" placeholder="{{__('Enter Khmer identity card')}}">
                            @error('khmer_identity_card') <small class="invalid-feedback">{{ __($message) }}</small> @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 ">
                            <label for="phone" class="form-label text fw-semibold">{{__('Phone Number')}} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" placeholder="{{__('Enter Phone Number')}}">
                            @error('phone') <small class="invalid-feedback">{{ __($message) }}</small> @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="phone_telegram" class="form-label text fw-semibold">{{__('Telegram Phone')}} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('phone_telegram') is-invalid @enderror" wire:model="phone_telegram" placeholder="{{__('Enter Telephone Number')}} 0987654321,01243...">
                            @error('phone_telegram') <small class="invalid-feedback">{{ __($message) }}</small> @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label class="form-label text fw-semibold">{{__('Occupation')}} <span class="text-danger">*</span></label>
                            <select wire:model="occupation_id" class="form-select form-select-lg @error ('occupation_id') is-invalid @enderror" aria-label=".form-select-lg example">
                                <option value="">--{{__('Occupation')}}--</option>
                                @foreach($occupations as $occupation)
                                <option value="{{$occupation->id}}">
                                    {{get_translation($occupation)}}
                                </option>
                                @endforeach
                            </select>
                            @error('occupation_id') <small class="invalid-feedback">{{__($message) }}</small> @enderror
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label class="form-label text fw-semibold">{{__('Monthly Income')}} </label>
                            <select class="form-select form-select-lg" aria-label="Default select example" wire:model="income">
                                <option value="0">--{{__('Choose Income')}}--</option>
                                <option value="N/A">N/A</option>
                                <option value="<$150">&nbsp; <$150 </option>
                                <option value="$151-$300">$151-$300</option>
                                <option value="$301-$500">$301-$500</option>
                                <option value="$501-$700">$501-$700</option>
                                <option value="$701-$1000">$701-$1000</option>
                                <option value="> $1000"> >$1000 </option>
                            </select>
                        </div>
                    </div>
                    <!-- Referrer Section -->
                    <div class="row mb-3">
                        <!-- Referer Code -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="referrer_code" class="form-label text fw-semibold">{{__('Code of Referrer')}} @if($position_id == 5)<span class="text-danger">*</span> @endif </label> <br>
                            <input type="text" class="form-control @error('referrer_code') is-invalid @enderror" wire:model.blur="referrer_code" wire:blur="findAgencyLeaderByreferrer" placeholder="{{__('Referrer Code')}}">
                            @error('referrer_code') <small class="invalid-feedback">{{ __($message) }}</small> @enderror <br>
                        </div>
                        <!--Agency Leader (direct) -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="text" class="form-label text fw-semibold">{{__('Agency Leader')}} </label>
                            <select wire:model.lazy="agency_id" class="form-select" name="state" id="selectleader" style="width: 100%;">
                                <option value="0">{{__('Choose Leader')}}</option>
                                @foreach($agency_list as $agen)
                                <option value="{{$agen->id}}"> {{ $agen->code ? '('.$agen->code.') - ' : "" }}{{$agen->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--Leader (indirect)-->
                        @if($leader)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <label for="text" class="form-label text fw-semibold">{{__('Leader')}} <small>({{__('Indirect')}})</small> </label>
                            <input type="text" class="form-control" value="{{ $leader->code ? '('.$leader->code.') - ' : '' }}{{$leader->full_name }}" readonly />
                        </div>
                        @endif
                    </div>
                    <!-- Add Address -->
                    <div class="row mb-3">
                        <div class="col-md-4 ">
                            @if($city == null)
                            <span wire:click="addressModal" wire:model="city_id" class="pointer p-2 w-100 @error('city_id') is-invalid @enderror" style="color: #034c72;">
                                <i class="bi bi-plus-circle"></i> {{__('Address')}} <small class="text-danger">*</small>
                            </span>
                            @else
                            <span wire:click="addressModal" class="pointer p-2 w-100" style="color: #034c72;">
                                {{__('Address')}} <i class="bi bi-pencil-square"></i>
                            </span>
                            <span wire:click="clearAddress" class="p-1 justify-content-end">
                                <a style="border-color:azure;" class="rounded-pill btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </span>
                            @endif
                            <div class="col-lg-12">
                                <small class="text-body-secondary fs-7">
                                    {{ $village ? get_translation($village).',' : ''}}
                                    {{ $commune ? get_translation($commune).',' : ''}}
                                    {{ $district ? get_translation($district).',' : ''}}
                                    {{ $city ? get_translation($city): ''}}
                                </small>
                            </div>
                            <div class="col-lg-12">
                                <small class="text-body-secondary fs-7">
                                    {{$house_no ? __('House No.').' : '.$house_no : ''}}
                                    {{$street_no ? __('Street No.').' : '.$street_no : ''}}
                                </small>
                            </div>
                            <div class="col-lg-12">
                                <small class="text-body-secondary fs-7">
                                    {{$longitude ? __('Google Longtitude').' : '.$longitude : ''}}
                                </small>
                            </div>
                            <div class="col-lg-12">
                                <small class="text-body-secondary fs-7">
                                    {{$latitude ? __('Google Latitude (Optional)').' : '.$latitude : ''}}
                                </small>
                            </div>
                            @error('city_id') <small class="invalid-feedback">{{ __($message) }}</small> @enderror <br>
                        </div>
                        <!-- Add Bank Info -->
                        <div class="col-md-4">
                            <div class="@error('bank_info') is-invalid @enderror">
                                @if($bank_info)
                                <span wire:click="bankModal" class="pointer p-2 w-100" style="color: #034c72;">
                                    {{__('Bank Information')}} <i class="bi bi-pencil-square"></i>
                                </span>
                                <span wire:click="clearBanInfo" class="p-1 justify-content-end">
                                    <a style="border-color:azure;" class="rounded-pill btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash3"></i>
                                    </a>
                                </span>
                                @else
                                <span wire:click="bankModal" class="pointer  p-2 w-100" style="color: #034c72;">
                                    <i class="bi bi-plus-circle"></i> {{__('Bank Information')}} <small class="text-danger">*</small>
                                </span>
                                @endif
                            </div>
                            @error('bank_info') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                            @if($bank_info)
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <td class="text text-secondary"><small>{{__('Set Default')}}</small></td>
                                        <td class="text text-secondary"><small>{{__('Bank Name')}}</small></td>
                                        <td class="text text-secondary"><small>{{__('Account Number')}}</small></td>
                                        <td class="text text-secondary"><small>{{__('Account Name')}}</small></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bank_info as $key => $item)
                                    <tr class="text-center">
                                        <td class="text">
                                            <small class="text">{{$item['status'] ?  __('Default') : $item['status']}}</small>
                                        </td>
                                        <td class="text">
                                            <small>{{$item['name']}}</small>
                                        </td>
                                        <td class="text">
                                            <small> {{$item['account_number']}} </small>
                                        </td>
                                        <td class="text">
                                            <small>{{$item['account_name']}}</small>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-sm-12">
                            <label for="text" class="form-label text fw-semibold">{{__('Remark')}} </label>
                            <textarea type="text" class="form-control" wire:model="remark" placeholder="{{__('Type here...')}}"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
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
    <!-- Addres Modal -->
    <div wire:ignore.self class="modal fade" id="addressModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('Address')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('livewire.sales.applications.addressmodal')
                </div>
                <div class="modal-footer justify-content-center">
                    @if($city_id)
                    <button type="button" wire:click="saveAddress" class=" btn btn-primary button_save" data-bs-dismiss="modal">{{__('Done')}}</button>
                    @else
                    <button type="submit" wire:click="saveAddress" class=" btn btn-primary button_save">{{__('Done')}}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    //jQuery(document).ready(function() {
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
            @this.set('agency_id', jQuery(this).val());
        });
    });
</script>
@endpush