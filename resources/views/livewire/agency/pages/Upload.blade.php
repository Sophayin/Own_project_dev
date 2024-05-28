<div class="tab-pane" id="upload" role="tabpanel" aria-labelledby="upload-tab">
    <form action="">
        <div class="d-flex justify-content-center mt-3" wire:click="uploadDoc">
            <label for="fileInput" class="custom-file-input" style="border: dotted; padding: 15px; border-radius: 10px; cursor: pointer;">
                <i class="bi bi-cloud-arrow-up-fill cloud_icon"></i>
                <span class="custom-file-label">{{__('Upload Document')}} </span>

            </label>
        </div>
        <div class=" col-xl-7 col-lg-7 col-md-7 col-sm-7 col-xl-7">
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr class="text_header">
                            <th class="text-center text-secondary">{{__('No.')}}</th>
                            <th class="text-center text-secondary">{{__('Document Name')}}</th>
                            <th class="text-center text-secondary">{{__('Type File')}}</th>
                            <th class="text-center text-secondary">{{__('Date')}}</th>
                            <th class="text-center text-secondary">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $i => $doc )
                        <tr style="vertical-align: middle;">
                            <td>{{++$i}}</td>
                            <td>{{$doc->file_name}}</td>
                            <td>{{$doc->type}}</td>
                            <td>{{$doc->created_at->format('d/m/Y')}}</td>
                            <td align="center" width="90">
                                <a style="border-color:transparent;" href=" {{ asset('/' . $doc->file_name) }}" target="_blank" class="rounded-pill btn btn-sm btn btn-outline-info">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a style=" border-color:azure;" wire:click="deleteDoc({{ $doc->id }})" class="rounded-pill btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    <div wire:ignore.self class="modal fade" id="openModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form wire:submit.prevent="uploadDocument">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('Upload Document')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-flex mb-5">
                            <div class="col-3">
                                <label for="">{{__('Khmer Identity Card')}}</label>
                                <input type="file" wire:model="file_id_card" class="form-control document">
                            </div>
                            <div class="col-3">
                                <label for="">{{__('Birth Certificate')}}</label>
                                <input type="file" wire:model="birth_certificate" class="form-control document">
                            </div>
                            <div class="col-4">
                                <label for="">{{__('CV')}}</label>
                                <input type="file" wire:model="file_name" class="form-control document ">
                            </div>
                            <div class="col-2 mt-4">
                                <button class="btn btn-primary button_save">{{__('Upload')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal delete document-->
    <div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="text-danger text-center">
                        <h5>{{__('Are you sure, You want to delete it ?')}}</h5>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary button_save" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="button" wire:click="confirmDelete" class="btn btn-danger delete">{{__('Delete')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>