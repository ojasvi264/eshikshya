<?php

namespace App\Http\Controllers\Super\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostalDispatchRequest;
use App\Http\Requests\UpdatePostalDispatchRequest;
use App\Models\PostalDispatch;
use Illuminate\Support\Facades\Storage;

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
        $fileNames = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $extension = $image->getClientOriginalName();
                $filename = date('YmdHi') . '.' . $extension;
                $image->move(public_path('files/postalDispatch'), $filename);
                $fileNames[] = $filename;
            }
        }
        $postalDispatch->file = json_encode($fileNames);
        $postalDispatch->save();
        return redirect()->back()->with('success', 'Created successfully');
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
        $fileNames = [];
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $image) {
                $extension = $image->getClientOriginalName();
                $filename = date('YmdHi') . '.' . $extension;
                $image->move(public_path('files/postalDispatch'), $filename);
                $fileNames[] = $filename;
            }
        }
        $postalDispatch->file = json_encode($fileNames);
        $postalDispatch->update();
        return redirect()->route('postal-dispatch')->with('success', 'Updated successfully');
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
        return redirect()->route('postal-dispatch')->with('success', 'Deleted successfully');
    }
}
