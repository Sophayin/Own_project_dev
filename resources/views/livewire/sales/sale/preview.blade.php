<div>
    <section class="section">
        <div class="container-fluid" id="printable-div">
            <div class="row d-flex">
                <div class="d-flex justify-content-around">
                    <h4 class="col-sm-0 d-block">
                        <img src="/assets/svg/logo121.svg" alt="" width="120px" height="120px">
                    </h4>
                    <div class="text-center">
                        <h5 class="ml-5 text-danger">១២១ សបភី ឯ.ក</h5>
                        <h5 class="text-danger">121 Shoppee co.,LTD</h5>
                        <h5 class="text-primary report">របាយការណ៍របស់ភ្នាក់ងារ </h5>
                    </div>
                    <small style="color: #ffffff;">.</small>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <a wire:navigate href="{{route('sale.list', 'list')}}">
                        <h1><i class="bi bi-arrow-left-short"></i></h1>
                    </a>
                </div>
                <div class="col-12 mt-3">
                    <div class="d-flex">
                        <h5 class=" text mr-3">
                            {{__('Location')}}: <span> </span>
                        </h5>
                        <h5 class="text ml-3">
                            {{__('Shop Name')}}: <span></span>
                        </h5>
                    </div>
                </div>
                <div class="card">
                    <div class="table-responsive mt-2">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr class="text_header">
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('No.')}}</th>
                                    <!--<th class="text-center text-secondary text-sm opacity-7">{{__('Application ID')}}</th>-->
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Client Name')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Gender')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Phone Number')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Address')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Agency Name')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Agency Code')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Product Name')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Price')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Respond By')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Status')}}</th>
                                    <th class="text-center text-secondary text-sm opacity-7">{{__('Approved By')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $key => $item)
                                <tr class="text-center">
                                    <td class="text">{{++$key}}</td>
                                    <!--<td class="text">{{$item->code}}</td>-->
                                    <td class="text">{{$item->client_name}}</td>
                                    <td class="text">{{__($item->gender)}}</td>
                                    <td class="text">{{$item->phone}}</td>
                                    <td class="text">{{$item->address && $item->address->city ? get_translation($item->address->city) :""}}</td>
                                    <td class="text">{{$item->agency->full_name ?? ''}}</td>
                                    <td class="text">{{$item->agency->code ?? ''}}</td>
                                    <td class="text">{{ $item->product->title ?? ""}}</td>
                                    <td class="text text-end">${{ number_format($item->product_price,2)}}</td>
                                    <td class="text">{{ $item->respond_by }}</td>
                                    <td class="text">{{__(get_application_status($item->status)['label'])}} </td>
                                    <td>{{$item->loan_company->name ?? ''}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mb-3">
        <div class="container d-flex justify-content-center">
            <div class="col-lg-2 d-flex justify-content-center">
                <button class="btn btn-primary button_save " type="button" onclick="printDiv()">
                    {{__('Download')}}
                </button>
            </div>
        </div>

        <style>
            @media print {
                body * {
                    visibility: hidden;
                    /* Hide all elements by default */
                }

                .btn {
                    display: none;
                }

                @page {
                    size: landscape;

                }

                #printable-div,
                #printable-div * {
                    zoom: 96%;
                    visibility: visible;
                    size: A4 landscape;
                }
            }
        </style>
    </div>
    <script type="text/javascript">
        function printDiv() {
            const divToPrint = document.getElementById("printable-div");
            window.print();
            divToPrint.style.transform = "";
        }
    </script>