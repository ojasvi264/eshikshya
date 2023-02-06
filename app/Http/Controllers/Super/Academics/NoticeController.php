<?php

namespace App\Http\Controllers\Super\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Models\Notice;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class NoticeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function noticeCreate()
    {
        return view('superadmin.academics.notice.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNoticeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function noticeStore(StoreNoticeRequest $request)
    {
        $notice = Notice::where('class_id', '=', $request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('title', '=', $request->title)
            ->where('notice', '=', $request->notice)
            ->where('description', '=', $request->description)
            ->first();
        if ($notice === null) {
            $notice = new Notice();
            $notice->class_id = $request->class_id;
            $notice->section_id = $request->section_id;
            $notice->title = $request->title;
            $notice->notice = $request->notice;
            $notice->description = $request->description;
            $notice->save();
            return redirect()->route('notice')->with('success', 'Created successfully');
        }
        else{
            return redirect()->route('notice')->with('error', 'Data already exists.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function dropDownShow(Notice  $notice)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();

        $notice = Notice::all();
        return view ('superadmin.academics.notice.index', ['class'=> $class, 'section'=>$section],compact('notice'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function noticeEdit($id)
    {
        $class= DB::table('eclasses')->select('id','name')->get();
        $section= DB::table('sections')->select('id','name')->get();
        $not = Notice::all();
        $notice = Notice::find($id);
        return view('superadmin/academics/notice/edit', ['class' => $class, 'section' => $section, 'not' => $not, 'notice' => $notice,]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNoticeRequest  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function noticeUpdate(UpdateNoticeRequest $request)
    {
        $notice = Notice::where('class_id', '=', $request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('title', '=', $request->title)
            ->where('notice', '=', $request->notice)
            ->first();
        if ($notice === null) {
            $notice = Notice::find($request->id);
            $notice->class_id = $request->class_id;
            $notice->section_id = $request->section_id;
            $notice->title = $request->title;
            $notice->notice = $request->notice;
            $notice->description = $request->description;
            $notice ->update();
            return redirect()->route('notice')->with('success', 'Updated successfully');
        }
        else{
            return redirect()->route('notice')->with('error', 'Data already exists.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function noticeDestroy(Notice  $notice, $id)
    {
        $notice = Notice::findOrFail($id);
        $notice ->delete();
        return redirect()->route('notice')->with('success', 'Deleted successfully');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notice= DB::table('notices')
            ->join('eclasses', 'eclasses.id', '=', 'notices.class_id')
            ->join('sections', 'sections.id', '=', 'notices.section_id')
            ->select('notices.id as notice_id', 'eclasses.name as class_name', 'sections.name as section_name','notices.title as notice_title' ,'notices.notice as notice_date','notices.description as notice_description')
            ->orderBy('notices.notice','DESC')
            ->get();
        return response()->json([
            "success" => true,
            "message" => "Notice List",
            "data" => $notice
        ]);
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
     * @param  \App\Http\Requests\StoreNoticeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticeRequest $request)
    {
        $notice = new Notice();
        $notice->class_id = $request->class_id;
        $notice->section_id = $request->section_id;
        $notice->title = $request->title;
        $notice->notice = $request->notice;
        $notice->description = $request->description;
        $notice->save();
        return response()->json([
            'success' => true,
            'message'=>'Successfully added.',
            'data'=>$notice,
        ],Response::HTTP_OK);

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notice = Notice::findorFail($id);
        return $notice;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNoticeRequest  $request
     * @param  \App\Models\Notice $notice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoticeRequest $request, $id)
    {
        $notice = Notice::where('id', '=', $id)
            ->where('class_id', '=', $request->class_id)
            ->where('section_id', '=', $request->section_id)
            ->where('title', '=', $request->title)
            ->where('notice', '=', $request->notice)
            ->where('description','=', $request->description)
            ->first();
        if ($notice === null) {
            $notice = Notice::findorFail($id);
            $notice->class_id = $request->class_id;
            $notice->section_id = $request->section_id;
            $notice->title = $request->title;
            $notice->notice = $request->notice;
            $notice->description = $request->description;
            $notice ->update();
            return response()->json([
                'success' => true,
                'message'=>'Successfully updated.',
                'data'=>$notice,
            ],Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice, $id)
    {
        $notice = Notice::findOrFail($id);
        $notice ->delete();
        $note = Notice::all();
        return response()->json([
            'success' => true,
            'message'=>'Successfully deleted.',
            'data'=> $note
        ],Response::HTTP_OK);
    }
}
