<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComplainRequest;
use App\Http\Requests\UpdateComplainRequest;
use App\Models\Complain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplainController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complainCreate()
    {
        return view('superadmin.frontoffice.complain.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreComplainRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function complainStore(StoreComplainRequest $request)
    {
        $complain = new Complain();
        $complain->complainType_id=$request->complainType_id;
        $complain->source_id=$request->source_id;
        $complain->complain_by=$request->complain_by;
        $complain->phone=$request->phone;
        $complain->complain_date=$request->complain_date;
        $complain->action_taken=$request->action_taken;
        $complain->assigned=$request->assigned;
        $complain->description=$request->description;
        $complain->note=$request->note;
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/complain'), $filename);
            $complain['file'] = $filename;
        }
        $complain->save();
        return redirect()->route('accountant.complain')->with('success', 'Created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function complainShow(Complain $complain)
    {
        $complainType= DB::table('complain_types')->select('id','complain_type')->get();
        $source= DB::table('sources')->select('id','source')->get();
        $complain = Complain::all();
        return view ('superadmin.frontoffice.complain.index', ['complainType'=>$complainType, 'source'=> $source],compact('complain'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function complainEdit($id)
    {
        $complainType= DB::table('complain_types')->select('id','complain_type')->get();
        $source= DB::table('sources')->select('id','source')->get();
        $comp = Complain::all();
        $complain = Complain::find($id);
        return view('superadmin/frontoffice/complain/edit', ['complainType'=>$complainType, 'source'=> $source, 'comp'=>$comp, 'complain'=> $complain]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function complainUpdate(UpdateComplainRequest $request)
    {
        $complain = Complain::find($request->id);
        $complain->complainType_id=$request->complainType_id;
        $complain->source_id=$request->source_id;
        $complain->complain_by=$request->complain_by;
        $complain->phone=$request->phone;
        $complain->complain_date=$request->complain_date;
        $complain->action_taken=$request->action_taken;
        $complain->assigned=$request->assigned;
        $complain->description=$request->description;
        $complain->note=$request->note;
        if($request->hasfile('file'))
        {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/complain'), $filename);
            $complain['file'] = $filename;
        }
        $complain->update();
        return redirect()->route('accountant.complain')->with('success', 'Updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function complainDestroy(Complain $complain, $id)
    {
        $complain = Complain::findOrFail($id);
        $complain->delete();
        return redirect()->route('accountant.complain')->with('success', 'Deleted successfully');
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
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function show(Complain $complain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function edit(Complain $complain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complain $complain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complain  $complain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complain $complain)
    {
        //
    }
}
