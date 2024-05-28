<div wire:ignore.self class="modal fade" id="openModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="" wire:submit.prevent="submit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="staticBackdropLabel">Application Update Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <label for="exampleFormControlInput1" class="form-label text"> Status <span
                                    class="text-danger">*</span></label>
                            <select wire:model="status" wire:change="statusChange($event.target.value)"
                                class="form-select form-select-lg @error('status') is-invalid @enderror"
                                aria-label="Default select example">
                                <option value="4">Choose Status</option>
                                @foreach (get_application_status() as $status)
                                    <option value="{{ $status['id'] }}">{{ $status['label'] }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <small class="error text-danger fw-lighter">{{ $message }}</small>
                            @enderror <br>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary button_save">Update</button>
                    </div>
                </div>
        </form>
    </div>
</div>
