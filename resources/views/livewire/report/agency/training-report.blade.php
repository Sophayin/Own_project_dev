<div>
    <section class="section">
        <h3 class="p-3">
            <a wire:navigate href="{{route('report', 'agency')}}">
                <i class="bi bi-arrow-left-short"></i>
            </a>
        </h3>
        <div class="container-fluid">
            <div class="row">
                <h4 class="col-lg-3 col-md-3 col-sm-0 d-block">
                    <img src="{{asset('assets/svg/logo121.png')}}" alt="{{env('APP_HEADER_NAME_KH')}}" width="150px">
                </h4>
                <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                    <h5 class="ml-5 text-danger Daily_report">១២១ សបភី ឯ.ក</h5>
                    <h5 class="text-danger fw-light">121 Shoppe co.,LTD</h5>
                    <h5 class="text-primary Daily_report">របាយការណ៍វគ្គបណ្ដុះបណ្ដាល</h5>
                    <div>
                        ({{date('d/m/Y', strtotime($start_date))}} <i class="bi bi-arrow-right-short"></i>
                        {{date('d/m/Y', strtotime($end_date))}})
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="d-flex p-2">
                    <div class="col-lg-1 d-none d-sm-block p-2 " style="width: 10%;">
                        <select wire:model="cityId" wire:change="filterAgenciesByCity" class="form-control form-select border-0 bg-light" style="height: 40px; margin-left: 3px;">
                            <option value="">All City <small>:</small> </option>
                            @foreach ($getCities as $city)
                            @if($city->city_id != null)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 d-none d-sm-block p-2">
                        <select wire:model.live="selected_shop" class="form-control form-select border-0 bg-light" style="height: 40px;">
                            <option value="" class="all_shop">All Shops <small style="font-size: 55px;">:</small>
                            </option>
                            @foreach ($getShops as $shop)
                            <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 p-2 d-flex">
                        <p class="pt-2">Date </p>
                        <input type="date" class="form-control border-0 mb-2 bg-light ml-2" wire:model.live="start_date">
                        <i class="bi bi-arrow-right-short mt-2 fs-15"></i>
                        <input type="date" class="form-control border-0 bg-light mb-2 ml-2" wire:model.live="end_date">
                    </div>
                </div>
                <div class="table-responsive ">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th class="text-center text-secondary text-sm opacity-7">
                                    <div class="d-flex">
                                        <input class="form-check-input p-1" type="checkbox" value="" id="flexCheckDefault">
                                        No
                                    </div>
                                </th>
                                <th class="text-center text-secondary text-sm opacity-7">Code</th>
                                <th class="text-center text-secondary text-sm opacity-7">Agency Name</th>
                                <th class="text-center text-secondary text-sm opacity-7">Agency Name (latin)</th>
                                <th class="text-center text-secondary text-sm opacity-7">Gender</th>
                                <th class="text-center text-secondary text-sm opacity-7">Register date</th>
                                <th class="text-center text-secondary text-sm opacity-7"> Quantity of working day</th>
                                <th class="text-center text-secondary text-sm opacity-7"> Summary</th>
                                <th class="text-center text-secondary text-sm opacity-7"> Address</th>
                                <th class="text-center text-secondary text-sm opacity-7"> Personal ID Card</th>
                                <th class="text-center text-secondary text-sm opacity-7"> Leader</th>
                                <th class="text-center text-secondary text-sm opacity-7"> Bank Account Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>There is no data</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>