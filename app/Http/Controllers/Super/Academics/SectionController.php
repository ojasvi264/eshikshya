<?php

namespace App\Http\Controllers\Super\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sectionCreate()
    {
        return redirect('superadmin.academics.section.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function sectionStore(StoreSectionRequest $request)
    {
        $section = Section::where('name', '=', $request->name )
            ->where('eclasses_id', '=', $request->eclasses_id)
            ->first();
        if ($section === null) {
            $section = new Section();
            $section->name = $request->name;
            $section->eclasses_id = $request->eclasses_id;
            $section->save();
            return redirect()->back()->with('success', 'Created successfully');
        }
        else{
            return redirect()->back()->with('error', 'Data already exists.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function classDropDownShow(Section $section)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section = Section::all();
        return view ('superadmin.academics.section.index', ['class'=> $class],compact('section'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function sectionEdit($id)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $sec = Section::all();
        $section = Section::find($id);
        return view('superadmin/academics/section/edit', ['class'=> $class,'section' => $section,'sec' => $sec]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSectionRequest  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function sectionUpdate(UpdateSectionRequest $request)
    {
        $section = Section::where('name', '=', $request->name )
            ->where('eclasses_id', '=', $request->eclasses_id)
            ->first();
        if ($section === null) {
            $section = Section::find($request->id);
            $section ->name = $request->name;
            $section ->eclasses_id = $request->eclasses_id;
            $section ->update();
            return redirect()->route('section')->with('success', 'Updated successfully');
        }
        else{
            return redirect()->route('section')->with('error', 'Data already exists.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function sectionDestroy(Section $section, $id)
    {
        $section = Section::findOrFail($id);
        $section ->delete();
        return redirect()->route('section')->with('success', 'Deleted successfully');
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
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
    public function getSections($id)
    {
        return json_encode(DB::table('sections')->where('eclasses_id', $id)->get());
    }
}
