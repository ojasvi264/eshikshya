<?php

namespace App\Http\Controllers\Super\Hostel;

use App\Http\Controllers\Controller;
use App\Http\Requests\HostelRequest;
use App\Models\Hostel;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostels = Hostel::all();
        $hostel_types = array('girls','boys','combine');
        return view('superadmin.hostel.index',compact('hostels','hostel_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\HostelRequest  $hostel_request
     * @return \Illuminate\Http\Response
     */
    public function store(HostelRequest $hostel_request)
    {
        $hostel = Hostel::create($hostel_request->all());
        if($hostel){
            return redirect()->route('hostel.index')->with('success', 'Created successfully');
        }else{
            return redirect()->route('hostel.index')->with('error', 'Opps!! somthing went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hostel = Hostel::findOrFail($id);
        $hostel_types = array('girls','boys','combine');
        return view('superadmin.hostel.edit',compact('hostel','hostel_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\HostelRequest  $hostel_request
     * @return \Illuminate\Http\Response
     */
    public function update(HostelRequest $hostel_request)
    {
        $hostel = Hostel::findOrFail($hostel_request->id);
        $hostel->update($hostel_request->all());
        if($hostel){
            return redirect()->route('hostel.index')->with('success', 'Updated successfully');
        }else{
            return redirect()->route('hostel.index')->with('error', 'Opps!! somthing went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hostel = Hostel::findOrFail($id);
        $hostel->update(array('status' => 0));
        if($hostel){
            return redirect()->route('hostel.index')->with('success', 'Deleted successfully');
        }else{
            return redirect()->route('hostel.index')->with('error', 'Opps!! somthing went wrong');
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
        $hostel = Hostel::findOrFail($id);
        $hostel->update(array('status' => 1));
        if($hostel){
            return redirect()->route('hostel.index')->with('success', 'Restored successfully');
        }else{
            return redirect()->route('hostel.index')->with('error', 'Opps!! somthing went wrong');
        }
    }
}
