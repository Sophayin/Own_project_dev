<div class="tab-pane" id="upload" role="tabpanel" aria-labelledby="upload-tab">
    <form action="">
        <div class=" col-xl-7 col-lg-7 col-md-7 col-sm-7 col-xl-7">
            <div class="table-responsive">
                <table class="table ">
                    <thead>
                        <tr class="text_header">
                            <th class="text-center text-sm text-secondary">{{__('No.')}}</th>
                            <th class="text-center text-sm text-secondary">{{__('Document Name')}}</th>
                            <th class="text-center text-sm text-secondary">{{__('Type File')}}</th>
                            <th class="text-center text-sm text-secondary">{{__('Date')}}</th>
                            <th class="text-center text-sm text-secondary">{{__('View')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($documents->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">{{__("No Record Found.!")}}</td>
                        </tr>
                        @endif
                        @foreach ($documents as $i => $doc )
                        <tr class="text">
                            <td class="text-sm index-id">{{++$i}}</td>
                            <td class="text-sm">{{$doc->file_name}}</td>
                            <td class="text-sm">{{$doc->type}}</td>
                            <td class="text-sm">{{$doc->created_at->format('d/m/Y')}}</td>
                            <td class="text-sm"><a style=" border-color:azure;" href="{{ asset('/' . $doc->file_name) }}" target="_blank" class="rounded-pill btn btn-sm btn-outline-info"><i class="bi bi-eye-fill"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>