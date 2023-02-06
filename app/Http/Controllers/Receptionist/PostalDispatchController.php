<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostalDispatchRequest;
use App\Http\Requests\UpdatePostalDispatchRequest;
use App\Models\PostalDispatch;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PostalDispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin.frontoffice.postalDispatch.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostalDispatchRequest $request)
    {

        $postalDispatch = New PostalDispatch();
        $postalDispatch->to_title = $request->to_title;
        $postalDispatch->reference_no = $request->reference_no;
        $postalDispatch->address = $request->address;
        $postalDispatch->note = $request->note;
        $postalDispatch->from_title = $request->from_title;
        $postalDispatch->date = $request->date;
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/postalDispatch'), $filename);
            $postalDispatch['file'] = $filename;
        }
        $postalDispatch->save();
        return redirect()->route('receptionist.postal-dispatch')->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostalDispatch  $postalDispatch
     * @return \Illuminate\Http\Response
     */
    public function show(PostalDispatch $postalDispatch)
    {
        $postalDispatch = PostalDispatch::all();
        return view('superadmin.frontoffice.postalDispatch.index',compact('postalDispatch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostalDispatch  $postalDispatch
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $postDispatch = PostalDispatch::all();
        $postalDispatch = PostalDispatch::find($id);
        return view('superadmin/frontoffice/postalDispatch/edit', [ 'postDispatch'=>$postDispatch,'postalDispatch'=> $postalDispatch]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostalDispatch  $postalDispatch
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostalDispatchRequest $request)
    {
        $postalDispatch = PostalDispatch::find($request->id);
        $postalDispatch->to_title = $request->to_title;
        $postalDispatch->reference_no = $request->reference_no;
        $postalDispatch->address = $request->address;
        $postalDispatch->note = $request->note;
        $postalDispatch->from_title = $request->from_title;
        $postalDispatch->date = $request->date;
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/postalDispatch'), $filename);
            $postalDispatch['file'] = $filename;
        }
        $postalDispatch->update();
        return redirect()->route('receptionist.postal-dispatch')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostalDispatch  $postalDispatch
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postalDispatch = PostalDispatch::find($id);
        $postalDispatch->delete();
        return redirect()->route('receptionist.postal-dispatch')->with('success', 'Deleted successfully');
    }
}
