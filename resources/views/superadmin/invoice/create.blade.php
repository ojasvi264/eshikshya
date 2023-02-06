@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Invoice Create</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Fees</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Invoice Create</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Invoice</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="{{ route('student.invoice.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Class</label>
                                            <select class="form-control select" name="class_id" id="class_id" onchange="getClassSections(this.value);" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('route_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Section</label>
                                            <select class="form-control select" name="section_id" id="section_holder"  onchange="getInvoiceField(this.value);getStudent(this.value);" required>
                                                <option>Please Select Class First</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label" >Student</label>
                                            <select class="form-control select" name="student_id" id="student_id"  required>
                                                <option>Please Select Section First</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Month</label>
                                            <select class="form-control select" name="for_month" id="for_month" required>
                                                <option disabled selected>Please Select</option>
                                                @foreach ($months as  $key => $month)
                                                    <option value="{{ $key+1 }}">{{ $month }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">@error('route_id'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div id="invoice_holder">

                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Discount %</label>
                                            <input type="number" name="discount" value="{{ old('discount') }}" class="form-control">
                                            <span class="text-danger">@error('discount'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Due Date</label>
                                            <input type="date" name="due_date" value="{{ old('due_date') }}" required class="form-control">
                                            <span class="text-danger">@error('due_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">+ Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function getClassSections(class_id) {
            if (class_id !== '') {
                $.ajax({
                    url: '{{ url('/class/sections') }}'+'/'+ class_id ,
                    success: function(response)
                    {
                        jQuery('#section_holder').html(response);
                    }
                });
            }
        }

        function getStudent(section_id) {
            if (section_id !== '') {
                $.ajax({
                    url: '{{ url('/section/students') }}'+'/'+ section_id ,
                    success: function(response)
                    {
                        jQuery('#student_id').html(response);
                    }
                });
            }
        }

        function getInvoiceField(section_id){
            if (section_id !== '') {
                let class_id = $("#class_id option:selected").val();
                $.ajax({
                    url: '{{ url('/get/invoice/field') }}'+'/'+ class_id +'/'+ section_id ,
                    success: function(response)
                    {
                        jQuery('#invoice_holder').html(response);
                    }
                });
            }
        }

        function deleteRow(i){
            document.getElementById('myTable').deleteRow(i)
        }
    </script>
