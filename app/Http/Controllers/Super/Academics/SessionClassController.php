<?php

namespace App\Http\Controllers\Super\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSessionClassRequest;
use App\Http\Requests\UpdateSessionClassRequest;
use App\Models\SessionClass;
use Illuminate\Support\Facades\DB;

class SessionClassController extends Controller
{
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
        return view('superadmin.academics.sessionClass.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreSectionClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSessionClassRequest $request)
    {
        $sessionClass = new SessionClass();
        $sessionClass->session_id = $request->session_id;
        $sessionClass->class_id = $request->class_id;
        $sessionClass->section_id = $request->section_id;
        $sessionClass->save();
        return redirect()->back()->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SessionClass  $sessionClass
     * @return \Illuminate\Http\Response
     */
    public function show(SessionClass $sessionClass)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $session= DB::table('sessions')->select('id','session_year')->get();
        $sessionClass = SessionClass::all();
        return view ('superadmin.academics.sessionClass.index', ['class'=> $class,'section'=> $section, 'session'=> $session],compact('sessionClass'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SessionClass  $sessionClass
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $session= DB::table('sessions')->select('id','session_year')->get();
        $ses = SessionClass::all();
        $sessionClass = SessionClass::find($id);
        return view('superadmin/academics/sessionClass/edit', ['class'=> $class,'section' => $section, 'session'=> $session, 'ses' => $ses, 'sessionClass'=> $sessionClass,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SessionClass  $sessionClass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSessionClassRequest $request)
    {
        $sessionClass = SessionClass::find($request->id);
        $sessionClass->session_id = $request->session_id;
        $sessionClass->class_id = $request->class_id;
        $sessionClass->section_id = $request->section_id;
        $sessionClass->update();
        return redirect()->route('session-class')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SessionClass  $sessionClass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sectionClass = SessionClass::findOrFail($id);
        $sectionClass ->delete();
        return redirect()->route('session-class')->with('success', 'Deleted successfully');
    }
}
