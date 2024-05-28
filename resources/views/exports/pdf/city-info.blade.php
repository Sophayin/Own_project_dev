<div>
    <style>
        table,
        td {
            border: 1px solid gray;
            border-collapse: collapse;
            font-size: 12px;
            color: gray;
        }

        th {
            border: 1px solid grey;
            font-size: 12px;
            color: gray;
            width: 100%;
        }

        ul,
        li,
        dd,
        dt {
            list-style: none;
            text-decoration: none;
        }
    </style>
    <div class="table-responsive">
        <div class="container">
            <dl>
                <dt>- Id:<span style="color:red"> {{$city->id}}.</span> {{__('City')}}: {{get_translation($city)}}</dt>
                <ul>
                    @foreach ($city->district as $dist )
                    <li>- Id:<span style="color: red"> {{$dist->id}},</span> {{__('District')}}:{{get_translation($dist)}}</li>
                    <ul>
                        @foreach ($dist->commune as $comm )
                        <li>- Id:<span style="color: red"> {{$comm->id}},</span> {{__('Commune')}}: {{get_translation($comm)}}</li>
                        <ul>
                            @foreach ($comm->village as $vill )
                            <li>- Id:<span style="color: red"> {{$vill->id}},</span> {{__('Village')}}: {{get_translation($vill)}}</li>
                            @endforeach
                        </ul>
                        @endforeach
                    </ul>
                    @endforeach
                </ul>
            </dl>
        </div>
        <htmlpagefooter name="page-footer">

        </htmlpagefooter>
    </div>
</div>