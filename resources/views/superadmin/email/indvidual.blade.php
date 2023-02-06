<form action="{{ route('mailsms.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="individual">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter Email Subject" required>
                <span class="text-danger">@error('title'){{$message}}@enderror</span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label class="form-label">Attachment</label>
                <input type="file" class="form-control-file" name="attachment" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*" required>
                <span class="text-danger">@error('attachment'){{$message}}@enderror</span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label class="form-label">Message To</label>
                <select class="form-control" name="message_to_type" onchange="getData(this.value);" required>
                    <option selected disabled>Please Select</option>
                    @foreach($receivers as $receiver)
                        <option value="{{ $receiver['value'] }}">{{ $receiver['name'] }}</option>
                    @endforeach
                </select>
                <div class="form-group mt-2">
                    <div id="data_holder">

                    </div>
                </div>
                <span class="text-danger">@error('message_to'){{$message}}@enderror</span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label class="form-label">Message</label>
                <textarea name="message_individual">{!! old('message_individual') !!}</textarea>
                <span class="text-danger">@error('message_individual'){{$message}}@enderror</span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">+ Add</button>
        </div>
    </div>
</form>
