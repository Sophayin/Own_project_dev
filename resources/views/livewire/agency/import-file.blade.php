<div>
    <section class="section">
        <div class="card">
            <div class="row d-flex p-3">
                <div class="d-flex mb-3 justify-content-between border-bottom">
                    <div class="d-flex">
                        <h5 class="mt-1">{{ __('Import') }}{{__('Data')}}</h5>
                    </div>
                    <div class="d-flex justify-content-end">
                        <div class="p-2">
                            <div class="col-lg-12 col-sm-6">
                                <a wire:click="downloadregion">
                                    <button class="btn btn-secondary button_save">
                                        <i class="bi bi-box-arrow-up"></i>
                                        {{__('Download Region')}}
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="col-lg-12 col-sm-6">
                                <a wire:click="downloadOccupations">
                                    <button class="btn btn-secondary button_save">
                                        <i class="bi bi-box-arrow-up"></i>
                                        {{__('Download Occupations')}}
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="col-lg-12 col-sm-6">
                                <a wire:click="downloadPositions">
                                    <button class="btn btn-secondary button_save">
                                        <i class="bi bi-box-arrow-up"></i>
                                        {{__('Download Positions')}}
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="col-lg-12 col-sm-6">
                                <a wire:click="downlaodExcelFile">
                                    <button class="btn btn-secondary button_save">
                                        <i class="bi bi-box-arrow-up"></i>
                                        {{__('Download Sample Excel')}}
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label>{{__('Import File')}}</label>
                    <input type="file" wire:model="import_file" class="form-control mt-2">
                </div>
                <div class="col-3 mt-3">
                    <button type="submit" wire:click="importFile" class="btn btn-primary button_save">{{__('Preview')}}</button>
                </div>
                @if (\Session::has('status'))
                <div class="container">
                    <div class="alert alert-success mt-3">
                        {{ session('message') }}
                        @if (session('item_recorded'))
                        <div class="text"> {{__('Recorded items')}} : ({{count(session('item_recorded'))}}) </div>
                        @endif
                        @if (session('item_exist'))
                        <div class="text">{{__('Existing items')}} : ({{ count(session('item_exist')) }})</div>
                        <div class="text"> {{__('Code')}} : {{json_encode(session('item_exist'))}} </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            <div class="table-responsive p-3 border-top mt-3">
                <div class="table-responsive">
                    @if (!empty($previewData))
                    <div class="mt-2 mb-2">{{__('Data Preview')}} ({{count($previewData)}})</div>
                    <form wire:submit.prevent="saveimportfile">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-sm">
                                        <input type="checkbox" wire:model="checkbox_main" wire:click="SelectAll" style="width: 15px; height: 15px;">
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">{{__("Code")}}</th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__("Agency Name (Khmer)")}}</nobr>
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__("Agency Name (English)")}}</nobr>
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">{{__("Gender")}}</th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__("Leader Code")}}</nobr>
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__("Code of Referrer")}}</nobr>
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__("Khmer Identity Card")}}</nobr>
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__("Phone Number")}}</nobr>
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__("Telegram")}}</nobr>
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">{{__("Age")}}</th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__("Position")}}</nobr>
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">{{__("Occupation")}}</th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">{{__("Income")}}</th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">{{__("Status")}}</th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__("Bank")}} {{__('Aba')}}</nobr>
                                    </th>

                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__("Bank")}} {{__('Acleda')}}</nobr>
                                    </th>

                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__('Date_of_birth')}}</nobr>
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__('Remark')}}</nobr>
                                    </th>
                                    <th rowspan="2" class="text-center text-secondary text-sm">
                                        <nobr>{{__('Registered_date')}}</nobr>
                                    </th>
                                    <th colspan="6" class="text-center text-secondary text-sm">
                                        <nobr>{{__('Address')}}</nobr>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-center text-secondary text-sm">
                                        <nobr>{{__("City")}}</nobr>
                                    </th>
                                    <th class="text-center text-secondary text-sm">
                                        <nobr>{{__("District")}}</nobr>
                                    </th>
                                    <th class="text-center text-secondary text-sm">
                                        <nobr>{{__("Commune")}}</nobr>
                                    </th>
                                    <th class="text-center text-secondary text-sm">
                                        <nobr>{{__("Village")}}</nobr>
                                    </th>
                                    <th class="text-center text-secondary text-sm">
                                        <nobr>{{__("House No.")}}</nobr>
                                    </th>
                                    <th class="text-center text-secondary text-sm">
                                        <nobr>{{__("Street No.")}}</nobr>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($previewData as $index => $item)
                                <tr>
                                    <td>
                                        <input type="checkbox" wire:model="selectedRow.{{$item['id']}}" value="{{$item['id']}}" style="width: 15px; height: 15px;">
                                    </td>
                                    <td class="text-sm text">{{$item['current_code']}}</td>
                                    <td class="text-sm text">
                                        <nobr>{{$item['full_name']}}</nobr>
                                    </td>
                                    <td class="text-sm text">
                                        <nobr>{{$item['full_name_khmer']}}</nobr>
                                    </td>
                                    <td class="text-sm text">{{__($item['gender'])}}</td>
                                    <td class="text-sm text">{{$item['current_leader_code']}}</td>
                                    <td class="text-sm text-center">{{$item['referrer_code']}}</td>
                                    <td class="text-sm text">
                                        <nobr>{{$item['khmer_identity_card']}}</nobr>
                                    </td>
                                    <td class="text-sm text">
                                        <nobr>{{$item['phone']}}</nobr>
                                    </td>
                                    <td class="text-sm text">
                                        <nobr>{{$item['phone_telegram']}}</nobr>
                                    </td>
                                    <td class="text-sm text-center">
                                        {{(date('Y') - $item['birth_year'])}}
                                    </td>
                                    <td class="text-sm text">
                                        @php
                                        $position = \App\Models\Position::find($item['position_id']);
                                        @endphp
                                        @if($position)
                                        <nobr>{{get_translation($position)}} ({{$position->abbreviation}})</nobr>
                                        @endif
                                    </td>
                                    <td class="text-sm text">
                                        @php
                                        $position = \App\Models\Occupation::find($item['occupation_id']);
                                        @endphp
                                        @if($position)
                                        <nobr>{{get_translation($position)}}</nobr>
                                        @endif
                                    </td>
                                    <td class="text-sm text">
                                        <nobr>
                                            {{$item['income']}}
                                        </nobr>
                                    </td>
                                    <td class="text-sm text-center">
                                        @if($item['status'])
                                        {{__(get_agency_status($item['status'])['label'])}}
                                        @endif
                                    </td>
                                    <td class="text-sm text">
                                        <nobr>{{$item['bank_aba'] ?? ''}}</nobr>
                                    </td>
                                    <td class="text-sm text">
                                        <nobr>{{$item['bank_acleda'] ?? ''}}</nobr>
                                    </td>
                                    <td class="text-sm text">
                                        <nobr>
                                            {{$item['birth_year']}},
                                            {{$item['birth_month']}},
                                            {{$item['birth_day']}}
                                        </nobr>
                                    </td>
                                    <td class="text-sm text">
                                        <nobr>{{$item['remark']}}</nobr>
                                    </td>
                                    <td class="text-sm text">
                                        <nobr>
                                            {{$item['register_year']."," ?? ""}}
                                            {{$item['register_month']."," ?? ""}}
                                            {{$item['register_day']}}
                                        </nobr>
                                    </td>
                                    <td class="text-sm text-center">
                                        @php
                                        $city = \App\Models\City::find($item['city_id']);
                                        @endphp
                                        @if($city)
                                        <nobr>{{get_translation($city)}}</nobr>
                                        @endif
                                    </td>
                                    <td class="text-sm text-center">
                                        @php
                                        $district = \App\Models\District::find($item['district_id']);
                                        @endphp
                                        @if($district)
                                        <nobr>{{get_translation($district)}}</nobr>
                                        @endif
                                    </td>
                                    <td class="text-sm text-center">
                                        @php
                                        $commune = \App\Models\Commune::find($item['commune_id']);
                                        @endphp
                                        @if($commune)
                                        <nobr>{{get_translation($commune)}}</nobr>
                                        @endif
                                    </td>
                                    <td class="text-sm text-center">
                                        @php
                                        $village = \App\Models\Village::find($item['village_id']);
                                        @endphp
                                        @if($village)
                                        <nobr>{{get_translation($village)}}</nobr>
                                        @endif
                                    </td>
                                    <td class="text-sm text-center">
                                        <nobr>{{$item['house_no'] ?? ''}}</nobr>
                                    </td>
                                    <td class="text-sm text-center">
                                        <nobr>{{$item['street_no'] ?? ''}}</nobr>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-primary button_save" type="submit">{{__('Upload')}}</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>