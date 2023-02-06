<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReferenceRequest;
use App\Models\Reference;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function referenceCreate()
    {
        return view('superadmin.frontoffice.reference.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreReferenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function referenceStore(StoreReferenceRequest $request)
    {
        $reference = new Reference();
        $reference->reference = $request->reference;
        $reference->description = $request->description;
        $reference->save();
        return redirect()->route('admin.reference')->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function referenceShow(Reference  $reference)
    {
        $reference = Reference::all();
        return view('superadmin.frontoffice.reference.index',compact('reference'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function referenceEdit($id)
    {
        $ref = Reference::all();
        $reference = Reference::find($id);
        return view('superadmin/frontoffice/reference/edit', ['ref'=> $ref,'reference' => $reference]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function referenceUpdate(Request $request)
    {
        $reference = Reference::where('reference', '=', $request->reference)->first();
        if($reference === null){
            $reference = Reference::find($request->id);
            $reference->reference= $request->reference;
            $reference->description = $request->description;
            $reference->update();
            return redirect()->route('admin.reference')->with('success', 'Updated successfully');
        }
        else {
            return redirect()->route('admin.reference')->with('error', 'Data already exists.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function referenceDestroy($id)
    {
        $reference = Reference::find($id);
        $reference->delete();
        return redirect()->route('admin.reference')->with('success', 'Deleted successfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function show(Reference $reference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function edit(Reference $reference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reference $reference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reference $reference)
    {
        //
    }
}
