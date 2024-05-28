<div>
    <section class="section">
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <h6 class="mt-2 p-1">{{__('Welcome To')}} {{$user->name}}</h6>
                </div>
            </div>
        </div>
        <div class="col-lg-4 p-2">
            <!-- Date -->
            <p>{{__('Date')}} </p>

            <div class="col-lg-12 d-flex">
                <div class="input">
                    <input type="date" class=" form-control" id="start_date" wire:model.live="start_date" />
                </div>
                <div class="input mt-2">
                    <i class="bi bi-arrow-right-short"></i>
                </div>
                <div class="input">
                    <input type="date" class=" form-control" id="end_date" wire:model.live="end_date"/>
                </div>
            </div>
        </div>
            <div class="row d-flex">
                <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="card">
                    <div class="row">
                        <div class="col-6">
                            <p class="pt-2 pointer" style="margin-left: 5px;">{{__('Top Sale')}} <i class="bi bi-chevron-down"></i></p>
                            @foreach($agencies as $agency)
                            <div class="d-flex border-bottom">
                                <div class="p-2 flex-grow-1"><i class="bi bi-person-circle"></i><small class="pl-2" style="margin-left: 7px;">{{$agency->code}}</small></div>
                                <div class="p-2"><small>{{$agency->applications->count()}}</small></div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-6">
                            <p class="justify-content-end pt-2" style="margin-left: 120px; "></p>
                            <div style="margin-left: -10px !important;">
                                <canvas id="doughnut" width="60%" height="60%"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-6">
                                <p class="pt-2 pointer" style="margin-left: 5px;">{{__('New Recruit')}}<i class="bi bi-chevron-down"></i></p>
                                @foreach ($recruitAgencies as $recruitagen )
                                <div class="d-flex border-bottom">
                                    <div class="p-2 flex-grow-1"><small>{{$recruitagen->code}}</small></div>
                                    <div class="p-2"><small>{{$recruitagen->children->count()}}</small></div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-6">
                                <p class="justify-content-end pt-2" style="margin-left: 120px; "> </p>
                                <div style="margin-left: -10px !important;">
                                    <canvas id="donut" width="60%" height="60%"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card">
                        <div class="row">
                            <div class="col-12">
                                <p class="pt-2 pointer" style="margin-left: 10px;">{{__('Top Shop')}} <i class="bi bi-chevron-down"></i></p>
                                @foreach ($shops as $shop )
                                <div class="d-flex border-bottom">
                                    <div class="p-2 flex-grow-1 d-flex">
                                        <div class="sign"></div><small>{{$shop->shop_name}}</small>
                                    </div>
                                    <div class="p-2"><small>{{$shop->applications_count}}</small></div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-4">
                    <div class="card">
                        <p class="pt-2 pointer" style="margin-left: 10px;">{{__('Top Product')}}<i class="bi bi-chevron-down"></i></p>
                        @foreach ($products as $product )
                        <div class="d-flex border-bottom">
                            <div class="p-2 flex-grow-1 d-flex">
                                <div class="sign"></div><small>{{$product->title}}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="card">
                        <p class="pt-2 pointer" style="margin-left: 10px;">{{__('Recent Activities')}}<i class="bi bi-chevron-down"></i></p>
                        @foreach ($latestActions as $actions )
                        <div class="d-flex border-bottom">
                            <div class="p-2 flex-grow-1 d-flex">
                                <div class="sign"></div><small>{{$actions->action}}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
    </section>
</div>
@push('scripts')
<script type="text/javascript">
    const doughnut = document.getElementById('doughnut');
    const chartData = @json($agencies->pluck('applications_count')->toArray());
    new Chart(doughnut, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'QTY of Sale',
                data: chartData,
                backgroundColor: [
                    'red',
                    'blue',
                    'yellow',
                    'green',
                    'orange'
                ],
                borderWidth: 0,
                radius: '95%'
            }]
        },
        options: {
            pieHole: 1,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const donut = document.getElementById('donut');
    const agencyData = @json($recruitAgencies->pluck('children')->map(function($children) {
        return $children->count();
    })->toArray());
    new Chart(donut, {
        type: 'doughnut',
        data: {
            datasets: [{
                label: 'QTY of Recruit',
                data: agencyData,
                backgroundColor: [
                    'red',
                    'blue',
                    'yellow',
                    'green',
                    'orange'
                ],
                borderWidth: 0,
                weight: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    //--reload charts when changing language---
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('languageChanged', function() {
            location.reload();
        });
    });
</script>
@endpush