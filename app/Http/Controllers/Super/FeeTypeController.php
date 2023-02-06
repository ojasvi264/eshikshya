<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\FeeType;
use App\Models\Eclass;
use Illuminate\Http\Request;
use App\Http\Requests\FeeTypeRequest;

class FeeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Eclass::all();
        $fee_types = FeeType::all();

        return view('superadmin.fee.index', compact('classes', 'fee_types'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeeType  $feeType
     * @return \Illuminate\Http\Response
     */
    public function show(FeeType $feeType)
    {
        $feetype = FeeType::all();
        return view('dashboard.pages.feetype',compact('feetype'));
    }

    public function store(FeeTypeRequest $request)
    {
        foreach($request->eclasses_ids as $eclasses_id){
            $fee_type = new FeeType();
            $fee_type->eclasses_id = $eclasses_id;
            $fee_type->name = $request->name;
            $fee_type->amount = $request->amount;
            $fee_type->description = $request->description;
            $fee_type->save();
        }
        return redirect()->route('fee.type.index')->with('success', 'Created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeeType  $feeType
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $classes = Eclass::all();
        $fee_type = FeeType::findOrFail($id);
        return view('superadmin.fee.edit', compact('classes', 'fee_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeeTypeRequest  $request
     * @param  \App\Models\FeeType  $feeType
     * @return \Illuminate\Http\Response
     */
    public function update(FeeTypeRequest $request)
    {
        $fee_type = FeeType::findOrFail($request->id);
        $fee_type->update($request->all());
        if($fee_type){
            return redirect()->route('fee.type.index')->with('success', 'Updated successfully');
        }else{
            return redirect()->route('fee.type.index')->with('error', 'Opps!! somthing went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeeType  $feeType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fee_type = FeeType::findOrFail($id);
        $fee_type->update(array('status' => 0));
        if($fee_type){
            return redirect()->route('fee.type.index')->with('success', 'Deleted successfully');
        }else{
            return redirect()->route('fee.type.index')->with('error', 'Opps!! somthing went wrong');
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
        $fee_type = FeeType::findOrFail($id);
        $fee_type->update(array('status' => 1));
        if($fee_type){
            return redirect()->route('fee.type.index')->with('success', 'Restored successfully');
        }else{
            return redirect()->route('fee.type.index')->with('error', 'Opps!! somthing went wrong');
        }
    }

}
