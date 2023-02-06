@extends('layouts.base_temp')
@section('styles')
    <style>
        .manage-syllabus-switch input[type="checkbox"]:after {
            display: none;
        }
        .closeLibraryCard {
            margin-right: 335px;
        }
    </style>
@endsection
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Student List</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Library</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Library Student Member</a></li>
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
                            @include('includes.dashboard.message')
                                <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{route('admin.get_students.search')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Librarian')
                                        {{route('librarian.get_students.search')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{route('get_students.search')}}
                                @endif
                                    " method="get">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Class<span class="required">*</span></label>
                                                <select class="form-control" name="class_id" id="class_id">
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
                                                <label class="form-label">Section<span class="required">*</span></label>
                                                <select class="form-control" name="section_id" id="section_id">
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
                @isset($searchedStudents)
                <div class="col-lg-12">
                        <div class="row tab-content">
                            <div id="list-view" class="tab-pane fade active show col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Role List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                <tr>
                                                    <th>Member Id</th>
                                                    <th>Library Card Number</th>
                                                    <th>Student Name</th>
                                                    <th>Email</th>
                                                    <th>Date Of Birth</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($searchedStudents as $student)
                                                    <tr>
                                                        <td>{{isset($student->issue_return) ? $student->issue_return->id : ''}}</td>
                                                        <td>{{isset($student->issue_return) ? $student->issue_return->library_card_number : ''}}</td>
                                                        <td>{{$student->fname}}</td>
                                                        <td>{{$student->email}}</td>
                                                        <td>{{$student->dob}}</td>
                                                        <td>
                                                            <div class="form-check form-switch manage-syllabus-switch">
                                                                @if(isset($student->issue_return) ?? $student->issue_return->status==1)
                                                                    <input class="form-check-input" type="radio"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#removeLibraryCardModel"
                                                                           data-id="{{$student->issue_return->id}}"
                                                                           checked>
                                                                @else
                                                                    <input class="form-check-input" type="radio"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#addLibraryCardModel"
                                                                           data-id="{{$student->id ?? ''}}">
                                                                @endif
                                                                <label class="form-check-label"
                                                                       for="flexSwitchCheckDefault">Library Membership Status</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <div class="modal fade" id="addLibraryCardModel" tabindex="-1"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    <strong>Add Member</strong>
                                                                </h5>
                                                                <button type="button" class="btn-close closeLibraryCard"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <ul>
                                                                    <li>
                                                                        <strong>Library Card Number</strong>
                                                                        <input type="text" class="form-control"
                                                                               id="library_card_number"
                                                                               value="{{old('library_card_number')?old('rating'):''}}"
                                                                               name="library_card_number" required>
                                                                        <span id="library_card_error_msg"></span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="d-flex">
                                                                    <button type="button" class="btn btn-danger closeLibraryCard"
                                                                            data-bs-dismiss="modal">Close
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary"
                                                                            id="submitLibraryCard">Save
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal fade" id="removeLibraryCardModel" tabindex="-1"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    <strong>Are you sure you want to remove membership?</strong>
                                                                </h5>
                                                                <button type="button" class="btn-close closeLibraryCard"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger closeLibraryCard"
                                                                        data-bs-dismiss="modal">No
                                                                </button>
                                                                <button type="button" class="btn btn-primary"
                                                                        id="removeLibraryCard">Yes
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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
        $(document).ready(function () {
            var myModalEl = document.getElementById('addLibraryCardModel')
            myModalEl.addEventListener('shown.bs.modal', function (event) {
                const relatedTarget = $(event.relatedTarget);
                const id = relatedTarget.data('id');
                $('#submitLibraryCard').data('id', id);
                $('.closeLibraryCard').click(function (){
                    window.location.reload();
                })
            });

            $('#submitLibraryCard').click(function () {
                let library_card_number = $('#library_card_number').val();
                if (!library_card_number){
                    $('#library_card_error_msg').append(`<span class="text-danger">Library Card Number is Required</span>`)
                    return;
                }
                const id = $(this).data('id');
                const type = "Student"
                console.log(id);
                console.log(library_card_number);
                $.ajax({
                    type: 'GET',
                    url: '/add_library_member/' + id,
                    data: {library_card_number: library_card_number, type: type},
                    dataType: "json",
                    success: function (response) {
                        $('#addLibraryCardModel').modal('hide');
                        console.log(response);
                        window.location.reload();
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var myModalEl = document.getElementById('removeLibraryCardModel')
            myModalEl.addEventListener('shown.bs.modal', function (event) {
                const relatedTarget = $(event.relatedTarget);
                const id = relatedTarget.data('id');
                $('#removeLibraryCard').data('id', id);
                // $('.closeLibraryCard').click(function (){
                //     window.location.reload();
                // })
            });

            $('#removeLibraryCard').click(function(){
                const id = $(this).data('id');
                console.log(id);
                $.ajax({
                    type: 'GET',
                    url: '/remove_member/' + id,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        window.location.reload();
                    }
                });
            });
        });

    </script>


@endsection



