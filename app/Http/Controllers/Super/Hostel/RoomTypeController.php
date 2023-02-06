<?php

namespace App\Http\Controllers\Super\Hostel;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomTypeRequest;
use App\Models\RoomType;


class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_types = RoomType::all();
        return view('superadmin.hostel.room_type.index',compact('room_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RoomTypeRequest  $room_type_request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomTypeRequest $room_type_request)
    {
        $room_type = RoomType::create($room_type_request->all());
        if($room_type){
            return redirect()->route('hostel.room_type.index')->with('success', 'Created successfully');
        }else{
            return redirect()->route('hostel.room_type.index')->with('error', 'Opps!! somthing went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room_type = RoomType::findOrFail($id);
        return view('superadmin.hostel.room_type.edit',compact('room_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RoomTypeRequest  $room_type_request
     * @return \Illuminate\Http\Response
     */
    public function update(RoomTypeRequest $room_type_request)
    {
        $room_type = RoomType::findOrFail($room_type_request->id);
        $room_type->update($room_type_request->all());
        if($room_type){
            return redirect()->route('hostel.room_type.index')->with('success', 'Updated successfully');
        }else{
            return redirect()->route('hostel.room_type.index')->with('error', 'Opps!! somthing went wrong');
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
        $room_type = RoomType::findOrFail($id);
        $room_type->update(array('status' => 0));
        if($room_type){
            return redirect()->route('hostel.room_type.index')->with('success', 'Deleted successfully');
        }else{
            return redirect()->route('hostel.room_type.index')->with('error', 'Opps!! somthing went wrong');
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
        $room_type = RoomType::findOrFail($id);
        $room_type->update(array('status' => 1));
        if($room_type){
            return redirect()->route('hostel.room_type.index')->with('success', 'Restored successfully');
        }else{
            return redirect()->route('hostel.room_type.index')->with('error', 'Opps!! somthing went wrong');
        }
    }
}
