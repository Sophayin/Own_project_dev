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
                    <input type="date" class=" form-control" id="end_date" wire:model.live="end_date" />
                </div>
            </div>
        </div>
    </section>
</div>