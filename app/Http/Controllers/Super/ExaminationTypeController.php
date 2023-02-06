<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExaminationTypeRequest;
use App\Http\Requests\UpdateExaminationTypeRequest;
use App\Models\ExaminationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExaminationTypeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function examinationCreate()
    {
        return view('superadmin.examination.examType.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreExaminationTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function examinationStore(StoreExaminationTypeRequest $request)
    {
        $examinationType = ExaminationType::where('exam_type', '=', $request->exam_type)
            ->where('description', '=', $request->description)
            ->first();
        if ($examinationType === null) {
            $examinationType = new ExaminationType();
            $examinationType->exam_type = $request->exam_type;
            $examinationType->description = $request->description;
            $examinationType->save();
            return redirect()->route('exam-type')->with('success', 'Created successfully');
        }
        else{
            return redirect()->route('exam-type')->with('error', 'Data already exists.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExaminationType  $examinationType
     * @return \Illuminate\Http\Response
     */
    public function examinationShow(ExaminationType $examinationType)
    {
        $examinationType= ExaminationType::all();
        return view('superadmin.examination.examType.index',compact('examinationType'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExaminationType  $examinationType
     * @return \Illuminate\Http\Response
     */
    public function examinationEdit($id)
    {
        $examType = ExaminationType::all();
        $examinationType = ExaminationType::findOrFail($id);
        return view('superadmin/examination/examType/edit', ['examType'=> $examType,'examinationType' => $examinationType]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExaminationType  $examinationType
     * @return \Illuminate\Http\Response
     */
    public function examinationUpdate(UpdateExaminationTypeRequest $request)
    {
        $examinationType = ExaminationType::where('exam_type', '=', $request->exam_type)
            ->where('description', '=', $request->description)
            ->first();
        if ($examinationType === null) {
            $examinationType = ExaminationType::findOrFail($request->id);
            $examinationType->exam_type = $request->exam_type;
            $examinationType->description = $request->description;
            $examinationType->update();
            return redirect()->route('exam-type')->with('success', 'Updated successfully');
        }
        else{
            return redirect()->route('exam-type')->with('error', 'Data already exists.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExaminationType  $examinationType
     * @return \Illuminate\Http\Response
     */
    public function examinationDestroy($id)
    {
        $examinationType= ExaminationType::findOrFail($id);
        $examinationType->delete();
        return redirect()->route('exam-type')->with('success', 'Deleted successfully');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examinationType= DB::table('examination_types')
            ->select('examination_types.id as examination_type_id' ,'examination_types.exam_type as examination_type','examination_types.description as examination_type_description')
            ->get();
        return response()->json($examinationType);
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
     * @param  \Illuminate\Http\StoreExaminationTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExaminationTypeRequest $request)
    {
        $examinationtype = new ExaminationType();
        $examinationtype ->exam_type = $request->exam_type;
        $examinationtype ->description = $request->description;
        $examinationtype->save();
        return $examinationtype;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExaminationType  $examinationType
     * @return \Illuminate\Http\Response
     */
    public function show(ExaminationType $examinationType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExaminationType  $examinationType
     * @return \Illuminate\Http\Response
     */
    public function edit(ExaminationType $examinationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExaminationType  $examinationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExaminationType $examinationType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExaminationType  $examinationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExaminationType $examinationType)
    {
        //
    }
}
