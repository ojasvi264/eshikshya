<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Eclass;
use App\Models\QuestionBank;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionBankRequest;
use App\Models\QuestionAnswer;
use App\Models\Section;
use App\Models\Subject;

class QuestionBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question_banks = QuestionBank::all();
        return view('superadmin.online_exam.question_bank.index', compact('question_banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Eclass::all();
        $question_types = array('single_choice','multiple_choice','true_or_false','descriptive');
        $question_levels = array('low','medium','high');
        return view('superadmin.online_exam.question_bank.create', compact('classes', 'question_types', 'question_levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\QuestionBankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionBankRequest $request)
    {
        $question_bank = new QuestionBank();
        $question_bank->eclasses_id = $request->class_id;
        $question_bank->section_id = $request->section_id;
        $question_bank->subject_id = $request->subject_id;
        $question_bank->question_type = $request->question_type;
        $question_bank->question_level = $request->question_level;
        $question_bank->question = $request->question;

        if($request->question_type == 'descriptive'){
            $question_bank->save();

        }elseif($request->question_type == 'single_choice' || $request->question_type == 'multiple_choice'){
            if($request->answers){
                if($request->is_correct){
                    $question_bank->save();
                    $is_correct = $request->is_correct;
                    foreach($request->answers as $key=>$answer){
                        $question_answer = new QuestionAnswer();
                        $question_answer->question_bank_id = $question_bank->id;
                        $question_answer->answer = $answer;
                        $question_answer->is_correct_answer = ($is_correct[$key] == "true") ? '1' : '0';
                        $question_answer->save();
                    }
                }else{
                    return redirect()->route('question.bank.create')->with('error', 'Please select correct answer');
                }
            }else{
                return redirect()->route('question.bank.create')->with('error', 'Please input options for question');
            }
        }elseif($request->question_type == 'true_or_false'){
            if($request->is_correct){
                $question_bank->save();
                $question_answer = new QuestionAnswer();
                $question_answer->question_bank_id = $question_bank->id;
                $question_answer->answer = ($request->is_correct == "true") ? 'True' : 'False';;
                $question_answer->is_correct_answer = ($request->is_correct == "true") ? '1' : '0';
                $question_answer->save();
            }else{
                return redirect()->route('question.bank.create')->with('error', 'Please select correct answer');
            }
        }
        return redirect()->route('question.bank.index')->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question_bank = QuestionBank::findOrFail($id);
        return view('superadmin.online_exam.question_bank.show', compact('question_bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question_bank = QuestionBank::findOrFail($id);
        $classes = Eclass::all();
        $sections = Section::all();
        $subjects = Subject::all();
        $question_types = array('single_choice','multiple_choice','true_or_false','descriptive');
        $question_levels = array('low','medium','high');
        return view('superadmin.online_exam.question_bank.edit', compact('question_bank','classes', 'question_types', 'question_levels', 'sections', 'subjects'));
    }

    /**
     * Updates a specified resource
     *
     * @param  \Illuminate\Http\QuestionBankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionBankRequest $request)
    {
        $question_bank = QuestionBank::findOrFail($request->id);
        $question_bank->eclasses_id = $request->class_id;
        $question_bank->section_id = $request->section_id;
        $question_bank->subject_id = $request->subject_id;
        $question_bank->question_level = $request->question_level;
        $question_bank->question = $request->question;

        if($request->question_type == 'descriptive'){
            $question_bank->update();

        }elseif($request->question_type == 'single_choice' || $request->question_type == 'multiple_choice'){
            if($request->answers){
                if($request->is_correct){
                    $question_bank->update();
                    $is_correct = $request->is_correct;
                    $answers = $request->answers;
                    foreach($question_bank->answers as $key=>$answer){
                        $answer->question_bank_id = $question_bank->id;
                        $answer->answer = $answers[$key];
                        $answer->is_correct_answer = ($is_correct[$key] == "true") ? '1' : '0';
                        $answer->update();
                    }
                }else{
                    return redirect()->route('question.bank.index')->with('error', 'Please select correct answer');
                }
            }else{
                return redirect()->route('question.bank.index')->with('error', 'Please input options for question');
            }
        }elseif($request->question_type == 'true_or_false'){
            if($request->is_correct){
                $question_bank->update();
                $answers = $question_bank->answers[0];
                $answers->answer = ($request->is_correct == "true") ? 'True' : 'False';;
                $answers->is_correct_answer = ($request->is_correct == "true") ? '1' : '0';
                $answers->update();
            }else{
                return redirect()->route('question.bank.index')->with('error', 'Please select correct answer');
            }
        }
        return redirect()->route('question.bank.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question_bank = QuestionBank::findOrFail($id);
        $question_bank->update(array('status' => 0));
        if($question_bank){
            return redirect()->route('question.bank.index')->with('success', 'Deleted successfully');
        }else{
            return redirect()->route('question.bank.index')->with('error', 'Opps!! somthing went wrong');
        }
    }


    /**
     * Restre the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $question_bank = QuestionBank::findOrFail($id);
        $question_bank->update(array('status' => 1));
        if($question_bank){
            return redirect()->route('question.bank.index')->with('success', 'Restored successfully');
        }else{
            return redirect()->route('question.bank.index')->with('error', 'Opps!! somthing went wrong');
        }
    }
}
