<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use File;
use App\Models\Eclass;
use App\Models\UploadContent;
use Illuminate\Http\Request;
use App\Http\Requests\UploadContentRequest;

class UploadContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upload_contents = UploadContent::all();
        return view('superadmin.upload_content.index', compact('upload_contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Eclass::all();
        $availability = array('super_admin', 'student');
        $content_types = array('assignments','study_material', 'syllabus', 'other_download');
        return view('superadmin.upload_content.create', compact('classes', 'availability', 'content_types'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\UploadContentRequest  $request
    * @return \Illuminate\Http\Response
    */
    public function store(UploadContentRequest $request)
    {
        if (!empty($request->content_file)) {
            $file =$request->file('content_file');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/'), $filename);
            $file_name = 'uploads/'.$filename;
        }

        $upload_content = new UploadContent();
        $upload_content->title = $request->title;
        $upload_content->content_type = $request->content_type;
        $upload_content->available_for = $request->available_for;
        $upload_content->class_id = $request->class_id;
        $upload_content->section_id = $request->section_id;
        $upload_content->upload_date = $request->upload_date;
        $upload_content->description = $request->description;
        $upload_content->content_file = $file_name;

        if($upload_content->save()){
            return redirect()->route('upload.content.index')->with('success', 'Added successfully');
        }else{
            return  redirect()->back()->with('error', 'Ops! Something went wrong');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $upload_content = UploadContent::findOrFail($id);
        File::delete(public_path($upload_content->content_file));
        $upload_content->delete();
        return  redirect()->back()->with('success', 'Deleted successfully');
    }

    public function getData($key){
        $upload_contents = UploadContent::where('content_type',$key)->get();
        return view('superadmin.upload_content.data', compact('upload_contents', 'key'));
    }
}
