<div>
    <style>
        .table-Permission {
            margin-bottom: 0px;
            margin-top: 0px;
        }

        .table-Permission tr:last-child {
            border-bottom-color: white;
        }
    </style>
    <section class="section">
        <form wire:submit.prevent="setPermission">
            <div class="row">
                <div class="d-flex ">
                    <h5>
                        {{__('Apply Permission For')}}
                        << {{$role->name}} &nbsp;>>
                            <button type="submit" class="btn btn-primary button_save">{{__('Apply')}}</button>
                    </h5>
                </div>
            </div>
            <div class="card pt-4">
                <div class="card-body">
                    <div class="row">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ __($error) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!--{{$department_children}}-->
                        <!--{{json_encode($sub_department_action)}}-->
                        <table class="table" style="width: 100%;">
                            <tbody>
                                @foreach($get_departments as $_key => $depart)
                                <tr>
                                    <td colspan="2" class="align-middle text-uppercase" width="20%;" style="border-bottom:solid #b0bdc3;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:click="handle_main_department({{$depart->id}})" wire:model="main_department.{{$depart->id}}" id="flexCheckDefault-{{$depart->id}}">
                                            <label class="form-check-label" for="flexCheckDefault-{{$depart->id}}">
                                                {{get_translation($depart)}}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0px;">
                                        <table class="table table-bordered table-sm">
                                            <tbody>
                                                @foreach($depart->children as $__key => $item)
                                                <tr>
                                                    <td class="align-middle">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" wire:click="handle_sub_department({{$item->id}})" wire:model="sub_department.{{$item->id}}" value="{{$item->id}}" id="flexCheckDefault-{{$item->id.'-'.$depart->id}}">
                                                            <label class="form-check-label" for="flexCheckDefault-{{$item->id.'-'.$depart->id}}">
                                                                {{get_translation($item)}}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td style="width:80%;">
                                                        <table class="table table-sm table-Permission">
                                                            @foreach($item->permission as $___key => $action)
                                                            <tr>
                                                                <td class="d-flex">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" wire:click="handle_sub_department_action({{$item->id}},{{$action->id}})" wire:model="sub_department_action.{{$item->id}}.{{$action->id}}" value="{{$action->id}}" id="flexCheckDefault-{{$action->id}}.{{$item->id}}.{{$depart->id}}">
                                                                        <label class="form-check-label" for="flexCheckDefault-{{$action->id}}.{{$item->id}}.{{$depart->id}}">
                                                                            {{ __($action->action) }}
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </table>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>