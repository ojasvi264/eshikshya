@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Select Questions</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Online Exam</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Select Questions</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="form_one" method="POST">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" >Class</label>
                                                    <select class="form-control" name="class_id" id="class_id" onchange="getClassSections(this.value);">
                                                        <option disabled selected>Please Select</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" >Section</label>
                                                    <select class="form-control" name="section_id" id="section_holder" required>
                                                        <option>Please Select Class First</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div id="student_holder">
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
        function getClassSections(class_id) {
            if (class_id !== '') {
                $.ajax({
                    url: '{{ url('/class/sections') }}'+'/'+ class_id ,
                    success: function(response)
                    {
                        jQuery('#section_holder').html(response);
                    }
                });
            }
        }
        $(document).ready(function () {
            $(document).on('change', '.question_chk', function () {
                var student_id = $(this).val();
                alert(student_id);
                // updateCheckbox(question_bank_id, online_exam_id);

            });

            $("#form_one").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                var class_id = $("#class_id option:selected").val();
                var section_id = $("#section_holder option:selected").val();
                var online_exam_id = "{{ $online_exam->id }}";

                getStudent(class_id, section_id, online_exam_id)
            });

            function  getStudent(class_id, section_id, online_exam_id) {
                let token = "{{ csrf_token()}}";
                let url = "{{ route('get.student') }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {_token:token,'class_id': class_id, 'section_id': section_id, 'online_exam_id': online_exam_id},
                    beforeSend: function () {

                    },
                    success: function (response) {
                        jQuery('#student_holder').html(response);
                    },
                    error: function (xhr) { // if error occured
                        alert("Error occured.please try again");

                    },
                    complete: function () {

                    },

                });
            }

            // $("#select_all").change(function () {  //"select all" change
            //     $(".checkbox").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
            // });


            // $('.checkbox').change(function () {
            //     //uncheck "select all", if one of the listed checkbox item is unchecked
            //     if (false == $(this).prop("checked")) { //if this item is unchecked
            //         $("#select_all").prop('checked', false); //change "select all" checked status to false
            //     }

            //     if ($('.checkbox:checked').length == $('.checkbox').length) {
            //         $("#select_all").prop('checked', true);
            //     }
            // });
        });
    </script>
@endsection
