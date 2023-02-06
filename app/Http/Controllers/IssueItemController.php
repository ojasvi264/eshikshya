<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIssueItemRequest;
use App\Models\IssueItem;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\ItemStock;
use App\Models\Role;
use App\Models\StaffDirectory;
use Illuminate\Http\Request;

class IssueItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::latest()->get();
        $issueTos = StaffDirectory::where('status', 1)->latest()->get();
        $issueBys = StaffDirectory::where('status', 1)->latest()->get();
        $itemCategories = ItemCategory::latest()->get();
        $items = Item::latest()->get();
        $issueItems = IssueItem::latest()->get();
        return view('dashboard.pages.inventory.issue_item', compact('roles', 'issueBys', 'issueTos', 'itemCategories', 'items', 'issueItems'));
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
    public function store(StoreIssueItemRequest $request)
    {
        $itemStock = ItemStock::where('item_id', $request->item_id)->first();
        $itemStock->quantity = $itemStock->quantity - $request->quantity;
        $itemStock->fill([$itemStock->quantity]);
        $itemStock->save();
        IssueItem::create($request->all());
        return redirect()->route('issue_item.index')->with('success', 'Created successfully');
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
    public function edit(IssueItem $issueItem)
    {
        $issueItems = IssueItem::whereNotIn('id', [$issueItem->id])->get();
        $roles = Role::latest()->get();
        $issueTos = StaffDirectory::where('status', 1)->latest()->get();
        $issueBys = StaffDirectory::where('status', 1)->latest()->get();
        $itemCategories = ItemCategory::latest()->get();
        $items = Item::latest()->get();
        return view('dashboard.pages.inventory.issue_item', compact('issueItems', 'issueItem', 'roles', 'issueTos', 'issueBys', 'itemCategories', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreIssueItemRequest $request, IssueItem $issueItem)
    {
        $issueItem->update($request->all());
        return redirect()->route('issue_item.index')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(IssueItem $issueItem)
    {
        $issueItem->delete();
        return redirect()->back()->with('success', 'Deleted successfully');
    }

    public function returnItem($id){
        $issueReturnedItem = IssueItem::find($id);
        $itemStock = ItemStock::where('item_id', $issueReturnedItem->item_id)->first();
        $itemStock->quantity = $itemStock->quantity + $issueReturnedItem->quantity;
        $itemStock->fill([$itemStock->quantity]);
        $itemStock->save();
        $issueReturnedItem->status = 1;
        $issueReturnedItem->save();
        return response(json_encode($issueReturnedItem));
    }
}
