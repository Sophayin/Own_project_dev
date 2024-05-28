<div>
    <section class="section">
        <div class="tab-pane " id="application" role="tabpanel" aria-labelledby="application-tab">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text_header">
                            <th width="18px" class="text-center text-secondary opacity-7">{{__('No.')}}</th>
                            <th class="text-center text-secondary opacity-7">{{__('Full Name')}}</th>
                            <th class="text-center text-secondary opacity-7">{{__('Gender')}}</th>
                            <th class="text-center text-secondary opacity-7">{{__('Position')}}</th>
                            <th class="text-center text-secondary opacity-7">{{__('Code')}}</th>
                            <th class="text-center text-secondary opacity-7">{{__('Leader Code')}}</th>
                            <th class="text-center text-secondary opacity-7">{{__('Status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($agency->children->isEmpty())
                        <tr>
                            <td colspan="8" class="text-center">{{__("No Record Found.!")}}</td>
                        </tr>
                        @else
                        @foreach ($agency->children as $i => $item)
                        <tr class="text-center">
                            <td class="text-sm index-id">{{++$i}}</td>
                            <td class="text-sm">{{$item->full_name}}</td>
                            <td class="text-sm">{{__($item->gender)}}</td>
                            <td class="text-sm">{{__($item->position->name ?? '')}}</td>
                            <td class="text-sm">{{$item->code}}</td>
                            <td class="text-sm">{{$item->parent->code ?? ''}}</td>
                            <td class="text-sm text-center">
                                @if($item->status)
                                {{__(get_agency_status($item->status)['label'])}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>