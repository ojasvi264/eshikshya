<?php

namespace App\Http\Controllers\Api\Common;

use App\Http\Controllers\Controller;
use App\Models\Eclass;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    public function getClass()
    {
        $eclass = Eclass::all();
        return response()->json($eclass);
    }

    public function getSection()
    {
        $section= Section::join('eclasses', 'eclasses.id', '=', 'sections.eclasses_id')
            ->select('sections.id as section_id','sections.name as section_name' ,'eclasses.name as class_name')
            ->get();
        return response()->json($section);
    }

    public function getSubject()
    {
        $subject= Subject::join('eclasses', 'eclasses.id', '=', 'subjects.eclasses_id')
            ->select('subjects.id as subject_id','subjects.code as subject_code','subjects.name as subject_name','eclasses.name as class_name')
            ->get();
        return response()->json($subject);
    }

    public function getClassSection($id)
    {
        $class = Eclass::findOrFail($id);
        $class_sections = Section::where('eclasses_id', $class->id)
            ->select('sections.name as section_name')->get();
        return $class_sections;
    }
    public function getClassSubject($id)
    {
        $class = Eclass::findOrFail($id);
        $class_subjects = Subject::where('eclasses_id', $class->id)
            ->select('subjects.name as subject_name')->get();
        return $class_subjects;
    }
}
