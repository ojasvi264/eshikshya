<?php

namespace App\Http\Controllers\Super\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdmissionInquiryRequest;
use App\Http\Requests\UpdateAdmissionInquiryRequest;
use App\Models\AdmissionInquiry;
use App\Models\Role;
use App\Models\StaffDirectory;
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
        $admissionInquiry = AdmissionInquiry::where('full_name', '=', $request->full_name)
            ->where('phone', '=', $request->phone)
            ->where('source_id', '=', $request->source_id)
            ->first();
        if($admissionInquiry === null){
            AdmissionInquiry::create($request->all());
            return redirect()->back()->with('success', 'Created successfully');
        }
        else {
            return redirect()->back()->with('error', 'Data already exists.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdmissionInquiry  $admissionInquiry
     * @return \Illuminate\Http\Response
     */
    public function admissionInquiryShow(AdmissionInquiry $admissionInquiry)
    {
//        $teacher = DB::table('staff_directories')->join('roles', 'roles.id', '=', 'staff_directories.role_id')
//            ->select('staff_directories.id','staff_directories.name')->where('roles.name', '=', 'Teacher')->get();
        $staffs = new StaffDirectory();
        $teacher = $staffs->whereHas('role', function ($query){
            $query->where('name', 'Teacher');
        });
        $reference= DB::table('references')->select('id','reference')->get();
        $source= DB::table('sources')->select('id','source')->get();
        $class= DB::table('eclasses')->select('id','name')->get();
        $admissionInquiry = AdmissionInquiry::all();
        return view ('superadmin.frontoffice.admissionInquiry.index', ['teacher'=> $teacher->get(), 'reference'=> $reference, 'source'=> $source,'class'=> $class],compact('admissionInquiry'));
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
        $staffs = new StaffDirectory();
        $teacher = $staffs->whereHas('role', function ($query){
            $query->where('name', 'Teacher');
        });
        $reference= DB::table('references')->select('id','reference')->get();
        $source= DB::table('sources')->select('id','source')->get();
        $admission = AdmissionInquiry::all();
        $admissionInquiry = AdmissionInquiry::findOrFail($id);
        return view('superadmin/frontoffice/admissionInquiry/edit', ['class'=> $class,'teacher' => $teacher->get(), 'reference' => $reference,'source' => $source,'admission' => $admission, 'admissionInquiry' => $admissionInquiry]);
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
        $admissionInquiry->source_id = $request->source_id;
        $admissionInquiry->reference_id= $request->reference_id;
        $admissionInquiry->teacher_id= $request->teacher_id;
        $admissionInquiry->class_id = $request->class_id;
        $admissionInquiry->no_of_child = $request->no_of_child;
        $admissionInquiry->update();
        return redirect()->route('admission-inquiry')->with('success', 'Updated successfully');
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
        return redirect()->route('admission-inquiry')->with('success', 'Deleted successfully');
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
