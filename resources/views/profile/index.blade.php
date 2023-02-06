@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>My Profile</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Profile</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">My Profile</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">My Profile</h5>
                          {{--  <a href="" class="btn btn-sm btn-primary m-1" style="display: block; position: absolute; top: 15px; right: 15px;"><i class="la la-pencil"></i></a>--}}
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-md-center">
                                <div class="col-lg-2 col-md-12 col-sm-12 d-flex justify-content-center mb-3">
                                    <div class="profile-wrapper">
                                        <div class="profile-photo">
                                            <img src="/images/user-icon.jpg" class="img-fluid rounded-circle" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-striped verticle-middle table-responsive-sm">
                                        <tr>
                                            <td>Name: </td>
                                            <td>{{\Illuminate\Support\Facades\Auth::user()->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email: </td>
                                            <td>{{\Illuminate\Support\Facades\Auth::user()->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>User Type: </td>
                                            <td>{{\Illuminate\Support\Facades\Auth::user()->user_type}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
