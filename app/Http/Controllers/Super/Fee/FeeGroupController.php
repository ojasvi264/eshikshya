<?php

namespace App\Http\Controllers\Super\Fee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeGroupRequest;
use App\Models\FeeGroup;
use Illuminate\Http\Request;

class FeeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeGroups = FeeGroup::latest()->get();
        return view('superadmin.fee.fee_group', compact('feeGroups'));
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
    public function store(StoreFeeGroupRequest $request)
    {
        FeeGroup::create($request->all());
        return redirect()->route('fee_group.index')->with('success', 'Created Successfully.');
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
    public function edit(FeeGroup $feeGroup)
    {
        $feeGroups = FeeGroup::whereNotIn('id', [$feeGroup->id])->get();
        return view('superadmin.fee.fee_group', compact('feeGroups', 'feeGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFeeGroupRequest $request, FeeGroup $feeGroup)
    {
        $feeGroup->update($request->all());
        return redirect()->route('fee_group.index')->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeGroup $feeGroup)
    {
        $feeGroup->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
