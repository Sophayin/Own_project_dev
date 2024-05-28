<div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container-fluid" style="width: 80%;">
                    <div class="card mt-2">
                        <div class=" border-0 Top_section">
                            <div class="d-flex justify-content-between">
                                <div></div>
                                <div class="text-end">
                                    <h4 class="text-center mt-4 text-white Daily_report"> {{__('Agency Registration Form')}}</h4>
                                </div>
                                <div>
                                    @if(App::getLocale('locale') == 'en')
                                    <div class="mt-2 p-2 box">
                                        <img wire:click="switchLanguage('kh')" src="{{asset('assets/flag/kh.png')}}" class="flag pointer" alt="" width="30" height="30">
                                    </div>
                                    @else
                                    <div class="mt-2 p-2 box">
                                        <img wire:click="switchLanguage('en')" src="{{asset('assets/flag/flag-usa.svg')}}" class="flag pointer" alt="" width="30" height="30">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="GET" wire:submit="register">
                                <h6 class="mt-4 ml-3 fw-semibold">
                                    {{__('Basic Information')}}
                                </h6>
                                <div class="row d-flex">

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Agency Name (Khmer)')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" wire:model="full_name" placeholder="{{__('Enter Agency Name (Khmer)')}}">
                                        @error('full_name') <small class="fw-light text-danger">{{__($message)}}</small> @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Agency Name (English)')}}
                                            <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('full_name_translate') is-invalid @enderror" wire:model="full_name_translate" placeholder="{{__('Enter Agency Name (English)')}}">
                                        @error('full_name_translate') <small class="fw-light text-danger">{{__($message)}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <label for="gender" class="form-label text">{{__('Gender')}} </label>
                                        <select wire:model="gender" class="form-select form-select-lg">
                                            <option value="Male">{{__('Male')}}</option>
                                            <option value="Female">{{__('Female')}}</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Khmer identity card')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('khmer_identity_card') is-invalid @enderror" wire:model="khmer_identity_card" placeholder="{{__('Enter Khmer identity card')}}">
                                        @error('khmer_identity_card')<small class="invalid-feedback">{{__($message)}}</small> @enderror
                                    </div>
                                    <!-- Date of Birth -->
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="row d-flex mt-1 mb-2">
                                            <label for="personal_id_card" class="form-label text">{{__('Date of Birth')}}</label>
                                            <div class="col-lg-4 pl-0">
                                                <select class="form-select form-select-lg" aria-label="Default select example" wire:model="date_of_birth.day">
                                                    <option value="0">--{{__('Day')}}--</option>
                                                    @foreach ($getDays as $day)
                                                    <option value="{{ $day }}">{{ $day }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4 p-0">
                                                <select class="form-select form-select-lg " aria-label="Default select example" wire:model="date_of_birth.month">
                                                    <option value="0">--{{__('Month')}}--</option>
                                                    @foreach ($getMonth as $month)
                                                    <option value="{{ $month }}">{{__($month) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4 pl-0">
                                                <select class="form-select form-select-lg mb-3" wire:model.live="selectedYear" wire:model="date_of_birth.year">
                                                    <option value="">--{{__('Year')}}--</option>
                                                    @foreach ($getYears as $year)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Age')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('age') is-invalid @enderror" wire:model="age" placeholder="{{__('Enter Age')}}">
                                        @error('age')
                                        <small class="invalid-feedback">{{__($message)}}</small>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Phone Number')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone" placeholder="{{__('Enter Phone Number')}}">
                                        @error('phone')<small class="invalid-feedback">{{__($message)}}</small> @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 ">
                                        <label class="form-label text">{{__('Telegram Phone')}}</label>
                                        <input type="text" class="form-control" wire:model="phone_telegram" placeholder="{{__('Enter Telephone Number')}}">
                                    </div>
                                </div>
                                <!-- Address Info -->
                                <h6 class=" mt-4 ml-3 fw-semibold">
                                    {{__('Address')}}
                                </h6>
                                <div class="row d-flex">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="text" class="form-label text">{{__('City')}} </label>
                                        <select wire:change="onChange('city', $event.target.value)" wire:model="city_id" class="form-select form-select-lg " aria-label="Default select example">
                                            <option value="">--{{__('Choose City')}}--</option>
                                            @foreach($cities as $city)
                                            <option value="{{$city->id}}">
                                                {{get_translation($city)}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('District')}}</label>
                                        <select wire:change="onChange('district', $event.target.value)" wire:model="district_id" class="form-select form-select-lg mb-3" aria-label="Default select example">
                                            <option value="0">--{{__('Choose District')}}--</option>
                                            @foreach($districts as $district)
                                            <option value="{{$district->id}}">
                                                {{get_translation($district)}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Commune')}}</label>
                                        <select wire:change="onChange('commune', $event.target.value)" wire:model="commune_id" class="form-select form-select-lg mb-3" aria-label="Default select example">
                                            <option value="0">--{{__('Choose Commune')}}--</option>
                                            @foreach($communes as $commune)
                                            <option value="{{$commune->id}}">
                                                {{get_translation($commune)}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Village')}}</label>
                                        <select wire:model="village_id" class="form-select form-select-lg mb-3" aria-label="Default select example">
                                            <option value="">--{{__('Choose Village')}}--</option>
                                            @foreach($villages as $village)
                                            <option value="{{$village->id}}">
                                                {{get_translation($village)}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('House No.')}}</label>
                                        <input type="text" class="form-control" placeholder="{{__('House No.')}}" wire:model="house_no">
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Street No.')}}</label>
                                        <input type="text" class="form-control" placeholder="{{__('Street No.')}}" wire:model="street_no">
                                    </div>
                                </div>
                                <!-- Occupation Info -->
                                <h6 class=" mt-2 ml-3 fw-semibold">
                                    {{__('Occupation')}}
                                </h6>
                                <div class="row d-flex">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Occupation')}} <span class="text-danger">*</span></label>
                                        <select wire:model="occupation_id" class="form-select form-select-lg @error('occupation_id') is-invalid @enderror " aria-label=".form-select-lg example">
                                            <option value="">--{{__('Occupation')}}--</option>
                                            @foreach($occupations as $occupation)
                                            <option value="{{$occupation->id}}">
                                                {{get_translation($occupation)}}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('occupation_id') <span class="invalid-feedback">{{__($message)}}</span> @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Monthly Income')}} <span class="text-danger">*</span></label>
                                        <select wire:model="income" class="form-select form-select-lg @error('income') is-invalid @enderror" aria-label="Default select example">
                                            <option value="">--{{__('Monthly Income')}}--</option>
                                            <option value="NA">N/A</option>
                                            <option value="<$150">
                                                < $150 </option>
                                            <option value="$151-$300"> $151-$300</option>
                                            <option value="$301-$500"> $301-$500</option>
                                            <option value="$501-$700"> $501-$700</option>
                                            <option value="$700-$1000"> $701-$1000</option>
                                            <option value=">$1000"> >$1000 </option>
                                        </select>
                                        @error('income') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                                    </div>

                                </div>
                                <h6 class=" mt-4 ml-3">
                                    {{__('Bank Info')}}
                                </h6>
                                <div class="row d-flex">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Bank Name')}}</label>
                                        <input type="text" class="form-control " wire:model="bank_info.bank_name" placeholder="{{__('Enter Bank Name')}}">
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Bank Account Number')}}</label>
                                        <input type="text" class="form-control " wire:model="bank_info.account_number" placeholder="{{__('Enter Bank Account Number')}}">
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <label class="form-label text">{{__('Bank Account Name')}}</label>
                                        <input type="text" class="form-control " wire:model="bank_info.account_name" placeholder="{{__('Enter Bank Account Name')}}">
                                    </div>
                                </div>

                                <h6 class=" mt-4 ml-3 fw-semibold">
                                    {{__('Referrer')}}
                                </h6>
                                <div class="row d-flex">
                                    <div class="col-lg-4 col-md-6 col-sm-12 mt-1">
                                        <label class="form-label text"> {{__('Referrer Code')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('referrer_code') is-invalid @enderror" wire:model="referrer_code" placeholder="{{__('Enter Referrer Code')}}">
                                        @error('referrer_code') <small class="invalid-feedback">{{__($message)}}</small> @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-12 mt-2">
                                        <label class="form-label text"> {{__('Remark')}}</label>
                                        <textarea type="text" class="form-control" wire:model="remark" placeholder="{{__('Type here...')}}"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-5 mb-4">
                                    <!--<a href="#">
                                        <button wire:click="cancel" type="button" class="btn btn-danger" style="margin-right: 10px; border-radius: 0px; width: 120px;"><i class="bi bi-x-lg"></i> {{__('Cancel')}}</button>
                                    </a>-->
                                    <button type="submit" class="btn btn-primary button_save ml-5" style="margin-right: 10px; border-radius: 0px; width: 120px;">
                                        <i class="bi bi-send"></i> {{__('Submit')}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>