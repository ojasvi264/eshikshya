@extends('layouts.base_temp')
@section('styles')
    <style>
        .manage-syllabus-switch input[type="checkbox"]:after {
            display: none;
        }

        .closeCompletionDate {
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
                        <h4>Issue Return</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Lesson Plans</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Issue Return</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="row tab-content">
                            <div id="list-view" class="tab-pane fade active show col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Student Issue Return List</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example3" class="display" style="min-width: 845px">
                                                <thead>
                                                <tr>
                                                    <th>Member Id</th>
                                                    <th>Library Card Number</th>
                                                    <th>Admission Number</th>
                                                    <th>Name</th>
                                                    <th>Member Type</th>
                                                    <th>Phone</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($libraryMembers as $libraryMembers)
                                                    <tr>
                                                        <td>{{$libraryMembers->id}}</td>
                                                        <td>{{$libraryMembers->library_card_number}}</td>
                                                        <td>
                                                            @if($libraryMembers->student_id)
                                                                {{$libraryMembers->student->admission}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($libraryMembers->student_id)
                                                                {{$libraryMembers->student->fname}}
                                                            @elseif($libraryMembers->directory_id)
                                                                {{$libraryMembers->staff->name}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($libraryMembers->student_id)
                                                                {{"Student"}}
                                                            @elseif($libraryMembers->directory_id)
                                                                {{$libraryMembers->staff->role->name}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($libraryMembers->student_id)
                                                                {{$libraryMembers->student->phone}}
                                                            @elseif($libraryMembers->directory_id)
                                                                {{$libraryMembers->staff->phone}}
                                                            @endif
                                                        </td>
                                                        <td>
{{--                                                            @if($libraryMembers->student_id)--}}
{{--                                                                <a class="btn btn-danger" href="{{route('student_issue_return.detail', $libraryMembers->student->id)}}"><i class="fa fa-sign-out"></i></a>--}}
{{--                                                            @elseif($libraryMembers->directory_id)--}}
                                                                <a class="btn btn-danger" href="
                                                                    @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                        @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                            {{route('admin.issue_return.detail', $libraryMembers->id)}}
                                                                        @elseif(auth()->guard('staff')->user()->role->name == 'Librarian')
                                                                            {{route('librarian.issue_return.detail', $libraryMembers->id)}}
                                                                        @endif
                                                                    @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                        {{route('issue_return.detail', $libraryMembers->id)}}
                                                                    @endif
                                                                    "><i class="fa fa-sign-out"></i></a>
{{--                                                            @endif--}}
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
        </div>
    </div>
@endsection



