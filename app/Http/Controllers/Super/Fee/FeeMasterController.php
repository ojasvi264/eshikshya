<?php

namespace App\Http\Controllers\Super\Fee;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeMasterRequest;
use App\Models\FeeGroup;
use App\Models\FeeMaster;
use App\Models\FeesType;
use Illuminate\Http\Request;

class FeeMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeGroups = FeeGroup::all();
        $feesTypes = FeesType::all();
        $feeMasters = FeeMaster::latest()->get();
        return view('superadmin.fee.fee_master', compact('feeGroups', 'feesTypes', 'feeMasters'));
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
    public function store(FeeMasterRequest $request)
    {
        FeeMaster::create($request->all());
        return redirect()->route('fee_master.index')->with('success', 'Created Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeMaster $feeMaster)
    {
        $feeGroups = FeeGroup::all();
        $feesTypes = FeesType::all();
        $feeMasters = FeeMaster::whereNotIn('id', [$feeMaster->id])->get();
        return view('superadmin.fee.fee_master', compact('feeGroups', 'feesTypes', 'feeMasters', 'feeMaster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeeMasterRequest $request, FeeMaster $feeMaster)
    {
        $feeMaster->update($request->all());
        return redirect()->route('fee_master.index')->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeMaster $feeMaster)
    {
        $feeMaster->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
