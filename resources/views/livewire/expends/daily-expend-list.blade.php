<div>
    <section class="section">
        <div class="card-body col-12 d-flex mb-3 justify-content-between">
            <!-- Date -->
            <div class="col-lg-6 d-flex mt-3">
                <div class="input-group w-50 p-2">
                    <input type="date" class="input-sm form-control custom-input datepicker"
                        wire:model.live="start_date" />
                </div>
                <div class="input-group w-50 p-2">
                    <input type="date" class="input-sm form-control custom-input datepicker"
                        wire:model.live="end_date" />
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="p-2 mt-3">
                    <div class="col-lg-12 col-sm-6">
                        <a wire:click="btn_add_application">
                            <button class="btn btn-primary button_save p-2">
                                <i class="bi bi-plus-circle"></i>
                                {{__('Add Expend')}}
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="d-flex">
                <?php
                $total_other_expense = 0;
                $total_party_expense = 0;
                ?>
                @foreach ($other_expense as $o_expense )
                <?php
                $total_event = $o_expense->event_expense;
                $total_taxi_fee = $o_expense->taxi_fee;
                $total_other_expense += $o_expense->accessary_price + $o_expense->cloth_price + ($total_event + $total_taxi_fee / 4000);
                ?>
                @endforeach
                <?php
                $total_current_expense = 0;
                $total_coffee_expense = 0;
                $total_meal_expense = 0;

                ?>
                @foreach($daily_expends as $daily)
                <?php
                $dollar_cash = $daily->coffee_price + $daily->gasoline_price + $daily->party_expend;
                $riel_cash = $daily->breakfast + $daily->lunch + $daily->dinner;
                $total_current_expense += ($riel_cash / 4000) + $dollar_cash;
                $total_coffee_expense += $daily->coffee_price;
                $total_party_expense += $daily->party_expend;
                $total_meal_expense += ($daily->breakfast + $daily->lunch + $daily->dinner) / 4000;
                ?>
                @endforeach
                <div class="me-auto p-2">
                    <div class="d-flex p-2">
                        <div class="p-2">
                            <div class="card-body">
                                <div class="p-2">
                                    <div class="col-lg-12 col-sm-6">
                                        <h6>
                                            Party Expense
                                        </h6>
                                        <h4 class="text-center text-danger">
                                            $ {{$total_party_expense}}
                                        </h4>
                                        <?php
                                        $percentage = ($total_party_expense / $total_current_expense) * 100;
                                        ?>
                                        <small> {{round($percentage,2)}} % / {{$total_current_expense}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="card-body">
                                <div class="p-2">
                                    <div class="col-lg-12 col-sm-6">
                                        <h6>
                                            Coffee Expense
                                        </h6>
                                        <h4 class="text-center text-light">
                                            $ {{ $total_coffee_expense}}
                                        </h4>
                                        <?php
                                        $percentage = ($total_coffee_expense / $total_current_expense) * 100;
                                        ?>
                                        <small> {{round($percentage,2)}} % / {{$total_current_expense}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-2">
                            <div class="card-body">
                                <div class="p-2">
                                    <div class="col-lg-12 col-sm-6">
                                        <h6>
                                            Meal Expense
                                        </h6>
                                        <h4 class="text-center text-light">
                                            $ {{ $total_meal_expense}}
                                        </h4>
                                        <?php
                                        $percentage = ($total_meal_expense / $total_current_expense) * 100;
                                        ?>
                                        <small> {{round($percentage,2)}} % / {{$total_current_expense}}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2 mt-3">
                    <div class="card-body">
                        <div class="p-2">
                            <div class="col-lg-12 col-sm-6">
                                <h6>
                                    @if($total_current_expense> $amount)
                                    {{__('Over Expect')}}
                                    @else
                                    {{__('Remain Balance')}}
                                    @endif
                                </h6>
                                <h4 class="text-center text-success">
                                    $
                                    @if(!empty($total_current_expense > $amount))
                                    - {{number_format(abs($total_current_expense + $total_other_expense - $amount), 2)}}
                                    @else
                                    {{number_format(abs($total_current_expense + $total_other_expense - $amount), 2)}}
                                    @endif
                                </h4>
                                <?php
                                $remain_amount = $total_current_expense + $total_other_expense - $amount;
                                $percentage = abs($remain_amount / $amount * 100);
                                ?>
                                <small class="text-center"> {{round($percentage,2)}} % / {{$amount}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2 mt-3">
                    <div class="card-body">
                        <div class="p-2">
                            <div class="col-lg-12 col-sm-6">
                                <h6>{{__('Current Expense')}}</h6>
                                <h4 class="text-center text-danger">$ {{($total_current_expense)}}</h4>
                                <?php
                                $percentage = abs($total_current_expense / $amount * 100);
                                ?>
                                <small class="text-center"> {{round($percentage,2)}} % / {{$amount}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2 mt-3">
                    <div class="card-body">
                        <div class="p-2">
                            <div class="col-lg-12 col-sm-6">
                                <h6>{{__('Other Expense')}}</h6>
                                <h4 class="text-center text-danger">$ {{( $total_other_expense)}}</h4>
                                <?php
                                $percentage = abs($total_other_expense / $amount * 100);
                                ?>
                                <small class="text-center"> {{round($percentage,2)}} % / {{$amount}}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-2 mt-3">
                    <div class="card-body">
                        <div class="p-2">
                            <div class="col-lg-12 col-sm-6">
                                <h6>{{__('Target Expense')}}</h6>
                                <h4 class="text-center text-default">${{$amount ?? 0}}.00</h4>
                                <?php
                                $percentage = abs($amount / $amount * 100);
                                ?>
                                <small class="text-center"> {{round($percentage,2)}} % / {{$amount}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row d-flex p-2">
                    <?php
                    $total_current_expense = 0;
                    $coffee = 0;
                    ?>
                    @foreach($daily_expends as $daily)
                    <?php
                    $dollar_cash = $daily->coffee_price + $daily->gasoline_price + $daily->party_expend;
                    $riel_cash = $daily->breakfast + $daily->lunch + $daily->dinner;
                    $total_current_expense = ($riel_cash / 4000) + $dollar_cash;

                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card-body mb-4">
                            <div class="border-0 shadow-sm">
                                <div class="d-flex mb-3 justify-content-between">
                                    <div class="p-2 d-flex">
                                        <div class="mt-1">{{__('Expense')}}
                                            {{$daily->created_at->format('Y-m-d')}}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end pointer"
                                        wire:click="update_expend({{$daily->id}})">
                                        <div class="p-2">
                                            <div class="col-lg-12 col-sm-6 text-default">
                                                <i class="bi bi-pencil-square"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7 p-2" style="margin-top: -20px;">
                                        <h6 class="p-1"><i class="bi bi-cart-plus p-2"></i> Items</h6>
                                        <h6 class="p-1"> <i class="bi bi-brightness-alt-high-fill p-2"></i> Breakfast
                                        </h6>
                                        <h6 class="p-1"> <i class="bi bi-brightness-high-fill p-2"></i> Lunch</h6>
                                        <h6 class="p-1"> <i class="bi bi-brightness-alt-low-fill p-2"></i> Dinner</h6>
                                        <h6 class="p-1"> <i class="bi bi-cup-hot p-2"></i> Coffee X <strong
                                                class="text-danger">({{$daily->amount_coffee}})</strong></h6>
                                        <h6 class="p-1"> <i class="bi bi-emoji-sunglasses p-2"></i> Party</h6>
                                        <h6 class="p-1"> <i class="bi bi-fuel-pump-diesel p-2"></i> Gasoline</h6>
                                    </div>
                                    <div class="col-5  p-2" style="margin-top: -17px;">
                                        <h6>Item Cost</h6>
                                        <h6 class="mt-3"> <strong>៛ {{number_format($daily->breakfast,2)}}</strong></h6>
                                        <h6 class="mt-3"> <strong>៛ {{number_format($daily->lunch,2)}}</strong></h6>
                                        <h6 class="mt-4"> <strong>៛ {{number_format($daily->dinner,2)}}</strong></h6>
                                        <h6 class="mt-3"> <strong>$ {{number_format($daily->coffee_price,2)}}</strong>
                                        </h6>
                                        <h6 class="mt-3">
                                            @if($daily->party_expend > 0)
                                            <strong class="text-primary">$ {{number_format($daily->party_expend,2)}}</strong>
                                            @else
                                            <strong>$ {{number_format($daily->party_expend,2)}}</strong>
                                            @endif
                                        </h6>
                                        <h6 class="mt-3"> <strong>$ {{number_format($daily->gasoline_price,2)}}</strong>
                                        </h6>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h6 class="p-1"><i class="bi bi-brush p-2"></i> Remark
                                        <p class="p-3">
                                            @if($daily->remark)
                                            {{$daily->remark}}
                                            @else
                                            -
                                            @endif
                                        </p>
                                    </h6>
                                </div>
                                <hr style="margin-top: -20px;">
                                <div class="row d-flex">
                                    <div class="col-lg-7 p-2" style="margin-top: -20px;">
                                        <h6 class="p-1">Tatal expense:</h6>
                                    </div>
                                    <div class="col-lg-5 p-2" style="margin-top: -17px;">
                                        <h6 class="text-center"> <strong class="text-default">$
                                                {{ $total_current_expense}}.00</strong></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('livewire.expends.create-daily-expense')
        @livewire('expends.update-daily-expend')
    </section>
</div>