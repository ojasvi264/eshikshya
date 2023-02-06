<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEclassRequest;
use App\Http\Requests\UpdateEclassRequest;
use App\Models\Eclass;
use Illuminate\Http\Request;

class EclassController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function classCreate()
    {
        return view('superadmin.academics.class.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEclassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function classStore(StoreEclassRequest $request)
    {
        $eclass = Eclass::where('name', '=', $request->name )
            ->where('description', '=', $request->description)
            ->first();
        if($eclass === null){
            $class = new Eclass();
            $class->name = $request->name;
            $class->description = $request->description;
            $class->save();
            return redirect()->back()->with('success', 'Created successfully');
        }
        else{
            return redirect()->back()->with('error', 'Data already exists.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Eclass  $eclass
     * @return \Illuminate\Http\Response
     */
    public function classShow(Eclass $eclass)
    {
        $eclass = Eclass::all();
        return view('superadmin.academics.class.index',compact('eclass'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eclass  $eclass
     * @return \Illuminate\Http\Response
     */
    public function classEdit($id)
    {
        $class = Eclass::all();
        $eclass = Eclass::findOrFail($id);
        return view('superadmin/academics/class/edit', ['eclass' => $eclass,'class' => $class]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEclassRequest  $request
     * @param  \App\Models\Eclass  $eclass
     * @return \Illuminate\Http\Response
     */
    public function classUpdate(UpdateEclassRequest $request)
    {
        $eclass = Eclass::where('name', '=', $request->name )
            ->first();
        if($eclass === null){
            $eclass = Eclass::find($request->id);
            $eclass->name = $request->name;
            $eclass->description = $request->description;
            $eclass->update();
            return redirect()->route('admin.class')->with('success', 'Updated successfully');
        }
        else{
            return redirect()->route('admin.class')->with('error', 'Data already exists.');
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eclass  $eclass
     * @return \Illuminate\Http\Response
     */
    public function classDestroy(Eclass $eclass, $id)
    {
        $eclass = Eclass::findOrFail($id);
        $eclass->delete();
        return redirect()->route('admin.class')->with('success', 'Deleted successfully');
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
     * @param  \App\Models\Eclass  $eclass
     * @return \Illuminate\Http\Response
     */
    public function show(Eclass $eclass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eclass  $eclass
     * @return \Illuminate\Http\Response
     */
    public function edit(Eclass $eclass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Eclass  $eclass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eclass $eclass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eclass  $eclass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eclass $eclass)
    {
        //
    }
}
