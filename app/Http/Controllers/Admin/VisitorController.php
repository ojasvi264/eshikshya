<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VisitorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function visitorCreate()
    {
        return view('superadmin.frontoffice.visitorBook.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreVisitorRequest $request
     * @return \Illuminate\Http\Response
     */
    public function visitorStore(StoreVisitorRequest $request)
    {
        $visitor = new Visitor();
        $visitor->purpose_id = $request->purpose_id;
        $visitor->visitor_name= $request->visitor_name;
        $visitor->phone= $request->phone;
        $visitor->id_card = $request->id_card;
        $visitor->no_of_person= $request->no_of_person;
        $visitor->date= $request->date;
        $visitor->in_time= $request->in_time;
        $visitor->out_time= $request->out_time;
        $visitor->note= $request->note;
        if ($request->hasFile('file')) {
            $img = $request->file('file');
            $extension = $img->getClientOriginalName();
            $filename = date('YmdHi').'.'.$extension;
            $img-> move(public_path('public/images/visitorBook'), $filename);
            $visitor['file'] = $filename;
        }

        $visitor->save();
        return redirect()->route('admin.visitor-book')->with('success', 'Created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function visitorShow(Visitor $visitor)
    {
        $purpose= DB::table('purposes')->select('id','purpose')->get();
        $visitor = Visitor::all();
        return view ('superadmin.frontoffice.visitorBook.index', [ 'purpose'=> $purpose],compact('visitor'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function visitorEdit($id)
    {
        $purpose= DB::table('purposes')->select('id','purpose')->get();
        $visit = Visitor::all();
        $visitor = Visitor::findOrFail($id);
        return view('superadmin/frontoffice/visitorBook/edit', ['purpose'=> $purpose,'visit'=>$visit,'visitor'=>$visitor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function visitorUpdate(UpdateVisitorRequest $request)
    {
        $visitor = Visitor::find($request->id);
        $visitor->purpose_id = $request->purpose_id;
        $visitor->visitor_name= $request->visitor_name;
        $visitor->phone= $request->phone;
        $visitor->id_card = $request->id_card;
        $visitor->no_of_person= $request->no_of_person;
        $visitor->date= $request->date;
        $visitor->in_time= $request->in_time;
        $visitor->out_time= $request->out_time;
        $visitor->note= $request->note;
        $visitor->file= $request->file;
        $visitor->update();
        return redirect()->route('admin.visitor-book')->with('success', 'Updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function visitorDestroy(Visitor $visitor, $id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor ->delete();
        return redirect()->route('admin.visitor-book')->with('success', 'Deleted successfully');
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
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
