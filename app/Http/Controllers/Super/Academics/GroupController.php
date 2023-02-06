<?php

namespace App\Http\Controllers\Super\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function groupCreate()
    {
        return redirect('group');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function groupStore(StoreGroupRequest $request)
    {
        $group = Group::where('name', '=', $request->name )
            ->where('eclasses_id', '=', $request->eclasses_id)
            ->where('sections_id', '=', $request->sections_id)
            ->first();
        if ($group === null) {
            $group = new Group();
            $group->name = $request->name;
            $group->eclasses_id = $request->eclasses_id;
            $group->sections_id = $request->sections_id;
            $group->save();
            return redirect()->route('group')->with('success', 'Created successfully');
        }
        else{
            return redirect()->route('group')->with('error', 'Data already exists.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function dropDownShow(Group $group)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $group = Group::all();
        return view ('superadmin.academics.group.index', ['class'=> $class, 'section'=>$section],compact('group'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function groupEdit( $id)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $grp = Group::all();
        $group = Group::find($id);
        return view('superadmin/academics/group/edit', ['class'=> $class,'section' => $section,'grp' => $grp,'group' => $group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupRequest  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function groupUpdate(UpdateGroupRequest $request)
    {
        $group = Group::where('name', '=', $request->name )
            ->where('eclasses_id', '=', $request->eclasses_id)
            ->where('sections_id', '=', $request->sections_id)
            ->first();
        if ($group === null) {
            $group = Group::find($request->id);
            $group->name = $request->name;
            $group->eclasses_id = $request->eclasses_id;
            $group->sections_id = $request->sections_id;
            $group->update();
            return redirect('group/view')->with('success', 'Updated successfully');
        }
        else{
            return redirect('group/view')->with('error', 'Data already exists.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function groupDestroy(Group $group, $id)
    {
        $group = Group::findOrFail($id);
        $group ->delete();
        return redirect('group/view')->with('success', 'Deleted successfully.');
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
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
    public function getGroups($id)
    {
        return json_encode(DB::table('groups')->where('eclasses_id', $id)->get());
    }
}
