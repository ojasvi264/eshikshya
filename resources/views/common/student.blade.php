<option disabled selected>Please Select</option>
@foreach ($students as $student)
    <option value="{{ $student->id }}">{{ $student->fname }}</option>
@endforeach
