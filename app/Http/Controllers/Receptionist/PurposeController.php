<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Requests\UpdatePurposeRequest;
use App\Models\Purpose;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurposeRequest;

class PurposeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function purposeCreate()
    {
        return view('superadmin.frontoffice.purpose.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StorePurposeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function purposeStore(StorePurposeRequest $request)
    {$purpose = Purpose::where('purpose', '=', $request->purpose)
        ->where('description', '=', $request->description)
        ->first();
        if ($purpose === null) {
            $purpose = new Purpose();
            $purpose->purpose = $request->purpose;
            $purpose->description = $request->description;
            $purpose->save();
            return redirect()->route('receptionist.purpose')->with('success', 'Created successfully');
        }
        else{
            return redirect()->route('receptionist.purpose')->with('error', 'Data already exists.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purpose  $purpose
     * @return \Illuminate\Http\Response
     */
    public function purposeShow(Purpose  $purpose)
    {
        $purpose = Purpose::all();
        return view('superadmin.frontoffice.purpose.index',compact('purpose'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function purposeEdit($id)
    {
        $purp = Purpose::all();
        $purpose = Purpose::find($id);
        return view('superadmin/frontOffice/purpose/edit', ['purp'=> $purp,'purpose' => $purpose]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdatePurposeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function purposeUpdate(UpdatePurposeRequest $request)
    {
        $purpose = Purpose::where('purpose', '=', $request->purpose)
            ->first();
        if ($purpose === null) {
            $purpose = Purpose::find($request->id);
            $purpose->purpose = $request->purpose;
            $purpose->description = $request->description;
            $purpose->update();
            return redirect()->route('receptionist.purpose')->with('success', 'Updated successfully');
        }
        else{
            return redirect()->route('receptionist.purpose')->with('error', 'Data already exists.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function purposeDestroy(Purpose $purpose,$id)
    {
        $purpose= Purpose::findOrFail($id);
        $purpose ->delete();
        return redirect()->route('receptionist.purpose')->with('success', 'Deleted successfully');
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
     * @param  \Illuminate\Http\StorePurposeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurposeRequest $request)
    {

        $purpose = new Purpose();
        $purpose->purpose = $request->purpose;
        $purpose->description = $request->description;
        $purpose->save();
        return $purpose;
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
        //
    }
}
