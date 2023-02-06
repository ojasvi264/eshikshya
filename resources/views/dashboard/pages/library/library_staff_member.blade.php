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
                        <h4>Staff Member List</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Library</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Add Library Staff Member</a></li>
                    </ol>
                </div>
            </div>
            @include('includes.dashboard.message')
            {{--            <div class="row">--}}
            {{--                <div class="col-xl-12 col-xxl-12 col-sm-12">--}}
            {{--                    <div class="card">--}}
            {{--                        <div class="card-body">--}}
            {{--                            @if (session()->get('success'))--}}
            {{--                                <div class="alert alert-success">--}}
            {{--                                    {{session()->get('success')}}--}}
            {{--                                    --}}{{--  <button type="button" class="close-icon" data-dismiss="alert">--}}
            {{--                                          <i class="la la-close"></i>--}}
            {{--                                      </button>--}}
            {{--                                </div>--}}
            {{--                            @endif--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <div class="row">
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
                                                <th>Staff Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Date Of Birth</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($staffs as $staff)
                                                <tr>
                                                    <td>{{isset($staff->issue_return) ? $staff->issue_return->id : ''}}</td>
                                                    <td>{{isset($staff->issue_return) ? $staff->issue_return->library_card_number : ''}}</td>
                                                    <td>{{$staff->name}}</td>
                                                    <td>{{$staff->email}}</td>
                                                    <td>{{$staff->role->name}}</td>
                                                    <td>{{$staff->dob}}</td>
                                                    <td>
                                                        <div class="form-check form-switch manage-syllabus-switch">
                                                            @if(isset($staff->issue_return) ?? $staff->issue_return->status==1)
                                                                <input class="form-check-input" type="radio"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#removeLibraryCardModel"
                                                                       data-id="{{$staff->issue_return->id ?? ''}}"
                                                                       checked>
                                                            @else
                                                                <input class="form-check-input" type="radio"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#addLibraryCardModel"
                                                                       data-id="{{$staff->id ?? ''}}">
                                                            @endif
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Library Membership Status</label>
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
                                                                           id="library_card_number" value="{{old('library_card_number')?old('library_card_number'): ''}}"
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
            </div>
        </div>
    </div>
@endsection
@section('scripts')
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
                const type = "Staff"
                // console.log(id);
                // console.log(library_card_number);
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
