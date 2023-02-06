<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExaminationType;
use App\Models\ExamSchedule;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exam_types = ExaminationType::all();
        $exams = Exam::whereStatus('1')->get();
        return view('superadmin.exam_schedule.index', compact('exam_types' ,'exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *  @param  $exam_id
     * @return \Illuminate\Http\Response
     */
    public function create($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $subjects = Subject::where('eclasses_id', $exam->eclasses_id)->get();
        return view('superadmin.exam.schedule', compact('exam', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ExamScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam_dates = $request->exam_dates;
        $times = $request->times;
        $total_hours = $request->total_hors;
        $room_numbers = $request->room_numbers;
        $exam = Exam::findOrFail($request->exam_id);
        foreach ($request->subject_ids as $key => $subject_id){
            $exam_schedule = ExamSchedule::where('exam_id', '=', $request->exam_id)
                ->where('subject_id', '=', $subject_id )
                ->where('date', '=', $exam_dates[$key] )
                ->where('time', '=', $times[$key] )
                ->first();
            if($exam_schedule == null) {
                $exam_schedule = new ExamSchedule();
                $exam_schedule->exam_id = $exam->id;
                $exam_schedule->eclasses_id = $exam->id;
                $exam_schedule->subject_id = $subject_id;
                $exam_schedule->date = $exam_dates[$key];
                $exam_schedule->time = $times[$key];
                $exam_schedule->duration = $total_hours[$key];
                $exam_schedule->room_number = $room_numbers[$key];
                $exam_schedule->save();
            }
        }
        return redirect()->route('exam.index')->with('success', 'Added Successfully.');
    }
}
