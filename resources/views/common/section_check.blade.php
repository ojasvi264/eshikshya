@foreach($class_sections as $row)
    <div class="checkbox">
        <label><input type="checkbox" name="message_to[]" value="{{ $row->id }}"> <b>{{ $row->name }}</b> </label>
    </div>
@endforeach
