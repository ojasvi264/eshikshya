<option disabled selected>Please Select</option>
@foreach ($subjects as $row)
    <option value="{{ $row->id }}">{{ $row->name }}</option>;
@endforeach
