<div class="tab-pane fade show active mt-3 " id="home" role="tabpanel" aria-labelledby="home-tab">
    <form action="" wire:submit.prevent="updateSelectedAgencies">
        <div class="col-10">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <!--<th class="text-center">

                            </th>-->
                            <th class="text-center text-secondary">
                                <input wire:model="selectAll" wire:click="selectAll" type="checkbox" class="form-check-input">
                                <label class="form-check-label"> {{__('Code')}}</label>
                            </th>
                            <th class="text-center text-secondary">{{__('Agency Name')}}</small>
                            </th>
                            <th class="text-center text-secondary">{{__('Gender')}}</small></th>
                            <th class="text-center text-secondary">{{__('Phone Number')}}</small></th>
                            <th class="text-center text-secondary">{{__('Referrer')}}</small></th>
                            <th class="text-center text-secondary">{{__('Register Date')}}</small></th>
                            <th class="text-center text-secondary">{{__('Status')}}</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recruitagencies as $agency )
                        <tr class="text-center">
                            <td class="text-sm">
                                <input class="form-check-input" type="checkbox" wire:model="selectedAgencies" value="{{$agency->id}}">
                                <label class="form-check-label" for="flexCheck{{$agency->id .'-'.$agency->id}}">
                                    {{$agency->code}}
                                </label>
                            </td>
                            <td class="text-sm">{{$agency->full_name}}</td>
                            <td class="text-sm">{{$agency->gender}}</td>
                            <td class="text-sm">{{$agency->phone}}</td>
                            <td class="text-sm">{{$agency->parent->code ?? ''}}</td>
                            <td class="text-sm">{{date("d/m/Y",strtotime($agency->registered_date))}}
                            <td class="text-sm">{{__(get_agency_status($agency->status)['label'])}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
@push('scripts')
<script>
    $(document).ready(function() {
        $("th input[type='checkbox']").click(function() {
            var isChecked = $(this).prop("checked");
            $("td input[type='checkbox']").prop("checked", isChecked);
            Livewire.emit('selectAll', isChecked);
        });
    });
</script>
@endpush