<?php

namespace App\Http\Controllers\Super\Transportation;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignVehicleRequest;
use App\Models\AssignVehicle;
use App\Models\Vehicle;
use App\Models\VehicleRoute;
use Illuminate\Http\Request;

class AssignVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assigned_vehicles = AssignVehicle::all();
        $routes = VehicleRoute::whereStatus('1')->get();
        $vehicles = Vehicle::whereStatus('1')->get();
        return view('superadmin.transport.assign.index',compact('assigned_vehicles', 'routes', 'vehicles'));

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
    public function store(AssignVehicleRequest $request)
    {
        foreach($request->vehicle_ids as $vehicle_id){
            $assign_vehicle = new AssignVehicle();
            $assign_vehicle->route_id = $request->route_id;
            $assign_vehicle->vehicle_id = $vehicle_id;
            $assign_vehicle->save();
        }

        return redirect()->route('assign.vehicle.index')->with('success', 'Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignVehicle  $assignVehicle
     * @return \Illuminate\Http\Response
     */
    public function show(AssignVehicle $assignVehicle)
    {}




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignVehicle  $assignVehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assigned_vehicle = AssignVehicle::findOrFail($id);
        $routes = VehicleRoute::whereStatus('1')->get();
        $vehicles = Vehicle::whereStatus('1')->get();
        return view('superadmin.transport.assign.edit',compact('assigned_vehicle', 'routes', 'vehicles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AssignVehicle  $assignVehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignVehicle $assignVehicle)
    {
        $assigned_vehicle = AssignVehicle::findOrFail($request->id);
        $assigned_vehicle->update($request->all());
        return redirect()->route('assign.vehicle.index')->with('success', 'Updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assigned_vehicle = AssignVehicle::findOrFail($id);
        $assigned_vehicle->update(array('status' => 0));
        if($assigned_vehicle){
            return redirect()->route('assign.vehicle.index')->with('success', 'Deleted successfully');
        }else{
            return redirect()->route('assign.vehicle.index')->with('error', 'Opps!! somthing went wrong');
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
        $assigned_vehicle = AssignVehicle::findOrFail($id);
        $assigned_vehicle->update(array('status' => 1));
        if($assigned_vehicle){
            return redirect()->route('assign.vehicle.index')->with('success', 'Restored successfully');
        }else{
            return redirect()->route('assign.vehicle.index')->with('error', 'Opps!! somthing went wrong');
        }
    }
}
