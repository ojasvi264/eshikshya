@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Due Fees</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fee</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Due Fees</a></li>
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
                            {{route('collect_fee_students.search')}}
                            {{--                            @endif--}}
                                " method="get">
                                @csrf
                                {{--                                <input type="hidden" name="fee_master_id" value="{{$feeMaster->id}}">--}}
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Class</label><span style="color: red">&#42;</span>
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
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Section</label><span
                                                style="color: red">&#42;</span>
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
                                        <h4 class="card-title">Collect Fee List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <form action="{{route('assign_fee.store')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="class_id" value="{{request()->class_id}}">
                                                <input type="hidden" name="section_id"
                                                       value="{{request()->section_id}}">
                                                <table id="example3" class="display" style="min-width: 845px">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">S.N</th>
                                                        <th scope="col">Student's Name</th>
                                                        <th scope="col">Class</th>
                                                        <th scope="col">Section</th>
                                                        <th scope="col">Admission Number</th>
                                                        <th scope="col">Father's Name</th>
                                                        <th scope="col">Date of Birth</th>
                                                        <th scope="col">Phone Number</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach($searchedStudents as $student)
                                                        <tr>
                                                            <td>{{$i++}}</td>
                                                            <td>{{$student->fname}}</td>
                                                            <td>{{$student->class->name}}</td>
                                                            <td>{{$student->section->name}}</td>
                                                            <td>{{$student->admission}}</td>
                                                            <td>{{$student->parent->father_name}}</td>
                                                            <td>{{$student->dob}}</td>
                                                            <td>{{$student->phone}}</td>
                                                            <td>
                                                                <a href="{{route('student.collect_fee', $student->id)}}">
                                                                    <span class="shadow-none badge badge-primary"
                                                                          style="cursor: pointer">Collect</span>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
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
@endsection




