<div>
    <section class="section">
        <div class="card">
            <h5 class="m-3">{{__('Language') }}</h5>
            <hr>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mt-3">
                            <div class="row mb-2">
                                <div class="col">
                                    <select wire:change="onSwitchLanguage" wire:model="lang" class="form-select">
                                        <option value="en">English</option>
                                        <option value="kh">ខ្មែរ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>