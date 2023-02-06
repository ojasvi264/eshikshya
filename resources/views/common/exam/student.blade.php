<hr>
<h3>Assign Online Exam</h3>
<hr>
<div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-9">
        <form method="post" action="{{ route('online.assign.student') }}" id="assign_form">
            @csrf
            <input type="hidden" name="online_exam_id" value="{{ $online_exam->id }}">
            <table class="table table-bordered">
                <thead class="bg bg-primary text-white">
                <td></td>
                <th>Admission No</th>
                <th>Student Name</th>
                <th>Class</th>
                <th>Gender</th>
                </thead>
                <tbody>
                @foreach($students as $key => $student)
                    <tr>
                        <td>
                            <input class="checkbox" type="checkbox" {{ ($student->id == @$assingned_studes[$key]->student_id) ? 'checked' : '' }} name="students_ids[]" value="{{ $student->id }}" autocomplete="off">
                        </td>
                        <td>{{  $student->id }}</td>
                        <td>{{  $student->fname }}</td>
                        <td>{{  $student->class->name }}({{ $student->section->name }})</td>
                        <td>{{ $student->gender }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">+ Add</button>
            </div>
        </form>
    </div>
</div>

