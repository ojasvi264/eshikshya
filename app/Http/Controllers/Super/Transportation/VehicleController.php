<?php

namespace App\Http\Controllers\Super\Transportation;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('superadmin.transport.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleRequest $vehicle_request)
    {
        $vehicle = Vehicle::create($vehicle_request->all());
        if($vehicle){
            return redirect()->route('vehicle.index')->with('success', 'Created successfully');
        }else{
            return redirect()->route('vehicle.index')->with('error', 'Opps!! somthing went wrong');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {}

    /**
     * Show the form for editing the specified resource.
     *

     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('superadmin.transport.vehicle.edit', compact('vehicle'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleRequest $request)
    {
        $vehicle = Vehicle::findOrFail($request->id);
        $vehicle->update($request->all());
        if($vehicle){
            return redirect()->route('vehicle.index')->with('success', 'Updated successfully');
        }else{
            return redirect()->route('vehicle.index')->with('error', 'Opps!! somthing went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update(array('status' => 0));
        if($vehicle){
            return redirect()->route('vehicle.index')->with('success', 'Deleted successfully');
        }else{
            return redirect()->route('vehicle.index')->with('error', 'Opps!! somthing went wrong');
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
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update(array('status' => 1));
        if($vehicle){
            return redirect()->route('vehicle.index')->with('success', 'Restored successfully');
        }else{
            return redirect()->route('vehicle.index')->with('error', 'Opps!! somthing went wrong');
        }
    }
}
