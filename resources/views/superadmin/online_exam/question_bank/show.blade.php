@extends('layouts.base_temp')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Question Bank</h4>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('super.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Online Exam</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0);">Question Bank</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-xxl-4 col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <b>Subject :</b> <span class="text-left">{{ $question_bank->subject->name }}</span><br/>
                            <b>Level :</b> <span class="text-left">{{ ucfirst($question_bank->question_level) }}</span><br/>
                            <b>Question Type :</b> <span class="text-left">{{ ucfirst($question_bank->question_type) }}</span><br/>
                            <b>Class :</b> <span class="text-left">{{ $question_bank->class->name }}({{ $question_bank->section->name }})</span><br/>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-xxl-8 col-sm-8">
                    <div class="card">
                        <div class="card-body">
                            <b>Question :</b> <span class="text-left">{{ $question_bank->question }}</span>
                            <hr>
                            @if($question_bank->answers)
                                @if($question_bank->question_type == 'single_choice' || $question_bank->question_type == 'multiple_choice')
                                    @php
                                        $key = 1;
                                    @endphp
                                    @foreach ($question_bank->answers as $question_answer)
                                        <p class="{{ ($question_answer->is_correct_answer == 1) ? 'bg bg-success text-white' : '' }}">Option {{ $key++ }} : <span>{{ $question_answer->answer }}</span></p>
                                    @endforeach
                                @elseif($question_bank->question_type == 'true_or_false' )
                                    <p class="{{ ($question_bank->answers[0]->answer == 'True') ? 'bg bg-success text-white' : '' }}">true</p>
                                    <p class="{{ ($question_bank->answers[0]->answer == 'False') ? 'bg bg-success text-white' : '' }}">false</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
