<div>
    <section class="section">
        <div class="d-flex mb-3 justify-content-between">
            <div class="p-2 d-flex">
                <!-- Date -->
                <div class="col-lg-12 d-flex">
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
            <div class="d-flex justify-content-end">
                <div class="p-2">
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
        <div class="row d-flex">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row d-flex">
                    <?php
                    $total_expend = 0;
                    ?>
                    @foreach ($other_expends as $expend)
                    <?php
                    $total_expend = $expend->cloth_price + $expend->accessary_price + $expend->event_expense + $expend->taxi_fee;
                    ?>
                    <div class="col-lg-3 mb-4">
                        <div class="card-body mb-4">
                            <div class="border-0 shadow-sm">
                                <div class="d-flex mb-3 justify-content-between">
                                    <div class="p-2 d-flex">
                                        <div class="mt-1">{{__('Expense')}}
                                            {{$expend->created_at->format('Y-m-d')}}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end pointer"
                                        wire:click="update_other_expend({{$expend->id}})">
                                        <div class="p-2">
                                            <div class="col-lg-12 col-sm-6 text-default">
                                                <i class="bi bi-pencil-square"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row d-flex p-1">
                                    <div class="col-lg-7 p-2" style="margin-top: -20px;">
                                        <h6 class="p-1"><i class="bi bi-cart-plus p-2"></i> Items</h6>
                                        <h6 class="p-1"> <i class="bi bi-emoji-heart-eyes p-2"></i> Clothes
                                        </h6>
                                        <h6 class="p-1"> <i class="bi bi-headphones p-2"></i> Accessary</h6>
                                        <h6 class="p-1"> <i class="bi bi-cup-straw p-2"></i> Event</h6>
                                        <h6 class="p-1"> <i class="bi bi-car-front-fill p-2"></i> Taxi </h6>
                                    </div>
                                    <div class="col-lg-5 p-2" style="margin-top: -17px;">
                                        <h6>Item Cost</h6>
                                        <h6 class="mt-3"> <strong>៛ {{$expend->cloth_price}} </strong></h6>
                                        <h6 class="mt-4"> <strong>$ {{$expend->accessary_price}} </strong></h6>
                                        <h6 class="mt-3"> <strong>៛ {{$expend->event_expense}} </strong></h6>
                                        <h6 class="mt-3"> <strong>៛ {{$expend->taxi_fee}} </strong></h6>
                                    </div>
                                    <div class="col-lg-12">
                                        <h6 class="p-1"><i class="bi bi-brush p-2"></i> Remark
                                            <p class="p-3">
                                                @if($expend->remark)
                                                {{$expend->remark}}
                                                @else
                                                -
                                                @endif
                                            </p>
                                        </h6>
                                    </div>
                                </div>
                                <hr style="margin-top: -20px;">
                                <div class="row d-flex">
                                    <div class="col-lg-7 p-2" style="margin-top: -20px;">
                                        <h6 class="p-1">Tatal expense:</h6>
                                    </div>
                                    <div class="col-lg-5 p-2" style="margin-top: -17px;">
                                        <h6> <strong class="text-default">៛ {{$total_expend}}</strong></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('livewire.other-expense.create-other-expend')
        @livewire('other-expense.update-other-expense')
    </section>
</div>