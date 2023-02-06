<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemSupplierRequest;
use App\Models\ItemSupplier;

class ItemSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemSuppliers = ItemSupplier::latest()->get();
        return view('dashboard.pages.inventory.item_supplier', compact('itemSuppliers'));
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
    public function store(StoreItemSupplierRequest $request)
    {
        ItemSupplier::create($request->all());
        return redirect()->route('admin.item_supplier.index')->with('success', 'Created Successfully.');
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
    public function edit(ItemSupplier $itemSupplier)
    {
        $itemSuppliers = ItemSupplier::whereNotIn('id', [$itemSupplier->id])->get();
        return view('dashboard.pages.inventory.item_supplier', compact('itemSupplier', 'itemSuppliers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreItemSupplierRequest $request, ItemSupplier $itemSupplier)
    {
        $itemSupplier->update($request->all());
        return redirect()->route('admin.item_supplier.index')->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemSupplier $itemSupplier)
    {
        $itemSupplier->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
