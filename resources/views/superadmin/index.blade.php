@extends('layouts.base_temp')
@section('content')
        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3 col-xxl-3 col-sm-6">
                        <div class="widget-stat card bg-primary overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title text-white">Total Students</h3>
                                <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> 422</h5>
                            </div>
                            <div class="card-body text-center mt-3">
                                <div class="ico-sparkline">
                                    <div id="total_students"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-3 col-sm-6">
                        <div class="widget-stat card bg-success overflow-hidden">
                            <div class="card-header">
                                <h3 class="card-title text-white">New Students</h3>
                                <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> 357</h5>
                            </div>
                            <div class="card-body text-center mt-4 p-0">
{{--                                <div class="ico-sparkline">--}}
                                    <div id="new_students"></div>
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-3 col-sm-6">
                        <div class="widget-stat card bg-secondary overflow-hidden">
                            <div class="card-header pb-3">
                                <h3 class="card-title text-white">Total Course</h3>
                                <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> 547</h5>
                            </div>
                            <div class="card-body p-0 mt-2 text-center">
                               <div id="total_course"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-xxl-3 col-sm-6">
                        <div class="widget-stat card bg-danger overflow-hidden">
                            <div class="card-header pb-3">
                                <h3 class="card-title text-white">Fees Collection</h3>
                                <h5 class="text-white mb-0"><i class="fa fa-caret-up"></i> 3280$</h5>
                            </div>
                            <div class="card-body p-0 mt-1 text-center">
                                <div id="fees_collection"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">New Student List </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm mb-0 table-striped">
                                        <thead>
                                        <tr>
                                            <th class="px-5 py-3">Name</th>
                                            <th class="py-3">Email</th>
                                            <th class="py-3">Class</th>
                                            <th class="py-3">Section</th>
                                            <th class="py-3">Date Of Admit</th>
                                            <th class="py-3">Edit</th>
                                        </tr>
                                        </thead>
                                        <tbody id="customers">
                                        @foreach($students as $student)
                                            <tr class="btn-reveal-trigger">
                                                <td class="p-3">
{{--                                                    <a href="javascript:void(0);">--}}
                                                    <div class="media d-flex align-items-center">
                                                        <div class="avatar avatar-xl mr-2">
                                                            <img class="rounded-circle img-fluid"
                                                                 src="{{ $student->profile_image }}" width="30" alt="">
                                                        </div>
                                                        <div class="media-body">
                                                            <h5 class="mb-0 fs--1">{{$student->fname}}</h5>
                                                        </div>
                                                    </div>
{{--                                                    </a>--}}
                                                </td>
                                                <td class="py-2">{{$student->email}}</td>
                                                <td class="py-2">{{$student->class->name}}</td>
                                                <td class="py-2">{{$student->section->name}}</td>
                                                <td class="py-2">{{$student->created_at->format('Y M d')}}</td>
                                                <td>
                                                    <div class="d-flex">
                                                    <a href="{{route('student.edit',$student->id) }}" class="btn btn-sm btn-primary m-1"><i
                                                            class="la la-pencil"></i></a>
{{--                                                    <a href="javascript:void(0);" class="btn btn-sm btn-danger"><i--}}
{{--                                                            class="la la-trash-o"></i></a>--}}
                                                    <form method="post" action="{{route('student.destroy',$student->id)}}" onsubmit="return confirm('Are you sure?')">
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
        <script src="https://omnipotent.net/jquery.sparkline/2.1.2/jquery.sparkline.min.js"></script>
        <script>
            function getSparkLineGraphBlockSize(selector)
            {
                var screenWidth = $(window).width();
                var graphBlockSize = '100%';

                if(screenWidth <= 768)
                {
                    screenWidth = (screenWidth < 300 )?screenWidth:300;

                    var blockWidth  = jQuery(selector).parent().innerWidth() - jQuery(selector).parent().width();

                    blockWidth = Math.abs(blockWidth);

                    var graphBlockSize = screenWidth - blockWidth - 10;
                }



                return graphBlockSize;

            }
            $("#total_students").sparkline([5,6,7,9,9,5,3,2,2,4,6,7], {
                type: 'pie',
                width:130,
                height:130,
            });
            //not more than 20 data
            $("#new_students").sparkline([5,6,7,2,0,-4,-2,4,5,6,7,2,0,-4,-2,4,5,6,7,2], {
                type: "bar",
                height: "160",
                barWidth: 6,
                barSpacing: 7,
                zeroAxis: false,
                barColor: "#2bc155",
            });
            $("#total_course").sparkline([5,6,7,2,0,-4,-2,4,5,6,7,2,0,-4,-2,4,5,6,7,2], {
                type: "bar",
                height: "160",
                barWidth: 6,
                barSpacing: 7,
                barColor: "#2bc155"
            });
            $("#fees_collection").sparkline([5,6,7,9,9,5,3,2,2,4,6,7], {
                type: "line",
                //width: "100%",
                width: getSparkLineGraphBlockSize('#fees_collection'),
                height: "160",
                lineColor: "#6673fd",
                fillColor: "rgba(102, 115, 253, .5)",
                minSpotColor: "#6673fd",
                maxSpotColor: "#6673fd",
                highlightLineColor: "#6673fd",
                highlightSpotColor: "#6673fd",
            });
        </script>
    @endsection
