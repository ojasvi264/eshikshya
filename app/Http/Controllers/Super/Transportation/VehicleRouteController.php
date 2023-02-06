<?php

namespace App\Http\Controllers\Super\Transportation;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRouteRequest;
use App\Models\VehicleRoute;

class VehicleRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = VehicleRoute::all();
        return view('superadmin.transport.vehicle_route.index',compact('routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\VehicleRouteRequest  $vehicle_route_request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleRouteRequest $vehicle_route_request)
    {
        $vehicle_route = VehicleRoute::create($vehicle_route_request->all());
        if($vehicle_route){
            return redirect()->route('vehicle.route.index')->with('success', 'Created successfully');
        }else{
            return redirect()->route('vehicle.route.index')->with('error', 'Opps!! somthing went wrong');
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
        $vehicle_route = VehicleRoute::findOrFail($id);
        return view('superadmin.transport.vehicle_route.edit',compact('vehicle_route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\VehicleRouteRequest  $vehicle_route_request
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleRouteRequest $vehicle_route_request)
    {
        $vehicle_route = VehicleRoute::findOrFail($vehicle_route_request->id);
        $vehicle_route->update($vehicle_route_request->all());
        if($vehicle_route){
            return redirect()->route('vehicle.route.index')->with('success', 'Updated successfully');
        }else{
            return redirect()->route('vehicle.route.index')->with('error', 'Opps!! somthing went wrong');
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
        $vehicle_route = VehicleRoute::findOrFail($id);
        $vehicle_route->update(array('status' => 0));
        if($vehicle_route){
            return redirect()->route('vehicle.route.index')->with('success', 'Deleted successfully');
        }else{
            return redirect()->route('vehicle.route.index')->with('error', 'Opps!! somthing went wrong');
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
        $vehicle_route = VehicleRoute::findOrFail($id);
        $vehicle_route->update(array('status' => 1));
        if($vehicle_route){
            return redirect()->route('vehicle.route.index')->with('success', 'Restored successfully');
        }else{
            return redirect()->route('vehicle.route.index')->with('error', 'Opps!! somthing went wrong');
        }
    }
}
