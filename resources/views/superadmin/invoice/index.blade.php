@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Invoice List</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Invoice List</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 750px">
                                    <thead>
                                    <tr>
                                        <th>Invoice Number</th>
                                        <th>Student</th>
                                        <th>Class</th>
                                        <th>Amount</th>
                                        <th>Created At</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($student_invoices as $student_invoice)
                                        <tr>
                                            <td>INV-{{ $student_invoice->invoice_number }}</td>
                                            <td>{{ $student_invoice->student->fname }}</td>
                                            <td>{{ $student_invoice->student->class->name }}</td>
                                            <td>
                                                NPR. {{ $student_invoice->total_amount + $student_invoice->late_amount }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($student_invoice->create_at)->format('Y/m/d') }}</td>
                                            <td>{{ $student_invoice->due_date }}</td>
                                            <td>
                                                @if($student_invoice->status == 'paid')
                                                    <span class="badge bg-success text-white">Paid</span>
                                                @else
                                                    <span class="badge bg-danger text-white">Un-Paid</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($student_invoice->status == 'unpaid')
                                                    <a href="{{ route('student.invoice.mark.paid', $student_invoice->id) }}" class="btn btn-sm btn-primary m-1"><i class="fa fa-check-circle"></i></a>
                                                @endif
                                                <a href="{{ route('student.invoice.show', $student_invoice->id) }}" class="btn btn-sm btn-primary m-1"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('student.invoice.destroy', $student_invoice->id) }}" class="btn btn-sm btn-danger m-1"><i class="la la-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
