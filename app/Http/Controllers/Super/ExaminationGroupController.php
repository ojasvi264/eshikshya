<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExaminationGroupRequest;
use App\Http\Requests\UpdateExaminationGroupRequest;
use App\Models\ExaminationGroup;
use App\Models\ExaminationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExaminationGroupController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function examinationGroupCreate()
    {
        return view('superadmin.examination.examGroup.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreExaminationGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function examinationStore(StoreExaminationGroupRequest $request)
    {
        $examinationGroup = ExaminationGroup::where('exam_name', '=', $request->exam_name)
            ->where('examType_id', '=', $request->examType_id)
            ->where('description', '=', $request->description)
            ->first();
        if ($examinationGroup === null) {
            $examinationGroup = new ExaminationGroup();
            $examinationGroup->exam_name = $request->exam_name;
            $examinationGroup->examType_id = $request->examType_id;
            $examinationGroup->description = $request->description;
            $examinationGroup->save();
            return redirect()->route('exam-group')->with('success', 'Created successfully');
        }
        else{
            return redirect()->route('exam-group')->with('error', 'Data already exists.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExaminationGroup  $examinationGroup
     * @return \Illuminate\Http\Response
     */
    public function dropDownShow(ExaminationGroup  $examinationGroup)
    {
        $type = ExaminationType::select('id','exam_type')->get();
        $examinationGroup = ExaminationGroup::all();
        return view ('superadmin.examination.examGroup.index', ['type'=> $type],compact('examinationGroup'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExaminationGroup  $examinationGroup
     * @return \Illuminate\Http\Response
     */
    public function examinationGroupAssign($id)
    {
        return view ('dashboard.pages.test');
        /*        $type= DB::table('examination_types')->select('id','exam_type')->get();
                $examinationGrp = ExaminationGroup::all();
                $examinationGroup = ExaminationGroup::find($id);
                return view ('dashboard.pages.examGroupSubjectAssign', ['type'=> $type, 'examinationGrp'=> $examinationGrp, 'examinationGroup' =>$examinationGroup],);*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExaminationGroup  $examinationGroup
     * @return \Illuminate\Http\Response
     */
    public function examinationGroupEdit($id)
    {
        $type= DB::table('examination_types')->select('id','exam_type')->get();
        $examinationGrp = ExaminationGroup::all();
        $examinationGroup = ExaminationGroup::find($id);
        return view ('superadmin/examination/examGroup/edit', ['type'=> $type, 'examinationGrp'=> $examinationGrp, 'examinationGroup' =>$examinationGroup],);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExaminationGroup  $examinationGroup
     * @return \Illuminate\Http\Response
     */
    public function examinationGroupUpdate(UpdateExaminationGroupRequest $request)
    {
        $examinationGroup = ExaminationGroup::where('exam_name', '=', $request->exam_name)
            ->where('examType_id', '=', $request->examType_id)
            ->where('description', '=', $request->description)
            ->first();
        if ($examinationGroup === null) {
            $examinationGroup = new ExaminationGroup();
            $examinationGroup->exam_name = $request->exam_name;
            $examinationGroup->examType_id = $request->examType_id;
            $examinationGroup->description = $request->description;
            $examinationGroup->update();
            return redirect()->route('exam-group')->with('success', 'Updated successfully');
        }
        else{
            return redirect()->route('exam-group')->with('error', 'Data already exists.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExaminationGroup  $examinationGroup
     * @return \Illuminate\Http\Response
     */
    public function examinationGroupDestroy($id)
    {
        $examinationGroup= ExaminationGroup::findOrFail($id);
        $examinationGroup->delete();
        return redirect()->route('exam-group')->with('success', 'Deleted successfully');
    }

    /**s
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExaminationGroup $examinationGroup)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        return view ('dashboard.pages.test', ['class'=> $class, 'section'=>$section]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExaminationGroup  $examinationGroup
     * @return \Illuminate\Http\Response
     */
    public function show(ExaminationGroup $examinationGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExaminationGroup  $examinationGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(ExaminationGroup $examinationGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExaminationGroup  $examinationGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExaminationGroup $examinationGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExaminationGroup  $examinationGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExaminationGroup $examinationGroup)
    {
        //
    }
    public function getExam($id)
    {
        return json_encode(DB::table('examination_groups')->where('examType_id', $id)->get());
    }
}
