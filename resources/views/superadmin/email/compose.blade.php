@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Send Email</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('super.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Communicate</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Send Email</a></li>
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
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="individual-tab" data-bs-toggle="tab" href="#individual" role="tab" aria-controls="individual" aria-selected="false">Individual</a>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="class-tab" data-bs-toggle="tab" href="#class" role="tab" aria-controls="class" aria-selected="false">Class</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="group-tab" data-bs-toggle="tab" href="#group" role="tab" aria-controls="group" aria-selected="true">Group</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade" id="individual" role="tabpanel" aria-labelledby="individual-tab">
                                            @include('superadmin.email.indvidual')
                                        </div>
                                        <div class="tab-pane fade" id="class" role="tabpanel" aria-labelledby="class-tab">
                                            @include('superadmin.email.class')
                                        </div>
                                        <div class="tab-pane fade show active" id="group" role="tabpanel" aria-labelledby="group-tab">
                                            @include('superadmin.email.group')
                                        </div>
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'message' );
        CKEDITOR.replace( 'message_class' );
        CKEDITOR.replace( 'message_individual' );
    </script>
    <script>
        function getClassSections(class_id) {
            if (class_id !== '') {
                $.ajax({
                    url: '{{ url('/class/sections/checkbox') }}'+'/'+ class_id ,
                    success: function(response)
                    {
                        jQuery('#section_holder').html(response);
                    }
                });
            }
        }
    </script>
    <script>
        function getData(message_to_type) {
            if (message_to_type !== '') {
                $.ajax({
                    url: '{{ url('/data') }}'+'/'+ message_to_type ,
                    success: function(response)
                    {
                        jQuery('#data_holder').html(response);
                    }
                });
            }
        }
    </script>
@endsection
