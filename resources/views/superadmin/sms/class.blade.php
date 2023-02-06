<form action="{{ route('mailsms.store.sms') }}" method="POST" class="mt-4" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="class">
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
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label class="form-label">Message To</label>
                <select class="form-control" onchange="getClassSections(this.value);" name="class_id" required>
                    <option disabled selected>Please Select</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
                <div class="form-group mt-2">
                    <label class="form-label" >Section</label>
                    <div id="section_holder">

                    </div>
                </div>
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
