<div>
    <section class="section">
        <div class="col-12 ">
            <h5 class="mt-1">Dashboard</h5>
        </div>
        <div class="col-lg-4 mt-4 ">
            <div class="col-lg-12 d-flex">
                <div class="input">
                    <input type="date" class=" form-control custom-input" id="start_date" wire:model.live="start_date" />
                </div>
                <div class="input mt-2">
                    <i class="bi bi-arrow-right-short"></i>
                </div>
                <div class="input">
                    <input type="date" class=" form-control custom-input" id="end_date" wire:model.live="end_date" />
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between p-2">
                        <h5>Total Expense <small class="text"> (Up to date)</small></h5>
                        <h6><i class="bi bi-graph-up-arrow"></i></h6>
                    </div>
                    <div class="p-2">
                        <h2>$ 250.00</h2>
                    </div>
                    <div class="d-inline-block p-2">
                        <h6 class="">Amount expend of this week</h6>
                        <small>Expend on this month higher than last week</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between p-2">
                        <h5>Total Expense <small class="text">( last Week )</small></h5>
                        <h6><i class="bi bi-graph-up-arrow"></i></h6>
                    </div>
                    <div class="p-2">
                        <h2>$ 250.00</h2>
                    </div>
                    <div class="d-inline-block p-2">
                        <h6 class="">Amount expend of this week</h6>
                        <small>Expend on this month higher than last week</small>
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
                        <h2>$ 250.00</h2>
                    </div>
                    <div class="d-inline-block p-2">
                        <h6 class="">Amount expend of this week</h6>
                        <small>Expend on this month higher than last week</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>