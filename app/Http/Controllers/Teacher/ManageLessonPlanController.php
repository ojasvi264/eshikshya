<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\StaffDirectory;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ManageLessonPlanController extends Controller
{
    public function index(){
        $teachers = StaffDirectory::latest()->get();
        return view('dashboard.pages.lesson_plan.manage_lesson_plan', compact('teachers'));
    }

    public function search(Request $request){
        $teachers = Teacher::latest()->get();
        $searchedLessonPlan = ['sunday', 'monday', 'tuesday'];
        return view('dashboard.pages.lesson_plan.manage_lesson_plan', compact('searchedLessonPlan', 'teachers'));
    }
}
