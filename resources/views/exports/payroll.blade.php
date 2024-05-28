<html>
<div>
    <h3 class="p-3">
        <a href="/hrm/payroll">
            <i class="bi bi-arrow-left-short"></i>
        </a>
    </h3>
    <div class="container-fluid">

        <div class="card mt-3">
            <div class="table-responsive ">
                <table class="table ">
                    <thead>
                        <tr class="text_header">
                            <th scope="col">No</th>
                            <th scope="col">ID</th>
                            <th scope="col">Agency Name</th>
                            <th scope="col">Agency Name (Latin)</th>
                            <th scope="col">Position</th>
                            <th scope="col">Target Recruit</th>
                            <th scope="col">Target Sale</th>
                            <th scope="col">Total Recruit</th>
                            <th scope="col">Total Sale</th>
                            <th scope="col">Incentive</th>
                            <th scope="col">Commission</th>
                            <th scope="col">Salary</th>
                            <th scope="col">Overwrite Fee</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payrolls as $index => $payroll)
                            <tr class="text">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <p>{{ $payroll->agency->code }}</p>
                                </td>
                                <td>
                                    <p>{{ $payroll->agency->full_name }}</p>
                                </td>
                                <td>
                                    <p>{{ $payroll->agency->full_name_translate }}</p>
                                </td>
                                <td>
                                    <p>{{ $payroll->agency->position->name }}</p>
                                </td>
                                <td>
                                    <p>{{ number_format($payroll->target_recruit) }}</p>
                                </td>
                                <td>
                                    <p>{{ number_format($payroll->target_sale) }}</p>
                                </td>
                                <td>
                                    <p>{{ number_format($payroll->total_recruit) }}</p>
                                </td>
                                <td>
                                    <p>{{ number_format($payroll->total_sale) }}</p>
                                </td>
                                <td>
                                    <p>{{ number_format($payroll->incentive, 2) }}$ </p>
                                </td>
                                <td>
                                    <p>{{ number_format($payroll->commission, 2) }} $</p>
                                </td>
                                <td>
                                    <p>{{ number_format($payroll->salary, 2) }}$</p>
                                </td>
                                <td>
                                    <p>{{ number_format($payroll->overwrite_fee, 2) }}$</p>
                                </td>
                                <td>
                                    <p>{{ $payroll->created_at->format('D-d-M-Y') }}</p>
                                </td>
                                <td>
                                    <p>{{ $payroll->remark }}</p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row d-flex justify-content-center mb-3 text-center">
                <div class="col-lg-4">
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-4">
                            <p style="height: 80px">អនុប័តដោយ</p>
                            <p>សួន វាសនា</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-4">
                            <p style="height: 80px">ត្រួតពិនិត្យដោយ</p>
                            <p>សុត ធិតា</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-4">
                            <p style="height: 80px">{{ now()->format('d D-M-Y') }}</p>
                            <p>ថេង ម៉ារីណែត</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


</html>
