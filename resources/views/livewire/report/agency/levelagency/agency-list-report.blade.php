<?php $padding_left = 2; ?>
@if($_ageny->children->count() > 0 )
<?php $padding_left += 2; ?>
@else

<?php $padding_left += $padding_left + 1; ?>
@endif
<tr>
    <td class="text-secondary text opacity-7">
        <div class="ps-{{$padding_left}}">{{$_ageny->code}}</div>
    </td>
    <td class="text-secondary text opacity-7">{{$_ageny->full_name}}</th>
    <td class="text-secondary text opacity-7">{{$_ageny->position->abbreviation ?? ''}}</td>
    <td class="text-secondary text opacity-7">{{$_ageny->parent->code ?? ''}}</td>
    <td class="text-center text-secondary text opacity-7">{{ $_ageny->applications->where('status', 2)->count()}}</td>
    <td class="text-center text-secondary text opacity-7">{{ $_ageny->children->where('agency_id', $_ageny->id)->whereIn('status',[1,2])->count()}}</td>
    <td class="text-center text text-sm">
        {{get_award($_ageny->applications->where('status', 2)->count(), $_ageny->children->where('agency_id', $_ageny->id)->whereIn('status',[1,2])->count(), $agency->position_id)}}
    </td>
</tr>


@foreach($_ageny->children as $key => $_ageny)
@include('livewire.report.agency.levelagency.agency-list-report', ['agency' => $_ageny])
@endforeach