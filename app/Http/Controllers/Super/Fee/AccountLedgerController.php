<?php

namespace App\Http\Controllers\Super\Fee;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountLedgerRequest;
use App\Models\AccountLedger;
use Illuminate\Http\Request;

class AccountLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountLedgers = AccountLedger::latest()->get();
        return view('superadmin.fee.account_ledger', compact('accountLedgers'));
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
    public function store(AccountLedgerRequest $request)
    {
        AccountLedger::create($request->all());
        return redirect()->route('account_ledger.index')->with('success', 'Created Successfully.');
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
    public function edit(AccountLedger $accountLedger)
    {
        $accountLedgers = AccountLedger::whereNotIn('id', [$accountLedger->id])->get();
        return view('superadmin.fee.account_ledger', compact('accountLedgers', 'accountLedger'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountLedgerRequest $request, AccountLedger $accountLedger)
    {
        $accountLedger->update($request->all());
        return redirect()->route('account_ledger.index')->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountLedger $accountLedger)
    {
        $accountLedger->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}
