<div>
    <div>
        <section class="section">
            <div class="d-flex mb-3 justify-content-between">
                <div class="p-2 d-flex">
                    <!-- Date -->
                    <div class="col-lg-12 d-flex mt-1">
                        <div class="input-group w-50 p-2">
                            <input type="date" class="input-sm form-control custom-input datepicker"
                                wire:model.live="start_date" />
                        </div>
                        <div class="input-group w-50 p-2">
                            <input type="date" class="input-sm form-control custom-input datepicker"
                                wire:model.live="end_date" />
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <div class="p-2">
                        <div class="col-lg-12 col-sm-6">
                            <a wire:click="set_expend">
                                <button class="btn btn-primary button_save p-2">
                                    <i class="bi bi-plus-circle"></i>
                                    {{__('Add Income')}}
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $total_income_amount = 0;
            $total_sent_wife = 0;
            $total_get_from_wife = 0;
            ?>
            @foreach ($monthly_incomes as $income )
            <?php
            $total_income_amount += $income->amount;
            $total_sent_wife += $income->sent_wife;
            $total_get_from_wife += $income->get_from_wife;

            ?>
            @endforeach
            <div class="row d-flex">
                <div class="col-4">
                    <div class="p-2 card-body">
                        <div class="d-flex justify-content-between p-2">
                            <h5 class="text">Total Income For {{$month}}
                            </h5>
                        </div>
                        <div class="d-flex justify-content-between p-2">
                            <h2 class="text-default p-2">${{$total_income_amount}}.00 </h2>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-2 card-body">
                        <div class="d-flex justify-content-between p-2">
                            <h4 class="text">Total Sent Wife</h4>
                        </div>
                        <div class="d-flex justify-content-between p-2">
                            <h2 class="text-default p-2">${{$total_sent_wife}}.00 </h2>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-2 card-body">
                        <div class="d-flex justify-content-between p-2">
                            <h4 class="text">Total Get From Wife</h4>
                        </div>
                        <div class="d-flex justify-content-between p-2">
                            <h2 class="text-default p-2">${{$total_get_from_wife}}.00 </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                @foreach ($monthly_incomes as $income )
                <div class="col-lg-4 mt-4">
                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between p-2">
                            <h5 class="text">Get From <strong class="text-default">{{$income->source}}</strong>
                            </h5>
                            <h4 class="text-default"><i class="bi bi-currency-exchange"></i></h4>
                        </div>
                        <div class="p-2 d-flex">
                            <h2 class="text-default p-2">${{$income->amount}}.00 /</h2>
                            <h2 class="text-default p-2">${{$income->sent_wife}}.00</h2>
                        </div>
                        <div class="d-inline-block p-2">
                            <h6 class="text-default">getting date {{$income->created_at}}</h6>
                            <small>{{$income->remark}}</small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @include('livewire.incomes.record-income')
        </section>
    </div>
</div>