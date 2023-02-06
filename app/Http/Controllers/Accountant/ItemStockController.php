<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Requests\StoreItemStockRequest;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\ItemStock;
use App\Models\ItemStore;
use App\Models\ItemSupplier;
use Illuminate\Http\Request;

class ItemStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemCategories = ItemCategory::latest()->get();
        $items = Item::latest()->get();
        $itemSuppliers = ItemSupplier::latest()->get();
        $itemStores = ItemStore::latest()->get();
        $itemStocks = ItemStock::latest()->get();
        return view('dashboard.pages.inventory.item_stock', compact('itemCategories', 'items', 'itemSuppliers', 'itemStores', 'itemStocks'));
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
    public function store(StoreItemStockRequest $request)
    {
        $itemStock = ItemStock::create($request->all());
        if ($request->file('document')){
            $itemStock->addMedia($request->file('document'))->toMediaCollection();
        }
        return redirect()->route('accountant.item_stock.index')->with('success', 'Created successfully');    }

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
    public function edit(ItemStock $itemStock)
    {
        $itemStocks = ItemStock::whereNotIn('id', [$itemStock->id])->get();
        $itemCategories = ItemCategory::latest()->get();
        $items = Item::latest()->get();
        $itemSuppliers = ItemSupplier::latest()->get();
        $itemStores = ItemStore::latest()->get();
        return view('dashboard.pages.inventory.item_stock', compact('itemStocks', 'itemCategories', 'items', 'itemSuppliers', 'itemStock', 'itemStores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreItemStockRequest $request, ItemStock $itemStock)
    {
        $itemStock->update($request->all());
        if ($request->hasFile('document')){
            $itemStock->clearMediaCollection();
            $itemStock->addMedia($request->file('document'))->toMediaCollection();
        }
        return redirect()->route('accountant.item_stock.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemStock $itemStock)
    {
        if ($itemStock->hasMedia()){
            $itemStock->clearMediaCollection();
        }
        $itemStock->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function getQuantity($id){
        return json_encode(ItemStock::where('item_id', $id)->get());
    }
}
