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
                    <img src="{{asset('assets/svg/logo121.png')}}" alt="{{env('APP_HEADER_NAME_KH')}}" width="150px">
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
                            <!-- Date -->
                            <div class="col-lg-12 d-flex mt-2" id="sandbox-container">
                                <p class="pt-2 p-1">
                                    <nobr>{{__('Date')}}</nobr>
                                </p>
                                <div class="input-group">
                                    <input type="text" class="input-sm form-control" id="start_date" wire:model.live="start_date" style="height: 38px;" />
                                    <span class="input-group-text" id="basic-addon1" style="height: 38px; margin-top: 1px;"><i class="bi bi-calendar"></i></span>
                                </div>
                                <div class="input-group">
                                    <input type="text" class="input-sm form-control" id="end_date" wire:model.live="end_date" style="height: 38px;" />
                                    <span class="input-group-text" id="basic-addon1" style="height: 38px; margin-top: 1px;"><i class="bi bi-calendar"></i></span>
                                </div>
                            </div>
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
    <div class="mb-3">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-2 d-flex justify-content-center">
                <button class="btn btn-primary button_save dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{__('Download')}}
                </button>
                <ul class="dropdown-menu justify-content-center">
                    <li class="d-flex justify-content-center text">
                        <a class="dropdown-item" href="#" onclick="printDiv()">
                            <i class="bi bi-download"></i> PDF (.pdf)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
                /* Hide all elements by default */
            }

            .btn {
                display: none;
            }

            @page {
                size: landscape;

            }

            #printable-div,
            #printable-div * {
                zoom: 96%;
                visibility: visible;
                size: A4 landscape;
            }
        }
    </style>
</div>
@push('scripts')
<script type="text/javascript">
    function printDiv() {
        const dateInputContainer = document.getElementById("dateInputContainer");
        if (dateInputContainer) {
            dateInputContainer.parentNode.removeChild(dateInputContainer);
        }
        const divToPrint = document.getElementById("printable-div");
        window.print();
        if (dateInputContainer) {
            dateInputContainer.style.display = "";
        }
        window.location.reload();
    }
    //--selected date--
    jQuery(document).ready(function() {
        $('#start_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'XX',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        $('#end_date').datepicker({
            autoclose: true,
            todayHighlight: true,
            language: 'XX',
            uiLibrary: 'bootstrap5',
            format: "yyyy-mm-dd",
            minDate: '-12m',
            maxDate: '0',
        });
        $('#start_date, #end_date').on('change', function() {
            @this.set('start_date', $('#start_date').val());
            @this.set('end_date', $('#end_date').val());
        });
    });
</script>
@endpush