<?php

namespace App\Http\Controllers\Super\Fee;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeDiscountRequest;
use App\Models\FeeDiscount;
use App\Models\FeesType;
use Illuminate\Http\Request;

class FeeDiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feesTypes = FeesType::all();
        $feeDiscounts = FeeDiscount::latest()->get();
        return view('superadmin.fee.fee_discount', compact('feesTypes', 'feeDiscounts'));
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
    public function store(FeeDiscountRequest $request)
    {
        FeeDiscount::create($request->all());
        return redirect()->route('fee_discount.index')->with('success', 'Created Successfully.');

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
    public function edit(FeeDiscount $feeDiscount)
    {
        $feesTypes = FeesType::all();
        $feeDiscounts = FeeDiscount::whereNotIn('id', [$feeDiscount->id])->get();
        return view('superadmin.fee.fee_discount', compact('feesTypes', 'feeDiscounts', 'feeDiscount'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeeDiscountRequest $request, FeeDiscount $feeDiscount)
    {
        $feeDiscount->update($request->all());
        return redirect()->route('fee_discount.index')->with('success', 'Updated Successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeDiscount $feeDiscount)
    {
        $feeDiscount->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
