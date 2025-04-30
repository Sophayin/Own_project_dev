<div>
    <section class="section">
        <?php

        use App\Models\DailyExpend;

        $start_date = now()->startOfMonth()->toDateString();
        $end_date = now()->endOfMonth()->toDateString();
        $daily_expense = DailyExpend::whereBetween('created_at', [$start_date, $end_date])->orderBy('created_at', 'DESC')->get();
        ?>

        <div class="row d-flex p-3">
            <?php
            $total_meal = 0;
            $total_coffee = 0;
            $total_party = 0;
            $total_taxi = 0;
            $total_other = 0;
            ?>
            @foreach($daily_expense as $ex)
            <?php
            $total_meal = ($ex->breakfast + $ex->lunch + $ex->dinner) / 4000;
            $total_coffee = $ex->coffee_price;
            $total_party = $ex->party_expend;
            ?>
            <div class="col-lg-4 p-4 d-flex">
                <div class="card-body row d-flex">
                    <div class="col-5 mt-3">
                        <div class="mt-3"><i class="bi bi-command mr-2"></i> <strong class="p-2">Items</strong></div>
                        <div class="mt-3"><i class="fa-solid fa-utensils"></i> <strong class="p-2">Meal</strong></div>
                        <div class="mt-3"><i class="bi bi-cup-hot"></i> <strong class="p-2">Coffee</strong></div>
                        <div class="mt-3"><i class="fa-solid fa-champagne-glasses"></i> <strong class="p-2">Party</strong></div>
                        <div class="mt-3"><i class="fa-solid fa-taxi"></i> <strong class="p-2">Taxi</strong></div>
                        <div class="mt-3"><i class="fa-solid fa-circle-dollar-to-slot"></i> <strong class="p-2">Other</strong></div>
                    </div>
                    <div class="col-7 mt-3">
                        <div class="mt-3">: Amount</div>
                        <div class="mt-3">: $ {{$total_meal}}</div>
                        <div class="mt-3">: $ {{$total_coffee}}</div>
                        <div class="mt-3">: $ {{$total_party}}</div>
                        <div class="mt-3">: Price</div>
                        <div class="mt-3">: Price</div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </section>
</div>