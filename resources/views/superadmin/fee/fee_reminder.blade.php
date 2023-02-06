@extends('layouts.base_temp')
@php
  $feeReminder = \App\Models\FeeReminder::all();
@endphp
@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Fee Reminder</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees Collection</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees Reminder</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    @include('includes.dashboard.message')
                                    <form action="{{route('fee_reminder.store')}}" method="POST">
                                        @csrf
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Reminder Tye</th>
                                                    <th>Days</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
{{--                                                            <input type="hidden" name="status[]" value="0">--}}
                                                            <input type="checkbox"
                                                               name="status_0"
                                                               value="1"
                                                               class="custom-control-input check-student"
                                                               id="customCheck"
                                                               @if($feeReminder[0]->status ==1)
                                                                   checked
                                                                @else
                                                                   ""
                                                                @endif
                                                                >
                                                            <label class="custom-control-label"
                                                                   for="customCheck">Active</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label>After</label>
                                                        <input type="hidden" name="reminder_type[]" value="after">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="days[]" value="{{$feeReminder[0]->days}}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
{{--                                                            <input type="hidden" name="status[]" value="0">--}}
                                                            <input type="checkbox"
                                                                   name="status_1"
                                                                   value="1"
                                                                   class="custom-control-input check-student"
                                                                   id="customCheck1"
                                                                   @if($feeReminder[1]->status ==1)
                                                                   checked
                                                            @else
                                                                ""
                                                            @endif
                                                            >
                                                            <label class="custom-control-label" for="customCheck1">Active</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label>
                                                            <label>After</label>
                                                            <input type="hidden" name="reminder_type[]" value="after">
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="days[]" value="{{$feeReminder[1]->days}}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
{{--                                                            <input type="hidden" name="status[]" value="0">--}}
                                                            <input type="checkbox"
                                                                   name="status_2"
                                                                   value="1"
                                                                   class="custom-control-input check-student"
                                                                   id="customCheck2"
                                                                   @if($feeReminder[2]->status ==1)
                                                                   checked
                                                            @else
                                                                ""
                                                            @endif
                                                            >
                                                            <label class="custom-control-label" for="customCheck2">Active</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label>Before</label>
                                                        <input type="hidden" name="reminder_type[]" value="before" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="days[]" value="{{$feeReminder[2]->days}}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
{{--                                                            <input type="hidden" name="status[]" value="0">--}}
                                                            <input type="checkbox"
                                                                   name="status_3"
                                                                   value="1"
                                                                   class="custom-control-input check-student"
                                                                   id="customCheck3"
                                                                   @if($feeReminder[3]->status ==1)
                                                                   checked
                                                            @else
                                                                ""
                                                            @endif
                                                            >
                                                            <label class="custom-control-label" for="customCheck3">Active</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <label>Before</label>
                                                        <input type="hidden" name="reminder_type[]" value="before" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="days[]" value="{{$feeReminder[3]->days}}">
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary" id="submitFeeReminder">Save</button>
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
    <script>
        $('#customCheck').change(function() {
            if($('#customCheck').is(":not(:checked)")){
                $('#customCheck').val('0');
            }
        });
        $('#customCheck1').change(function() {
            if($('#customCheck1').is(":not(:checked)")){
                $('#customCheck1').val('0');
            }
        });
        $('#customCheck2').change(function() {
            if($('#customCheck2').is(":not(:checked)")){
                $('#customCheck2').val('0');
            }
        });
        $('#customCheck3').change(function() {
            if($('#customCheck3').is(":not(:checked)")){
                $('#customCheck3').val('0');
            }
        });
        // $('#submitFeeReminder').click(function(){
        //
        //     if($('#customCheck1').is(":not(:checked)")){
        //         $('#customCheck1').val('0');
        //     }
        //     if($('#customCheck2').is(":not(:checked)")){
        //         $('#customCheck2').val('0');
        //     }
        //     if($('#customCheck3').is(":not(:checked)")){
        //         $('#customCheck3').val('0');
        //     }
        //
        // });
    </script>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection


