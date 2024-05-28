<div>
    <section class="section">
        <div class="tab-pane " id="application" role="tabpanel" aria-labelledby="application-tab">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text_header">
                            <th class="text-center text-secondary text-sm opacity-7">{{__('No.')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Position')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Code')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Leader Code')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Date')}}</th>
                            <th class="text-center text-secondary text-sm opacity-7">{{__('Status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($agency->agency_history->whereIn('status', ['demote', 'promote'])->isEmpty())
                        <td colspan="8" class="text-center">{{__("No Record Found.!")}}</td>
                        @else
                        @foreach ($agency->agency_history as $i=> $promote )
                        <tr class="text-center">
                            <td class="text-sm index-id">{{++$i}}</td>
                            <td class="text-sm">{{$promote->position->name?? ''}}</td>
                            <td class="text-sm">{{$promote->agency_code}}</td>
                            <td class="text-sm">{{$promote->agency->parent->code ?? ''}}</td>
                            <td class="text-sm">{{$promote->updated_at->format('d/m/Y')}}</td>
                            <td class="text-sm">
                                @if ($promote->status == null)
                                {{__('Joined')}}
                                @elseif($promote->status == 'promote')
                                <span class="text-success">
                                    <i class="bi bi-caret-up-fill"></i>{{$promote->status}}
                                </span>
                                @else
                                <span class="text-danger">
                                    <i class="bi bi-caret-down"> </i>{{$promote->status}}
                                </span>
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