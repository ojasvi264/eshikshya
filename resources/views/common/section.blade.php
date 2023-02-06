<option disabled selected>Please Select</option>
@foreach ($class_sections as $row)
    <option value="{{ $row->id }}">{{ $row->name }}</option>;
@endforeach
