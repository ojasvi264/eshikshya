<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemStore;
use App\Http\Requests\StoreItemStoreRequest;

class ItemStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemStores = ItemStore::latest()->get();
        return view('dashboard.pages.inventory.item_store', compact('itemStores'));
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
    public function store(StoreItemStoreRequest $request)
    {
        ItemStore::create($request->all());
        return redirect()->route('admin.item_store.index')->with('success', 'Created Successfully.');
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
    public function edit(ItemStore $itemStore)
    {
        $itemStores = ItemStore::whereNotIn('id', [$itemStore->id])->get();
        return view('dashboard.pages.inventory.item_store', compact('itemStore', 'itemStores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreItemStoreRequest $request, ItemStore $itemStore)
    {
        $itemStore->update($request->all());
        return redirect()->route('admin.item_store.index')->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemStore $itemStore)
    {
        $itemStore->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
