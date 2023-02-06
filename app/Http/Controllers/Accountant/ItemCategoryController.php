<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Models\ItemCategory;
use App\Http\Requests\StoreItemCategoryRequest;

class ItemCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemCategories = ItemCategory::latest()->get();
        return view('dashboard.pages.inventory.item_category', compact('itemCategories'));
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
    public function store(StoreItemCategoryRequest $request)
    {
        ItemCategory::create($request->all());
        return redirect()->route('accountant.item_category.index')->with('success', 'Created Successfully.');
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
    public function edit(ItemCategory $itemCategory)
    {
        $itemCategories = ItemCategory::whereNotIn('id', [$itemCategory->id])->get();
        return view('dashboard.pages.inventory.item_category', compact('itemCategory', 'itemCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreItemCategoryRequest $request, ItemCategory $itemCategory)
    {
        $itemCategory->update($request->all());
        return redirect()->route('accountant.item_category.index')->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemCategory $itemCategory)
    {
        $itemCategory->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
