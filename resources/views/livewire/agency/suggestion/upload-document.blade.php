<div class="tab-pane" id="upload" role="tabpanel" aria-labelledby="upload-tab">
    <div class="row d-flex">
        <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xl-6 mt-3">
            <p class="fw-semibold border-bottom">{{__('Document List')}}</p>
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th class="text-center text-secondary">{{__('No.')}}</th>
                            <th class="text-center text-secondary">{{__('Document Name')}}</th>
                            <th class="text-center text-secondary">{{__('Type File')}}</th>
                            <th class="text-center text-secondary">{{__('Date')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $doc)
                        <tr class="text">
                            <td><small>{{$doc->id}}</small></td>
                            <td><small>{{$doc->file_name}}</small></td>
                            <td><small>{{$doc->type}}</small></td>
                            <td class="text-sm">{{date("d/m/Y",strtotime($doc->created_at))}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class=" col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xl-6 mt-3 mb-5">
            <form wire:submit.prevent="uploadDocument">
                <p class="fw-semibold border-bottom">{{__('Attach File')}}</p>
                <div class="row d-flex">
                    <div class="col-5">
                        <label for="file_id_card" class="text">{{__('Khmer Identity Card')}}</label>
                        <input type="file" wire:model="file_id_card" class="form-control document mb-3">
                    </div>
                    <div class="col-5">
                        <label for="file_name" class="text">{{__('CV')}}</label>
                        <input type="file" wire:model="file_name" id="document" class="form-control document">
                    </div>
                    <div class="col-2 mt-4">
                        <button type="submit" class="btn btn-primary d-flex justify-content-center button_save">{{__('Upload')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>