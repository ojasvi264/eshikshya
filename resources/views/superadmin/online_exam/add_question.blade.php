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
                                    <form action="" method="get">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-label">Search by keyword</label>
                                                    <input type="text" class="form-control" name="keyword">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Question Type</label>
                                                    <select class="form-control" name="question_type" onchange="getAnswerField(this.value)">
                                                        <option disabled selected>Please Select</option>
                                                        @foreach ($question_types as $question_type)
                                                            <option value="{{ $question_type }}">{{ ucfirst($question_type) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label">Question Level</label>
                                                    <select class="form-control" name="question_level" required>
                                                        <option disabled selected>Please Select</option>
                                                        @foreach ($question_levels as $question_level)
                                                            <option value="{{ $question_level }}">{{ ucfirst($question_level) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label" >Class</label>
                                                    <select class="form-control" name="class_id" onchange="getClassSections(this.value);getClassSubject(this.value);">
                                                        <option disabled selected>Please Select</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label" >Section</label>
                                                    <select class="form-control" name="section_id" id="section_holder" required>
                                                        <option>Please Select Class First</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="form-group">
                                                    <label class="form-label" >Subject</label>
                                                    <select class="form-control" name="subject_id" id="subject_holder" required>
                                                        <option>Please Select Class First</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                                <button type="button" class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <table>
                                        @foreach ($question_banks as $key=>$question)
                                            <tr>
                                                <td><input type="checkbox" name="quiestion_ids[]" {{ ($question->id == @$questions[$key]->question_bank_id) ? 'checked' : '' }} class="question_chk" value="{{ $question->id }}">&nbsp;&nbsp;&nbsp;</td>
                                                <td>
                                                    <b>Q.ID {{ $question->id }}</b><br/>
                                                    {{ $question->question }}<br/>
                                                    <b>Marks:</b><input type="text" style="max-width:40px" value="1.00" disabled>
                                                    <b>Negative Marks:</b><input style="max-width:40px" type="text" value="{{ ($online_exam->negative_marking == 1) ? 0.25*1 : '' }}" disabled>
                                                    <b>Question Type:</b> {{ ucfirst($question->question_type) }}
                                                    <b>Level:</b> {{ ucfirst($question->question_level) }}
                                                    <b>Subjec:</b> {{ $question->subject->name }}
                                                </td>
                                            </tr>
                                        @endforeach
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

        function getClassSubject(class_id) {
            if (class_id !== '') {
                $.ajax({
                    url: '{{ url('/class/subjects') }}'+'/'+ class_id ,
                    success: function(response)
                    {
                        jQuery('#subject_holder').html(response);
                    }
                });
            }
        }
        $(document).ready(function () {
            $(document).on('change', '.question_chk', function () {
                var question_bank_id = $(this).val();
                var online_exam_id = "{{  $online_exam->id }}";
                updateCheckbox(question_bank_id, online_exam_id);

            });

            function updateCheckbox(question_bank_id, online_exam_id) {
                let token = "{{ csrf_token()}}";
                let url = "{{ route('online.question.add') }}";
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {_token:token,'question_bank_id': question_bank_id, 'online_exam_id': online_exam_id},
                    beforeSend: function () {

                    },
                    success: function (data) {
                        if (data.status) {
                            alert('Record Saved Successfully');
                        }
                    },
                    error: function (xhr) { // if error occured
                        alert("Error occured.please try again");

                    },
                    complete: function () {

                    },

                });
            }
        });
    </script>
@endsection
