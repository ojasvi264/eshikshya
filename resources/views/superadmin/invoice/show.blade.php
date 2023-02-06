@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>INV-{{ $invoice->invoice_number }}</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Invoice View</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-sm btn-rounded btn-primary" onClick="PrintElem('#invoice_print')"><i class="fa fa-print text-white"></i> Print</a>
                        </div>
                        <div class="card-body">
                            <div id="invoice_print">
                                <table width="100%" border="0">
                                    <table width="100%" border="0">
                                        <tr>
                                            <td align="left"><img src="{{ asset($school_setting->logo) }}" alt="..." height="50px" width="70px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                            <td>
                                                <h4>{{ $school_setting->name }}</h4>
                                                <h4>{{ $school_setting->address }}<h4>
                                                <h4>{{ $school_setting->contact_number }}<h4>
                                            </td>
                                            <td align="right">&nbsp;&nbsp;</td>
                                        </tr>
                                    </table>
                                    <table width="100%" border="0" style="margin-top: -25px;">
                                        <tr>
                                            <td align="left">Invoice No: INV-{{ $invoice->invoice_number }}</td>
                                            <td align="right">
                                                @if($invoice->payment_date)
                                                    <h5>Date : {{ \Carbon\Carbon::parse($invoice->payment_date)->format('Y-m-d') }}</h5>
                                                @endif
                                                <h5>Title : Fees</h5>
                                                <h5>{{ ($invoice->status == 'unpaid') ? 'Un-paid' : 'Paid' }}</h5>
                                            </td>
                                        </tr>
                                    </table>
                                    <hr>
                                    <table width="100%" border="0" style="margin-top: 18px;">
                                        <tr>
                                            <td align="left"><h4>Bill To</h4></td>
                                        </tr>
                                        <tr>
                                            <td align="left" valign="top">
                                                {{ $invoice->student->fname }}<br/>
                                                {{ $invoice->student->class->name }}<br />
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $n = 0;
                                            $amounts = array();
                                        @endphp
                                        @foreach($invoice->invoiceDetails as $item)
                                            <tr>
                                                <td>{{ ++$n  }}</td>
                                                <td>{{ $item->feeType->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>NPR. {{ $item->feeType->amount }}</td>
                                                <td>NPR. {{ $item->quantity * $item->feeType->amount }}</td>
                                                @php array_push($amounts, $item->quantity * $item->feeType->amount) @endphp
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4">Discount</td>
                                            <td>NPR. {{ array_sum($amounts) * $invoice->discount/100 }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Total</td>
                                            <td>NPR. {{ $invoice->total_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">Late Fee</td>
                                            <td>NPR. {{ $invoice->late_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td>Amount in words:</td>
                                            <td colspan="2">
                                                @php
                                                    $f = new \NumberFormatter("en", NumberFormatter::SPELLOUT);
                                                    echo ucwords($f->format($invoice->total_amount + $invoice->late_amount));
                                                @endphp
                                            </td>
                                            <td>Total Amount :</td>
                                            <td>NPR. {{ $invoice->total_amount + $invoice->late_amount }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="table" width="100%" style="border-collapse: collapse;" border="0">
                                        <tr>
                                            <td><br />...................................................<br />Accountant Sign</td>
                                        </tr>
                                    </table>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

        // print invoice function
        function PrintElem(elem)
        {
            Popup($(elem).html());
        }

        function Popup(data)
        {
            var mywindow = window.open('', 'invoice', 'height=420,width=595');
            mywindow.document.write('<html><head><title>Invoice</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write(data);
            mywindow.document.write('</body></html>');

            mywindow.print();
            mywindow.close();

            return true;
        }

    </script>
@endsection
