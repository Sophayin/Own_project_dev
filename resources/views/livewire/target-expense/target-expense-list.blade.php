<div>
    <section class="section">
        <div class="d-flex mb-3 justify-content-between">
            <div class="p-2 d-flex">
                <!-- Date -->
                <div class="col-lg-12 d-flex">
                    <h4 class="text"> Target Expense</h4>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="p-2">
                    <div class="col-lg-12 col-sm-6">
                        <a wire:click="set_expend">
                            <button class="btn btn-primary button_save p-2">
                                <i class="bi bi-plus-circle"></i>
                                {{__('Set Expend')}}
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            @foreach ($monthly_targets as $target )
            <div class="col-lg-4 mt-4">
                <div class="card-body p-2">
                    <div class="d-flex justify-content-between p-2">
                        <h5 class="text">Target for {{$target->month}}
                        </h5>
                        <h4 class="text-default"><i class="bi bi-currency-exchange"></i></h4>
                    </div>
                    <div class="p-2">
                        <h2 class="text-default">${{$target->amount}}.00</h2>
                    </div>
                    <div class="d-inline-block p-2">
                        <h6 class="">Budget Plan for {{$target->month}}</h6>
                        <small>{{$target->remark}}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @include('livewire.target-expense.set-expend')
    </section>
</div>