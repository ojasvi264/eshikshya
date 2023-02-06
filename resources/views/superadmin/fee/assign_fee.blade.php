@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Assign Fees</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fee</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Assign Fee</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Select required fields</h5>
                        </div>
                        <div class="card-body">
                            <form action="
{{--                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())--}}
{{--                            @if(auth()->guard('staff')->user()->role->name == 'Admin')--}}
{{--                            {{route('admin.get_students.search')}}--}}
{{--                            @elseif(auth()->guard('staff')->user()->role->name == 'Librarian')--}}
{{--                            {{route('librarian.get_students.search')}}--}}
{{--                            @endif--}}
{{--                            @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')--}}
                            {{route('fee_students.search')}}
{{--                            @endif--}}
                                " method="get">
                                @csrf
                                <input type="hidden" name="fee_master_id" value="{{$feeMaster->id}}">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class<span class="required">*</span></label>
                                            <select class="form-control" name="class_id" id="class_id" required>
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value='{{ $class->id }}'
                                                            @if($class->id == request()->class_id ) selected @endif>{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('class_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section<span class="required">*</span></label>
                                            <select class="form-control" name="section_id" id="section_id" required>
                                                <option value="">Select Section</option>
                                                @foreach ($sections as $section)
                                                    <option value='{{ $section->id }}'
                                                            @if($section->id == request()->section_id) selected @endif>{{$section->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('section_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Gender<span class="required">*</span></label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="">Select Section</option>
                                                    <option value='male' @if(request()->gender == 'male') selected @endif>Male</option>
                                                    <option value='female' @if(request()->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            <span class="text-danger">@error('gender'){{$message}}@enderror</span>
                                        </div>
                                    </div>
{{--                                    @if($feeMaster->fees_type != 'Admission Fee')--}}
{{--                                        <div class="col-lg-3 col-md-6 col-sm-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="form-label">Month<span class="required">*</span></label>--}}
{{--                                                <select class="form-control" name="month_name" id="month_name">--}}
{{--                                                    <option value="">Select Month</option>--}}
{{--                                                    @foreach(MONTHNAMES as $month)--}}
{{--                                                        <option value="{{ $month }}" @if($month == request()->month_name) selected @endif>{{$month}}</option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                                <span class="text-danger">@error('month_name'){{$message}}@enderror</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @include('includes.dashboard.message')
                @isset($searchedStudents)
                    <div class="col-lg-12">
                        <div class="row tab-content">
                            <div id="list-view" class="tab-pane fade active show col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Assign Fee List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <form action="{{route('assign_fee.store')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="class_id" value="{{request()->class_id}}">
                                                <input type="hidden" name="section_id" value="{{request()->section_id}}">
                                                <input type="hidden" name="gender" value="{{request()->gender}}">
                                                <input type="hidden" name="fee_master_id" value="{{$feeMaster->id}}">
                                                <div class="card-body mb-2" style="background-color: #dcd9ea; border-radius: 10px">
                                                    <div class="form-group">
                                                        <strong>Assign Fee</strong>
                                                        <table class="table">
                                                            <tr>
                                                                <th>Fee Type</th>
                                                                <th>Fee Group</th>
                                                                <th>Amount</th>
                                                                <th>Fine Type</th>
                                                            </tr>
                                                            <tr>
                                                                <td>{{$feeMaster->fees_type->name}}</td>
                                                                <td>{{$feeMaster->fee_group->name}}</td>
                                                                <td>{{$feeMaster->amount}}</td>
                                                                <td>{{$feeMaster->fine_type}}
                                                                    @if($feeMaster->fine_amount)
                                                                        ({{$feeMaster->fine_amount}})
                                                                    @elseif($feeMaster->percentage)
                                                                        ({{$feeMaster->percentage}}%)
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                @if($feeMaster->fees_type->submission_type == 'Monthly')
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label class="form-label">Month<span class="required">*</span></label>
                                                            <select class="form-control" name="month_name" id="month_name" required>
                                                                <option value="">Select Month</option>
                                                                @foreach(MONTHNAMES as $month)
                                                                    <option value="{{ $month }}" @if($month == request()->month_name ) selected @endif>{{$month}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger">@error('month_name'){{$message}}@enderror</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="d-flex">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" id="checkAll">
                                                            <label class="custom-control-label" for="checkAll"></label>
                                                        </div>
                                                        S.N
                                                    </th>
                                                    <th scope="col">Admission Number</th>
                                                    <th scope="col">Student Name</th>
                                                    <th scope="col">Class</th>
                                                    <th scope="col">Gender</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                $i = 1;
                                                @endphp
                                                @foreach($searchedStudents as $student)
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input check-student" id="customCheck{{$student->id}}" name="students[]" value="{{$student->id}}">
                                                            <label class="custom-control-label" for="customCheck{{$student->id}}">{{$i++}}</label>
                                                        </div>
                                                    </td>
                                                    <td>{{$student->admission}}</td>
                                                    <td>{{$student->fname}}</td>
                                                    <td>{{$student->class->name}}</td>
                                                    <td>{{$student->gender}}</td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#class_id').on('change', function () {
                let id = $(this).val();
                $('#section_id').empty();
                $('#section_id').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url: '/getSections/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#section_id').empty();
                        $('#section_id').append(`<option value="0" disabled selected>Select Sections*</option>`);
                        response.forEach(element => {
                            $('#section_id').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $("#checkAll").click(function () {
            $(".check-student").prop('checked', $(this).prop('checked'));
        });
    </script>
@endsection



