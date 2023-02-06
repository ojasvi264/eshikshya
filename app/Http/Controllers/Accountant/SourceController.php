<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSourceRequest;
use App\Http\Requests\UpdateSourceRequest;
use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sourceCreate()
    {
        return view('superadmin.frontoffice.source.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreSourceRequest $request
     * @return \Illuminate\Http\Response
     */
    public function sourceStore(StoreSourceRequest $request)
    {
        $source = Source::where('source', '=', $request->source)
            ->first();
        if ($source === null) {
            $source = new Source();
            $source->source = $request->source;
            $source->description = $request->description;
            $source->save();
            return redirect()->route('accountant.source')->with('success', 'Created successfully');
        }
        else{
            return redirect()->route('accountant.source')->with('error', 'Data already exists.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Source $source
     * @return \Illuminate\Http\Response
     */
    public function sourceShow(Source $source)
    {
        $source = Source::all();
        return view('superadmin.frontoffice.source.index',compact('source'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sourceEdit($id)
    {
        $src = Source::all();
        $source= Source::find($id);
        return view('superadmin/frontoffice/source/edit', ['src'=> $src,'source' => $source]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateSourceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sourceUpdate(UpdateSourceRequest $request)
    {
        $source = Source::where('source', '=', $request->source)
            ->first();
        if ($source === null) {
            $source =Source::find($request->id);
            $source->source = $request->source;
            $source->description = $request->description;
            $source->update();
            return redirect()->route('accountant.source')->with('success', 'Updated successfully');
        }
        else{
            return redirect()->route('accountant.source')->with('error', 'Data already exists.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sourceDestroy($id)
    {
        $source= Source::findOrFail($id);
        $source->delete();
        return redirect()->route('accountant.source')->with('success', 'Deleted successfully');
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
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function show(Source $source)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Source $source)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
        //
    }
}
