@extends('layouts.base_temp')
@php
    $feeAmountArray = $studentData->pluck('fee_amount')->toArray();
@endphp
@section('styles')
{{--    {{dd($feeAmountArray)}}--}}
{{--    {{dd($studentData)}}--}}
    <style>
        .member-image img {
            height: 100px;
            width: 100px;
            border-radius: 50%;
        }

        .member-card {
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 30px;
            padding-bottom: 30px;
            background-color: #fff;
            box-shadow: 0 2px 12px #dedede;
        }18000

        .member-name {
            text-align: center;
            padding: 5px 5px;
        }

        hr {
            color: #dedede;
        }

    </style>
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Collect Student Fee</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fee Collection</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Collect Fee</a></li>
                    </ol>
                </div>
            </div>
            @include('includes.dashboard.message')
            <div class="row">
                <div class="col-md-4">
                    <div class="member-card">
                        <div class="member-name">
                            <div class="member-image">
                                <img src="{{$student->profile_image}}" alt="">
                            </div>
                            <h5>
                                <strong>{{$student->fname}}</strong>
                            </h5>

                        </div>
                        <div>
                            <table class="table mx-auto w-100">
                                <tr>
                                    <th>Class</th>
                                    <td>{{$student->class->name}}</td>
                                </tr>
                                <tr>
                                    <th>Section</th>
                                    <td>{{$student->section->name}}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{$student->gender}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="member-card">
                        <div>
                            <div class="card-body mb-2" style="background-color: #dcd9ea; border-radius: 10px">
                                <div class="table-responsive">
                            <table class="table mx-auto w-100">
                                <tr>
                                    <th>Father's Name</th>
                                    <td>{{$student->parent->father_name}}</td>
                                </tr>
                                <tr>
                                    <th>Admission Number</th>
                                    <td>{{$student->admission}}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{$student->phone}}</td>
                                </tr>
                                <tr>
                                    <th>Roll Number</th>
                                    <td>{{$student->roll}}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{$student->category->category_name}}</td>
                                </tr>
                            </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
{{--                        @if($paidFee->isNotEmpty())--}}
{{--                            //Data Here....--}}
{{--                        @else--}}
                            @if($studentData->isNotEmpty())
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <div class="member-card">
                                        <div class="d-flex">
                                            <button class="btn btn-success mr-2"  data-toggle="modal" data-target="#exampleModal" id="payALl">Pay All</button>
{{--                                            <button class="btn btn-warning mr-2" data-toggle="modal" data-target="#exampleModal" onclick="paySelected()">Pay Selected</button>--}}
                                            <button class="btn btn-primary">Print Selected</button>
                                        </div>
                                    </div>
                                    <div class="member-card">
                                        <h5>Return Book</h5>
                                        <hr>
                                        <div>
                                            <div class="table-responsive">
                                                <table id="example3" class="display">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col" class="d-flex">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                                                <label class="custom-control-label" for="checkAll"></label>
                                                            </div>
                                                            S.N
                                                        </th>
                                                        <th>Fee Type</th>
                                                        <th>Due Date</th>
                                                        <th>Amount</th>
                                                        <th>Discount</th>
                                                        <th>Fine</th>
                                                        <th>Previous Session Fee</th>
                                                        <th>Balance</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $i = 1;
                                                        $feeTotal = 0;
                                                        $fineTotal = 0;
                                                        $discountTotal = 0;
                                                        $balanceTotal = 0;
                                                        $previousSessionFeeTotal = 0;
                                                    @endphp
                                                    @foreach($studentData as $key => $collectFee)
                                                        @if($collectFee->fee_type_name != null)
                                                        @php
                                                            $feeTotal += $collectFee->fee_amount;
                                                            $previousSessionFeeTotal += $collectFee->previous_session_fee;

                                                            if ($collectFee->fine_type == "Percentage"){
                                                               $fineAmount = ($collectFee->fine_percentage)/100 * $collectFee->fee_amount;
                                                               $fineTotal += $fineAmount;
                                                            }else if ($collectFee->fine_type == "Fix Amount"){
                                                                $fineAmount = $collectFee->fine_amount;
                                                                $fineTotal += $fineAmount;
                                                            }else{
                                                                $fineAmount = 0;
                                                            }

                                                            if ($collectFee->discount_type == "Percentage"){
                                                               $discountAmount = ($collectFee->discount_percentage)/100 * $collectFee->fee_amount ;
                                                               $discountTotal += $discountAmount;
                                                            }else if ($collectFee->fine_type == "Amount"){
                                                                $discountAmount = $collectFee->discount_amount;
                                                                $discountTotal += $discountAmount;
                                                            }else{
                                                                $discountAmount = 0;
                                                            }
                                                            $balanceAmount = $collectFee->fee_amount + $fineAmount - $discountAmount + $collectFee->previous_session_fee;
                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" class="custom-control-input check-student" id="customCheck{{$key}}" name="students[]" value="{{$collectFee->id}}">
                                                                    <label class="custom-control-label" for="customCheck{{$key}}">{{$i++}}</label>
                                                                </div>
                                                            </td>
                                                            <td class="feesType">
                                                                <div class="fee_type" data-fees_type_id="{{$collectFee->fees_type_id}}">{{$collectFee->fee_type_name}}</div>
                                                                @if($collectFee->fee_type_name == "Monthly Fee")
                                                                    (<span class="month_name">{{$collectFee->month_name}}</span>)
                                                                @endif
                                                            </td>
                                                            <td class="dueDate">{{$collectFee->due_date}}</td>
                                                            <td class="feeAmount">{{$collectFee->fee_amount}}
                                                            </td>
                                                            <td class="payDiscount">{{$discountAmount}}</td>
                                                            <td class="fineAmount">{{$fineAmount}}</td>
                                                            <td class="previousSessionFee">{{$collectFee->previous_session_fee}}</td>
                                                            <td class="balanceAmount">{{$balanceAmount}}</td>
                                                            <td>
                                                                @if(!empty($collectFee->status))
                                                                    @if($collectFee->status == 0)
                                                                        <span class="shadow-none badge badge-warning">Partial</span>
                                                                    @elseif($collectFee->status == 1)
                                                                        <span class="shadow-none badge badge-success">Paid</span>
                                                                    @endif
                                                                @else
                                                                    <span class="shadow-none badge badge-danger">Unpaid</span>
                                                                @endif
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td>Total</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td id="feeSum">{{$feeTotal}}</td>
                                                            <td id="discountSum">{{$discountTotal}}</td>
                                                            <td id="fineSum">{{$fineTotal}}</td>
                                                            <td>{{$previousSessionFeeTotal}}</td>
                                                            <td>{{$feeTotal+$fineTotal-$discountTotal+$previousSessionFeeTotal}}</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                                <div class="modal fade" id="returnBook" tabindex="-1"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title" id="exampleModalLabel">
                                                                    <strong>Are you sure you want to return the
                                                                        book?</strong>
                                                                </h3>
                                                                <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul>
                                                                    <li>
                                                                        <strong>Return Date</strong>
                                                                        <input type="date" class="form-control"
                                                                               id="return_date"
                                                                               name="return_date"
                                                                               value="{{old('return_date')?old('return_date'): ''}}"
                                                                               required style="">
                                                                        <span id="date_error_msg"></span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                        data-bs-dismiss="modal">Close
                                                                </button>
                                                                <button type="button" class="btn btn-primary"
                                                                        id="submitReturnBook">Save
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Collect Fees</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" id="payForm">
                                                                <div class="modal-body">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <input type="hidden" name="student_id" value="{{$studentData[0]->id}}">
                                                                        <div class="form-group">
                                                                            <label class="form-label">Date</label><span style="color: red">&#42;</span>
                                                                            <input type="date" class="form-control" name="date" value='{{Carbon\Carbon::now()->format('Y-m-d')}}'>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label">Payment Mode</label><span style="color: red">&#42;</span>
                                                                            <select class="form-control" name="payment_mode" id="payment_mode" required>
                                                                                <option value="">Select Payment Mode</option>
                                                                                <option value='cash'>Cash</option>
                                                                                <option value='cheque'>Cheque</option>
                                                                                <option value='bank_transfer'>Bank Transfer</option>
                                                                                <option value='card'>Card</option>
                                                                            </select>
                                                                            <span id="payment_mode_error_msg"></span>
                                                                        </div>
{{--                                                                        <div class="form-group">--}}
{{--                                                                            <label class="form-label">Discount</label><span style="color: red">&#42;</span>--}}
{{--                                                                            <input type="number" class="form-control" name="discount" value="{{$discountTotal}}">--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="form-group">--}}
{{--                                                                            <label class="form-label">Fine</label><span style="color: red">&#42;</span>--}}
{{--                                                                            <input type="number" class="form-control" name="fine" value="{{$fineTotal}}">--}}
{{--                                                                        </div>--}}
                                                                        <div class="form-group">
                                                                            <label class="form-label">Amount</label><span style="color: red">&#42;</span>
                                                                            <input type="number" class="form-control" name="paid_amount" id="paidAmount" required>
                                                                            <span id="paid_amount_error_msg"></span>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="form-label">Note</label>
                                                                            <textarea name="description" class="form-control"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <div class="text-right">
                                                                        <div><strong>Total Amount:</strong> {{$feeTotal+$fineTotal-$discountTotal+$previousSessionFeeTotal}}</div>
                                                                        <div><strong>Total Fine:</strong> {{$fineTotal}}</div>
                                                                        <div><strong>Total Discount:</strong> {{$discountTotal}}</div>
                                                                        <div class="d-flex justify-content-between">
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                            <button type="button" class="btn btn-primary" onclick="payFee()">Pay</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
{{--                        @endif--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("#checkAll, #payALl").click(function () {
            $(".check-student").prop('checked', true);
        });
        $('#exampleModal').on('hidden.bs.modal', function () {
            $(".check-student").prop('checked', false);
        });

    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        });
        function payFee(){
            //validation
            let payment_mode = $('#payment_mode').find(":selected").val();
            let paidAmount = $('#paidAmount').val();
            if (payment_mode == ""){
                $('#payment_mode_error_msg').append(`<span class="text-danger">Payment Mode is Required</span>`)
                return;
            }
            if (paidAmount == ""){
                $('#paid_amount_error_msg').append(`<span class="text-danger">Amount is Required</span>`)
                return;
            }
            let form = document.getElementById('payForm');
            let formData = new FormData(form);
            $('#example3 tbody .check-student:checked').each(function (){
               let tr = $(this).closest('tr');
               let fees_type_id = tr.find('.fee_type').attr('data-fees_type_id');
               let feesType = tr.find('.fee_type').text();
               let monthName = tr.find('.month_name').text();
                let dueDate = tr.find('.dueDate').text();
                let feeAmount = tr.find('.feeAmount').text();
                let discount = tr.find('.payDiscount').text();
                let fineAmount = tr.find('.fineAmount').text();
                let previousSessionFee = tr.find('.previousSessionFee').text();
                let balance = tr.find('.balanceAmount').text();
               formData.append('fees_type_id[]', fees_type_id);
               formData.append('feesType[]', feesType);
               formData.append('monthName[]', monthName);
               formData.append('dueDate[]', dueDate);
               formData.append('feeAmount[]', feeAmount);
               formData.append('discount[]', discount);
               formData.append('fineAmount[]', fineAmount);
               formData.append('previousSessionFee[]', previousSessionFee);
               formData.append('balance[]', balance);
            });
            console.log(...formData);
            $.ajax({
                type: 'POST',
                url: '/paid_fee/store',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    location.reload();
                }
            });
        }
    </script>

@endsection



