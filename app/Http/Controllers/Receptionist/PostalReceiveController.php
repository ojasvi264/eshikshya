<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostalReceiveRequest;
use App\Http\Requests\UpdatePostalReceiveRequest;
use App\Models\PostalReceive;
use Illuminate\Http\Request;

class PostalReceiveController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postalReceiveCreate()
    {
        return view('superadmin.frontoffice.postalReceive.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postalReceiveStore(StorePostalReceiveRequest $request)
    {
        $postalReceive = new PostalReceive();
        $postalReceive->from_title= $request->from_title;
        $postalReceive->reference_no= $request->reference_no;
        $postalReceive->address= $request->address;
        $postalReceive->to_title= $request->to_title;
        $postalReceive->postal_receive_date= $request->postal_receive_date;
        $postalReceive->note= $request->note;
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/postalReceive'), $filename);
            $postalReceive['file'] = $filename;
        }
        $postalReceive->save();
        return redirect()->route('receptionist.postal-receive')->with('success', 'Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostalReceive  $postalReceive
     * @return \Illuminate\Http\Response
     */
    public function postalReceiveShow(PostalReceive $postalReceive)
    {
        $postalReceive = PostalReceive::all();
        return view ('superadmin.frontoffice.postalReceive.index', compact('postalReceive'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostalReceive  $postalReceive
     * @return \Illuminate\Http\Response
     */
    public function postalReceiveEdit($id)
    {
        $postReceive = PostalReceive::all();
        $postalReceive = PostalReceive::find($id);
        return view('superadmin/frontoffice/postalReceive/edit', [ 'postReceive'=>$postReceive,'postalReceive'=> $postalReceive]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostalReceive  $postalReceive
     * @return \Illuminate\Http\Response
     */
    public function postalReceiveUpdate(UpdatePostalReceiveRequest $request)
    {
        $postalReceive = PostalReceive::find($request->id);
        $postalReceive->from_title= $request->from_title;
        $postalReceive->reference_no= $request->reference_no;
        $postalReceive->address= $request->address;
        $postalReceive->to_title= $request->to_title;
        $postalReceive->postal_receive_date= $request->postal_receive_date;
        $postalReceive->note= $request->note;
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/postalReceive'), $filename);
            $postalReceive['file'] = $filename;
        }
        $postalReceive->update();
        return redirect()->route('receptionist.postal-receive')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostalReceive  $postalReceive
     * @return \Illuminate\Http\Response
     */
    public function postalReceiveDestroy($id)
    {
        $postalReceive = PostalReceive::findOrFail($id);
        $postalReceive->delete();
        return redirect()->route('receptionist.postal-receive')->with('success', 'Deleted successfully');
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
     * @param  \App\Models\PostalReceive  $postalReceive
     * @return \Illuminate\Http\Response
     */
    public function show(PostalReceive $postalReceive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostalReceive  $postalReceive
     * @return \Illuminate\Http\Response
     */
    public function edit(PostalReceive $postalReceive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostalReceive  $postalReceive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostalReceive $postalReceive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostalReceive  $postalReceive
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostalReceive $postalReceive)
    {
        //
    }
}
