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
                <div class="col-lg-3">
                    <div class="card-body p-2">
                        <h1>Hello Other Expense</h1>
                    </div>
                </div>
            </div>
        </div>
        @include('livewire.other-expense.create-other-expend')
    </section>
</div>