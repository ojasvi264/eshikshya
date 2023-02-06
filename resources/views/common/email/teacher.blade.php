<select class="form-control select mt-2" name="message_to[]" multiple required>
    @foreach($teachers as $teacher)
        <option value="{{ $teacher->id }}">{{ $teacher->fname }}</option>
    @endforeach
</select>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select').select2({
            width: 'resolve' ,
            theme: "classic"
        });
    });
</script>
