@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Book</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Library</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Book</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Add Book</h5>
                        </div>
                        <div class="card-body">
                            @include('includes.dashboard.message')
                            <form action="
                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                        {{isset($book) ? route('admin.book.update', $book) : route('admin.book.store')}}
                                    @elseif(auth()->guard('staff')->user()->role->name == 'Librarian')
                                        {{isset($book) ? route('librarian.book.update', $book) : route('librarian.book.store')}}
                                    @endif
                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                    {{isset($book) ? route('book.update', $book) : route('book.store')}}
                                @endif
                                " method="POST">
                                @csrf
                                @if(isset($book))
                                    @method('PATCH')
                                @endif
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Title</label><span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="title" value='{{old('title')?old('title'):(isset($book) ? $book->title : '')}}' >
                                            <span class="text-danger">@error('title'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Book Number</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="book_number" value='{{old('book_number')?old('book_number'):(isset($book) ? $book->book_number : '')}}' >
                                            <span class="text-danger">@error('book_number'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">ISBN Number</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="isbn_number" value='{{old('isbn_number')?old('isbn_number'):(isset($book) ? $book->isbn_number : '')}}' >
                                            <span class="text-danger">@error('isbn_number'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Publisher</label><span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="publisher" value='{{old('publisher')?old('publisher'):(isset($book) ? $book->publisher : '')}}' >
                                            <span class="text-danger">@error('publisher'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Author</label><span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="author" value='{{old('author')?old('author'):(isset($book) ? $book->author : '')}}' >
                                            <span class="text-danger">@error('author'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Subject<span style="color: red">&#42;</span>
                                            <input type="text" class="form-control" name="subject" value='{{old('subject')?old('subject'):(isset($book) ? $book->subject : '')}}' >
                                            <span class="text-danger">@error('subject'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Rack Number</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="rack_number" value='{{old('rack_number')?old('rack_number'):(isset($book) ? $book->rack_number : '')}}' >
                                            <span class="text-danger">@error('rack_number'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Quantity</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="quantity" value='{{old('quantity')?old('quantity'):(isset($book) ? $book->quantity : '')}}' >
                                            <span class="text-danger">@error('quantity'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Book Price</label><span style="color: red">&#42;</span>
                                            <input type="number" class="form-control" name="book_price" value='{{old('book_price')?old('book_price'):(isset($book) ? $book->book_price : '')}}' >
                                            <span class="text-danger">@error('book_price'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">Post Date</label><span style="color: red">&#42;</span>
                                            <input type="date" class="form-control" name="post_date" value='{{old('post_date')?old('post_date'):(isset($book) ? $book->post_date : '')}}' >
                                            <span class="text-danger">@error('post_date'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label" >Description</label>
                                            <textarea id="mytextarea" class="form-control" name="description">{!! isset($book)?$book->description:(old('description') ?? '') !!}</textarea>
                                            <span class="text-danger">@error('description'){{$message}}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm- mt-2 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">{{isset($book) ? "Update" : "+ Add"}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Book List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example3" class="display" style="min-width: 845px">
                                            <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>ISBN Number</th>
                                                <th>Publisher</th>
                                                <th>Author</th>
                                                <th>Subject</th>
                                                <th>Rack Number</th>
                                                <th>Quantity</th>
                                                <th>Book Price</th>
                                                <th>Post Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($books as $key =>$book)
                                                <tr>
                                                    <td>{{$book->title}}</td>
                                                    <td>{{$book->isbn_number}}</td>
                                                    <td>{{$book->publisher}}</td>
                                                    <td>{{$book->author}}</td>
                                                    <td>{{$book->subject}}</td>
                                                    <td>{{$book->rack_number}}</td>
                                                    <td>{{$book->quantity}}</td>
                                                    <td>{{$book->book_price}}</td>
                                                    <td>{{$book->post_date}}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <a href="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.book.edit', $book)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Librarian')
                                                                        {{route('librarian.book.edit', $book)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('book.edit', $book)}}
                                                                @endif
                                                                " class="btn btn-sm btn-primary m-1"><i class="la la-pencil"></i></a>
                                                            <form action="
                                                                @if(\Illuminate\Support\Facades\Auth::guard('staff')->check())
                                                                    @if(auth()->guard('staff')->user()->role->name == 'Admin')
                                                                        {{route('admin.book.destroy', $book)}}
                                                                    @elseif(auth()->guard('staff')->user()->role->name == 'Librarian')
                                                                        {{route('librarian.book.destroy', $book)}}
                                                                    @endif
                                                                @elseif(\Illuminate\Support\Facades\Auth::user()->user_type == 'superadmin')
                                                                    {{route('book.destroy', $book)}}
                                                                @endif
                                                                " method="post" onsubmit="return confirm('Are you sure?')">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm btn-danger m-1"  data-toggle="modal" data-target="#deleteModal">
                                                                    <i class="la la-trash-o"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


