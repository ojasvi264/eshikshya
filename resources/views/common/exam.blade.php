<option disabled selected>Please Select</option>
@foreach ($exams as $row)
    <option value="{{ $row->id }}">{{ $row->name }}</option>;
@endforeach
