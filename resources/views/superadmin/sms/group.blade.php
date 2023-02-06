<form action="{{ route('mailsms.store.sms') }}" method="POST" class="mt-4" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="group">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter SMS Subject" required>
                <span class="text-danger">@error('title'){{$message}}@enderror</span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label class="pr20">Send Through<small class="req"> *</small></label>
                <label class="checkbox-inline">
                    <input type="checkbox" value="sms" name="send_through[]">&nbsp;&nbsp;SMS</label>
                <label class="checkbox-inline">
                    <input type="checkbox" value="mobile_app" name="send_through[]">&nbsp;&nbsp;Mobile App</label>
                <span class="text-danger">@error('send_through'){{$message}}@enderror</span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <label class="form-label">Message To</label>
                @foreach($receivers as $receiver)
                    <div class="checkbox">
                        <label><input type="checkbox" name="message_to[]" value="{{ $receiver['value'] }}"> <b>{{ $receiver['name'] }}</b> </label>
                    </div>
                @endforeach
                <span class="text-danger">@error('message_to'){{$message}}@enderror</span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" required>{!! old('message') !!}</textarea>
                <span class="text-danger">@error('message'){{$message}}@enderror</span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">+ Add</button>
        </div>
    </div>
</form>
