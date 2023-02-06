<?php

namespace App\Http\Controllers\Super\Hostel;

use App\Http\Controllers\Controller;
use App\Http\Requests\HostelRoomRequest;
use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\RoomType;

class HostelRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hostel_rooms = HostelRoom::all();
        $hostels = Hostel::whereStatus(1)->get();
        $room_types = RoomType::whereStatus(1)->get();
        return view('superadmin.hostel.room.index',compact('hostel_rooms', 'hostels', 'room_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\HostelRoomRequest  $hostel_room_request
     * @return \Illuminate\Http\Response
     */
    public function store(HostelRoomRequest $hostel_room_request)
    {
        $room = HostelRoom::create($hostel_room_request->all());
        if($room){
            return redirect()->route('hostel.room.index')->with('success', 'Created successfully');
        }else{
            return redirect()->route('hostel.room.index')->with('error', 'Opps!! somthing went wrong');
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
        $room = HostelRoom::findOrFail($id);
        $hostels = Hostel::whereStatus(1)->get();
        $room_types = RoomType::whereStatus(1)->get();
        return view('superadmin.hostel.room.edit',compact('room', 'hostels', 'room_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\HostelRoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(HostelRoomRequest $hostel_room_request)
    {
        $room = HostelRoom::findOrFail($hostel_room_request->id);
        $room->update($hostel_room_request->all());
        if($room){
            return redirect()->route('hostel.room.index')->with('success', 'Updated successfully');
        }else{
            return redirect()->route('hostel.room.index')->with('error', 'Opps!! somthing went wrong');
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
        $room = HostelRoom::findOrFail($id);
        $room->update(array('status' => 0));
        if($room){
            return redirect()->route('hostel.room.index')->with('success', 'Deleted successfully');
        }else{
            return redirect()->route('hostel.room.index')->with('error', 'Opps!! somthing went wrong');
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
        $room = HostelRoom::findOrFail($id);
        $room->update(array('status' => 1));
        if($room){
            return redirect()->route('hostel.room.index')->with('success', 'Restored successfully');
        }else{
            return redirect()->route('hostel.room.index')->with('error', 'Opps!! somthing went wrong');
        }
    }
}
