<form action="{{ route('mailsms.store') }}" method="POST" class="mt-4" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="type" value="class">
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
                {{--                @foreach($receivers as $receiver)--}}
                {{--                    <div class="checkbox">--}}
                {{--                        <label><input type="checkbox" name="message_to[]" value="{{ $receiver['value'] }}"> <b>{{ $receiver['name'] }}</b> </label>--}}
                {{--                    </div>--}}
                {{--                @endforeach--}}
                <span class="text-danger">@error('message_to'){{$message}}@enderror</span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label class="form-label">Message</label>
                <textarea name="message_class">{!! old('message_class') !!}</textarea>
                <span class="text-danger">@error('message_class'){{$message}}@enderror</span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">+ Add</button>
        </div>
    </div>
</form>
