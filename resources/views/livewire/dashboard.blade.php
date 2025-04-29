<div>
    <section class="section">
        <div class="col-12 ">
            <h5 class="mt-1">Dashboard</h5>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between p-2">
                        <h5>Current Expense</h5>
                        <h6><i class="bi bi-graph-up-arrow"></i></h6>
                    </div>
                    <div class="p-2">
                        <?php
                        $total_current_expense = 0;
                        $total_party_expense = 0;
                        ?>
                        @foreach($current_expend as $expend)
                        <?php
                        $dollar_cash = $expend->coffee_price + $expend->gasoline_price + $expend->party_expend;
                        $riel_cash = $expend->breakfast + $expend->lunch + $expend->dinner;
                        $total_current_expense += ($riel_cash / 4000) + $dollar_cash;
                        $total_party_expense += $expend->party_expend;
                        ?>
                        @endforeach
                        <?php
                        $total_other_expense = 0;
                        ?>
                        @foreach ($other_expend as $o_expense )
                        <?php
                        $total_event = $o_expense->event_expense;
                        $total_taxi_fee = $o_expense->taxi_fee;
                        $total_other_expense += $o_expense->accessary_price + $o_expense->cloth_price + ($total_event + $total_taxi_fee / 4000);
                        ?>
                        @endforeach
                        <h2 class="text-default">${{$total_current_expense + $total_other_expense}}</h2>
                    </div>
                    <div class="d-inline-block p-2">
                        <h6 class="">Amount expend of current expend</h6>
                        <small class="text-default">Expend on this month higher than last week</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between p-2">
                        <h5>Total Party Expense <small class="text">( current month )</small></h5>
                        <h6><i class="bi bi-graph-up-arrow"></i></h6>
                    </div>
                    <div class="p-2">
                        <h2 class="text-default">$ {{$total_party_expense}}</h2>
                    </div>
                    <div class="d-inline-block p-2">
                        <h6 class="">Amount expend of current month party</h6>
                        <small class="text-default">Expend on this month higher than last week</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between p-2">
                        <h5 class="text">Total Expense <small class="text">( last Month )</small></h5>
                        <h6><i class="bi bi-graph-up-arrow"></i></h6>
                    </div>
                    <div class="p-2">
                        <?php
                        $total_last_month_expense = 0;
                        ?>
                        @foreach($last_month_expend as $lst_m_expend)
                        <?php
                        $dollar_cash = $lst_m_expend->coffee_price + $lst_m_expend->gasoline_price + $lst_m_expend->party_expend;
                        $riel_cash = $lst_m_expend->breakfast + $lst_m_expend->lunch + $lst_m_expend->dinner;
                        $total_last_month_expense += ($riel_cash / 4000) + $dollar_cash;
                        ?>
                        @endforeach
                        <h2 class="text-default">$ {{$total_last_month_expense}}</h2>
                    </div>
                    <div class="d-inline-block p-2">
                        <h6 class="">Amount expend of last month expend</h6>
                        <small class="text-default">Expend on this month higher than last week</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>