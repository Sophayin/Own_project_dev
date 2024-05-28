<div>
    <section class="section">
        <h3 class="p-3">
            <a wire:navigate href="{{route('report', 'agency')}}">
                <i class="bi bi-arrow-left-short"></i>
            </a>
        </h3>
        <div class="container-fluid" id="printable-div">
            <div class="row">
                <h4 class="col-lg-3 col-md-3 col-sm-0 d-block">
                    <img src="{{asset('assets/svg/logo121.svg')}}" alt="121 Shoppee co.,LTD" width="150px" height="150px">
                </h4>
                <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                    <h5 class="ml-5 text-danger Daily_report">{{env("APP_HEADER_NAME_KH")}}</h5>
                    <h5 class="text-danger fw-light">{{env("APP_HEADER_NAME")}}</h5>
                    <h5 class="text-primary Daily_report"> {{ __('Repayment Agency Report') }}</h5>
                    <div class="text-danger">{{__('Monthly')}} {{trans(date('F', strtotime($start_date))) }} {{__('Year')}} {{date('Y', strtotime($start_date))}}
                        ( {{date('d', strtotime($start_date)).'/' .__(date('F', strtotime($start_date))) .'/'.date('Y', strtotime($start_date))}} )
                        <i class="bi bi-arrow-right-short"></i>
                        ( {{date('d', strtotime($end_date)).'/' .__(date('F', strtotime($end_date))) .'/'.date('Y', strtotime($end_date))}} )
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="d-flex p-2" id="dateInputContainer">
                    <div class="col-lg-4 p-2 d-flex">
                        <div class="row d-flex">
                            <span class="col-3">
                                <p class="pt-2">{{__('Date')}} </p>
                            </span>
                            <span class="col-4" style="margin-left: -20px; width: 39% !important;">
                                <input type="date" class="form-control border-0 mb-2 bg-light ml-2" wire:model.live="start_date">
                            </span>
                            <span class="col-1" style="margin-left: -20px; margin-top: 10px;">
                                <i class="bi bi-arrow-right-short mt-2 fs-15"></i>
                            </span>
                            <span class="col-4" style="margin-left: -20px; width: 39% !important;">
                                <input type="date" class="form-control border-0 bg-light mb-2 ml-2" wire:model.live="end_date">
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive p-0">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <td class="text text-sm text-secondary opacity-5"> {{__('Agency Code')}} </td>
                                <td class="text text-secondary text-sm opacity-7">{{__('Agency Name')}}</td>
                                <td class="text text-secondary text-sm opacity-7">{{__('Position')}}</td>
                                <td class="text text-secondary text-sm opacity-7">{{__('Manage By')}}</td>
                                <!--<td class="text text-secondary text-sm opacity-7">{{__('Shop Name')}} </td>-->
                                <td class="text text-center text-secondary text-sm opacity-7">{{__('Total Sale')}} </td>
                                <td class="text text-center text-secondary text-sm opacity-7">{{__('Total Recruit')}}</td>
                                <td class="text text-center text-secondary text-sm opacity-7">{{__('Award')}}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agencies as $key => $agency)
                            <?php $position = App\Models\Position::find($agency->position_id); ?>
                            <?php $leader = App\Models\Agency::find($agency->agency_id); ?>
                            <?php $sub_agencies = App\Models\Agency::where('agency_id', $agency->id)->with("children.children.children.children")->get(); ?>
                            <tr>
                                <th class="text-secondary text-sm opacity-7">{{$agency->code}}</th>
                                <th class="text-secondary text-sm opacity-7">{{$agency->full_name}}</th>
                                <th class="text-secondary text-sm opacity-7">{{$position->abbreviation ?? ''}}</th>
                                <th class="text-secondary text-sm opacity-7">{{$leader->code ?? ''}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{ $agency->total_sale}}</th>
                                <th class="text-center text-secondary text-sm opacity-7">{{ $agency->total_recruit}}</th>
                                <td class="text-center text text-sm">{{get_award($agency->total_sale, $agency->total_recruit, $agency->position_id)}}</td>
                            </tr>
                            @foreach($sub_agencies as $key => $_ageny)
                            @include('livewire.report.agency.levelagency.agency-list-report', ['agency' => $_ageny, 'key'=> $key])
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>