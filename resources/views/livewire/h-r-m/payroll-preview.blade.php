<div>
    <section class="section">
        <h3 class="p-3">
            <a href="/finance/payroll">
                <i class="bi bi-arrow-left-short"></i>
            </a>
        </h3>
        <div class="container-fluid" id="printable-div">
            <div class="row d-flex">
                <div class="d-flex justify-content-around">
                    <h4 class="col-sm-0 d-block">
                        <img src="/assets/svg/logo121.svg" alt="" width="120px" height="120px">
                    </h4>
                    <div class="text-center">
                        <h5 class="ml-5 text-danger">121 សបភី ឯ.ក</h5>
                        <h5 class="text-danger">121 Shoppee co.,LTD</h5>
                        <h5 class="text-primary report">របាយការណ៍ផ្តល់ប្រាក់កម្រៃលើកទឹកចិត្ត {{ $position_name }}</h5>
                    </div>
                    <small style="color: #ffffff;">.</small>
                </div>
            </div>
            <div class="card mt-3">
                <div class="table-responsive ">
                    <table class="table ">
                        <thead>
                            <tr class="text_header">
                                <th class="text-center text-secondary text-sm">{{__('No.')}}</th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Start Date')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Agency Code')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Agency Name')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Position')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Sale 1st Round')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Sale 2nd Round')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Total Sale')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Total Recruit')}}</nobr>
                                </th>

                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Commission Fee')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm">{{__('Salary')}} </th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Override Fee')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Incentive')}}</nobr>
                                </th>
                                <th class="text-center text-secondary text-sm">
                                    <nobr>{{__('Total Payment')}}</nobr>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $index = 1;
                            @endphp
                            @foreach ($payrolls as $payroll)
                            @php
                            $total_payment =
                            $payroll['details']->sum('salary') +
                            $payroll['details']->sum('incentive') +
                            $payroll['details']->sum('commission_fee') +
                            $payroll['details']->sum('override_fee');
                            @endphp
                            <tr class="text">
                                <td class="text-center">{{ $index++ }}</td>
                                <td class="text text-center">
                                    {{ $payroll['details'][0]->created_at->format('d/M/Y') }}
                                </td>
                                <td class="text text-center">
                                    {{ $payroll['details'][0]->agency->code }}
                                </td>
                                <td class="text text-center">
                                    {{ $payroll['details'][0]->agency->full_name_translate }}
                                </td>

                                <td class="text text-center">
                                    @if($payroll['details'][0]->agency->position)
                                    <nobr>{{ $payroll['details'][0]->agency->position->abbreviation}}</nobr>
                                    @endif
                                </td>
                                <td class="text text-center">
                                    {{ number_format($payroll['first_sale']) }}
                                </td>
                                <td class="text text-center">
                                    {{ number_format($payroll['second_sale']) }}
                                </td>
                                <td class="text text-center">
                                    {{ number_format($payroll['details']->sum('total_sale')) }}
                                </td>
                                <td class="text text-center">
                                    {{ number_format($payroll['details']->sum('total_recruit')) }}
                                </td>
                                <td class="text text-end">
                                    {{ $payroll['details']->sum('commission_fee') ? "$".number_format($payroll['details']->sum('commission_fee'), 2) : '' }}
                                </td>
                                <td class="text text-end">
                                    {{ $payroll['details']->sum('salary') ? "$".number_format($payroll['details']->sum('salary'), 2) : '' }}
                                </td>

                                <td class="text text-end">
                                    {{ $payroll['details']->sum('override_fee') ? "$".number_format($payroll['details']->sum('override_fee'), 2) : '' }}
                                </td>
                                <td class="text text-end">
                                    {{ $payroll['details']->sum('incentive') ? "$".number_format($payroll['details']->sum('incentive'), 2) : '' }}
                                </td>
                                <td class="text text-end">
                                    ${{ number_format($payroll['details']->sum('total_payroll'), 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row d-flex justify-content-center mb-3 text-center">
                    <div class="col-4">
                        <div class="row d-flex justify-content-center mb-3">
                            <div class="col-4">
                                <p style="height: 80px">អនុប័តដោយ</p>
                                <p>សួន វាសនា</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row d-flex justify-content-center mb-3">
                            <div class="col-4">
                                <p style="height: 80px">ត្រួតពិនិត្យដោយ</p>
                                <p>សុត ធិតា</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row d-flex justify-content-center mb-3">
                            <div class="col-4 text-sm">
                                <p style="height: 80px ">{{ now()->format('d D-M-Y') }}</p>
                                <p>ថេង ម៉ារីណែត</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mb-3">
                    <div class="col-lg-2">
                        <button class="btn btn-primary button_save" wire:click='download_excel'>{{__('Download Excel')}} </button>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-primary button_save" onclick="printDiv()">{{__('Download PDF')}} </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

@push('scripts')
<script type="text/javascript">
    function printDiv() {
        const divToPrint = document.getElementById("printable-div");
        window.print();
        divToPrint.style.transform = "";
    }
</script>
@endpush