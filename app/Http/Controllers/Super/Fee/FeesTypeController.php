<?php

namespace App\Http\Controllers\Super\Fee;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeesTypeRequest;
use App\Models\AccountCategory;
use App\Models\AccountLedger;
use App\Models\FeesType;
use Illuminate\Http\Request;

class FeesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountLedgers = AccountCategory::get();
        $feesTypes = FeesType::latest()->get();
        return view('superadmin.fee.fees_type', compact('feesTypes', 'accountLedgers'));
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
    public function store(FeesTypeRequest $request)
    {
        FeesType::create($request->all());
        return redirect()->route('fees_type.index')->with('success', 'Created Successfully.');
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
    public function edit(FeesType $feesType)
    {
        $accountLedgers = AccountCategory::get();
        $feesTypes = FeesType::whereNotIn('id', [$feesType->id])->get();
        return view('superadmin.fee.fees_type', compact('feesTypes', 'feesType', 'accountLedgers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeesTypeRequest $request, FeesType $feesType)
    {
        $feesType->update($request->all());
        return redirect()->route('fees_type.index')->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeesType $feesType)
    {
        $feesType->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
