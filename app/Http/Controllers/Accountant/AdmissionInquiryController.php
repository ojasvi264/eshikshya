<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdmissionInquiryRequest;
use App\Http\Requests\UpdateAdmissionInquiryRequest;
use App\Models\AdmissionInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmissionInquiryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admissionInquiryCreate()
    {
        return view('superadmin.frontoffice.admissionInquiry.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreAdmissionInquiryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function admissionInquiryStore(StoreAdmissionInquiryRequest $request)
    {
        $admissionInquiry = new AdmissionInquiry();
        $admissionInquiry->full_name = $request->full_name;
        $admissionInquiry->phone= $request->phone;
        $admissionInquiry->email= $request->email;
        $admissionInquiry->address= $request->address;
        $admissionInquiry->description= $request->description;
        $admissionInquiry->note= $request->note;
        $admissionInquiry->inquiry_date= $request->inquiry_date;
        $admissionInquiry->follow_up= $request->follow_up;
        $admissionInquiry->teacher_id= $request->teacher_id;
        $admissionInquiry->reference_id= $request->reference_id;
        $admissionInquiry->class_id = $request->class_id;
        $admissionInquiry->source_id = $request->source_id;
        $admissionInquiry->no_of_child = $request->no_of_child;
        $admissionInquiry->save();
        return redirect()->route('accountant.admission-inquiry')->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdmissionInquiry  $admissionInquiry
     * @return \Illuminate\Http\Response
     */
    public function admissionInquiryShow(AdmissionInquiry $admissionInquiry)
    {
        $teacher= DB::table('users')->select('id','name')->where('user_type', '=', 'teacher')->get();
        $reference= DB::table('references')->select('id','reference')->get();
        $source= DB::table('sources')->select('id','source')->get();
        $class= DB::table('eclasses')->select('id','name')->get();
        $admissionInquiry = AdmissionInquiry::all();
        return view ('superadmin.frontoffice.admissionInquiry.index', ['teacher'=> $teacher, 'reference'=> $reference, 'source'=> $source,'class'=> $class],compact('admissionInquiry'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdmissionInquiry  $admissionInquiry
     * @return \Illuminate\Http\Response
     */
    public function admissionInquiryEdit($id)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $teacher= DB::table('users')->select('id','name')->where('user_type', '=', 'teacher')->get();
        $reference= DB::table('references')->select('id','reference')->get();
        $source= DB::table('sources')->select('id','source')->get();
        $admission = AdmissionInquiry::all();
        $admissionInquiry = AdmissionInquiry::findOrFail($id);
        return view('superadmin/frontoffice/admissionInquiry/edit', ['class'=> $class,'teacher' => $teacher, 'reference' => $reference,'source' => $source,'admission' => $admission, 'admissionInquiry' => $admissionInquiry]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateAdmissionInquiryRequest $request
     * @param  \App\Models\AdmissionInquiry  $admissionInquiry
     * @return \Illuminate\Http\Response
     */
    public function admissionInquiryUpdate(UpdateAdmissionInquiryRequest $request)
    {
        $admissionInquiry = AdmissionInquiry::find($request->id);
        $admissionInquiry->full_name = $request->full_name;
        $admissionInquiry->phone= $request->phone;
        $admissionInquiry->email= $request->email;
        $admissionInquiry->address= $request->address;
        $admissionInquiry->description= $request->description;
        $admissionInquiry->note= $request->note;
        $admissionInquiry->inquiry_date= $request->inquiry_date;
        $admissionInquiry->follow_up= $request->follow_up;
        $admissionInquiry->teacher_id= $request->teacher_id;
        $admissionInquiry->reference_id= $request->reference_id;
        $admissionInquiry->class_id = $request->class_id;
        $admissionInquiry->source_id = $request->source_id;
        $admissionInquiry->no_of_child = $request->no_of_child;
        $admissionInquiry->update();
        return redirect()->route('accountant.admission-inquiry')->with('success', 'Updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdmissionInquiry  $admissionInquiry
     * @return \Illuminate\Http\Response
     */
    public function admissionInquiryDestroy(AdmissionInquiry $admissionInquiry, $id)
    {
        $admissionInquiry = AdmissionInquiry::findOrFail($id);
        $admissionInquiry ->delete();
        return redirect()->route('accountant.admission-inquiry')->with('success', 'Deleted successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\AdmissionInquiry  $admissionInquiry
     * @return \Illuminate\Http\Response
     */
    public function show(AdmissionInquiry $admissionInquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdmissionInquiry  $admissionInquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(AdmissionInquiry $admissionInquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdmissionInquiry  $admissionInquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdmissionInquiry $admissionInquiry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdmissionInquiry  $admissionInquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdmissionInquiry $admissionInquiry)
    {
        //
    }
}
