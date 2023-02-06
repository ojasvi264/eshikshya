<?php

namespace App\Http\Controllers\Super\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplainTypeRequest;
use App\Http\Requests\UpdateComplainTypeRequest;
use App\Models\ComplainType;
use Illuminate\Http\Request;

class ComplainTypeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complainTypeCreate()
    {
        return view('superadmin.frontoffice.complainType.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreComplainTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function complainTypeStore(StoreComplainTypeRequest $request)
    {
        $complaintype= new ComplainType();
        $complaintype->complain_type = $request->complain_type;
        $complaintype->description = $request->description;
        $complaintype->save();
        return redirect()->route('complain-type')->with('success', 'Created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplainType  $complaintype
     * @return \Illuminate\Http\Response
     */
    public function complainTypeShow(ComplainType $complaintype)
    {
        $complaintype = ComplainType::all();
        return view('superadmin.frontoffice.complainType.index',compact('complaintype'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complainTypeEdit($id)
    {
        $complain = ComplainType::all();
        $complainType = ComplainType::find($id);
        return view('superadmin/frontoffice/complainType/Edit', ['complain'=> $complain,'complainType' => $complainType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateComplainTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complainTypeUpdate(UpdateComplainTypeRequest $request)
    {
        $complainType = ComplainType::where('complain_type', $request->complain_type)->first();
        if ($complainType === null) {
            $complainType = ComplainType::find($request->id);
            $complainType->complain_type = $request->complain_type;
            $complainType->description = $request->description;
            $complainType->update();
            return redirect()->route('complain-type')->with('success', 'Updated successfully');
        }
        else{
            return redirect()->route('complain-type')->with('error', 'Data already exists.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complainTypeDestroy($id)
    {
        $complainType = ComplainType::find($id);
        $complainType->delete();
        return redirect()->route('complain-type')->with('success', 'Deleted successfully');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
