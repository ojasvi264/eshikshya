<?php

namespace App\Http\Controllers;

use App\Models\Eclass;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\FeeType;
use App\Models\Guardian;
use App\Models\OnlineExam;
use App\Models\OnlineExamQuestion;
use App\Models\OnlineExamStudent;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class CommonController extends Controller
{
    public function getClassSectionInDropDown($id)
    {
        $class = Eclass::find($id);
        $class_sections = Section::where('eclasses_id', $class->id)->get();
        $view = view('common.section',compact('class_sections'));
        echo $view;
    }

    public function getExam($exam_type_id){
        echo $exam_type_id;
        $exams = Exam::where('exam_type_id', $exam_type_id)->where('status','1')->get();
        $view = view('common.exam',compact('exams'));
        echo $view;
    }

    public function getClassSectionInCheckbox($id)
    {
        $class = Eclass::find($id);
        $class_sections = Section::where('eclasses_id', $class->id)->get();
        $view = view('common.section_check',compact('class_sections'));
        echo $view;
    }


    function getClassSubjects($id)
    {
        $class = Eclass::find($id);
        $subjects = Subject::where('eclasses_id', $class->id)->get();
        $view = view('common.subject',compact('subjects'));
        echo $view;
    }

    function getClassSubjectInDropDown($id, $exam_id)
    {
        $class = Eclass::find($id);
        $exam = Exam::find($exam_id);
        $subject_ids = ExamSchedule::where('exam_id', $exam->id)->where('eclasses_id', $exam->eclasses_id)->plucK('subject_id')->toArray();
        $subjects = Subject::where('eclasses_id', $class->id)->whereIn('id', $subject_ids)->get();
        $view = view('common.subject',compact('subjects'));
        echo $view;
    }

    function getClassSectionInDropDownByExam($class_id, $exam_id){
        $class = Eclass::find($class_id);
        $exam = Exam::where('id',$exam_id)->where('eclasses_id', $class->id)->first();
        $class_sections = Section::where('id', $exam->section_id)->get();
        $view = view('common.section',compact('class_sections'));
        echo $view;
    }

    function getSubjectField($section_id){
        if($section_id != ''){
            $view = view('examination.table');
            echo $view;
        }
    }

    function getAnswerField($question_type){
        if($question_type != 'descriptive'){
            //echo $question_type;
            if($question_type == 'single_choice'){
                $view = view('common.answer.single');
                echo $view;
            }elseif($question_type == 'true_or_false'){
                $view = view('common.answer.true_or_false');
                echo $view;
            }elseif($question_type == 'multiple_choice'){
                $view = view('common.answer.multiple_choice');
                echo $view;
            }
        }
    }

    public function questionAdd(Request $request){
        $check_exits = OnlineExamQuestion::where('question_bank_id', $request->question_bank_id)->where('online_exam_id', $request->online_exam_id)->first();
        if($check_exits){
            $check_exits->delete();
            return response()->json([
                'status' => '1',
            ]);
        }else{
            $online_exam_question = OnlineExamQuestion::create($request->all());
            if($online_exam_question){
                return response()->json([
                    'status' => '1',
                ]);
            }else{
                return response()->json([
                    'status' => '0',
                ]);
            }
        }

    }

    public function getStudent(Request $request){
        $students = Student::where('class_id', $request->class_id)->where('section_id', $request->section_id)->get();
        $online_exam = OnlineExam::findOrFail($request->online_exam_id);
        $assingned_studes = OnlineExamStudent::where('online_exam_id', $request->online_exam_id)->get();
        $view = view('common.exam.student', compact('students','online_exam', 'assingned_studes'));
        echo $view;
    }

    public function assignStudent(Request $request){
        foreach ($request->students_ids as $student_id) {
            $exist = OnlineExamStudent::where('online_exam_id', $request->online_exam_id)->where('student_id', $student_id)->first();
            if(!$exist){
                $online_exam = new OnlineExamStudent();
                $online_exam->online_exam_id = $request->online_exam_id;
                $online_exam->student_id = $student_id;
                $online_exam->save();
            }
        }
        return redirect()->route('online.exam.index')->with('success', 'Created successfully');
    }

    public function getStudentBySection($section_id){
        $students = Student::where('section_id', $section_id)->get();
        $view = view('common.student', compact('students'));
        echo $view;
    }

    public function getInvoiceField($class_id, $section_id){
        $class = Eclass::find($class_id);
        $fee_types = FeeType::whereStatus('1')->where('eclasses_id', $class->id)->get();
        $view = view('common.invoice_table', compact('fee_types'));
        echo $view;
    }

    public function getData($message_to_type){
        //echo $message_to_type;
        if($message_to_type == 1){
            $students = Student::all();
            $view = view('common.email.student', compact('students'));
            echo $view;
        }elseif ($message_to_type ==2){
            $parents = Guardian::all();
            $view = view('common.email.parent', compact('parents'));
            echo $view;
        }elseif ($message_to_type == 4){
            $teachers = Teacher::all();
            $view = view('common.email.teacher', compact('teachers'));
            echo $view;
        }
    }

    public function getExams($class_id)
    {
        return json_encode(DB::table('exams')->where('status', 1)->where('eclasses_id', $class_id)->get());
    }

    public function getSchedules(Request $request){
        $exam_schedules =  DB::table('exam_schedules')
            ->select('subjects.name', 'exam_schedules.date' , 'exam_schedules.time', 'exam_schedules.duration', 'exam_schedules.room_number')
            ->join('subjects', 'exam_schedules.subject_id', '=', 'subjects.id')
            ->join('exams', 'exams.id', '=', 'exam_schedules.exam_id')
            ->where('exam_schedules.exam_id', $request->exam_id)
            ->get();
        $view = view('common.exam_schedule.table', compact('exam_schedules'));
        echo $view;
    }
}
