<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\SParent;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function studentCreate()
    {
        return redirect()->route('teacher.student');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function studentStore(StoreStudentRequest $request)
    {
        $student = Student::where('fname', '=', $request->fname)
            ->where('email', '=', $request->email)
            ->first();
        if ($student === null) {
            $storeStudent = Student::create([
                'fname' => $request->fname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'category_id' => $request->category_id,
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'admission' => $request->admission,
                'roll' => $request->roll,
                'dob' => $request->dob,
                'gender' => $request->gender,
                'bloodgroup' => $request->bloodgroup,
                'phone' => $request->phone,
                'caddress' => $request->caddress,
                'paddress' => $request->paddress,
                'caste' => $request->caste,
                'religion' => $request->religion,
            ]);
            if ($request->file('profile_image')){
                $storeStudent->addMedia($request->file('profile_image'))->toMediaCollection();
            }
            if ($storeStudent) {
                SParent::create([
                    'student_id' => $storeStudent->id,
                    'email' => $request->parent_email,
                    'password' => bcrypt($request->fathercontact),
                    'father_name' => $request->fathername,
                    'father_contact' => $request->fathercontact,
                    'father_job' => $request->fatherjob,
                    'mother_name' => $request->mothername,
                    'mother_contact' => $request->mothercontact,
                    'mother_job' => $request->motherjob,
                    'guardian_name' => $request->guardname,
                    'guardian_email' => $request->guardemail,
                    'guardian_relation' => $request->guardrelation,
                    'guardian_job' => $request->guardjob,
                    'guardian_contact' => $request->guardcontact,
                    'guardian_address' => $request->guardaddress,
                ]);
            }
            return redirect()->back()->with('success', 'Created successfully');
        } else {
            return redirect()->back()->with('error', 'Data already exists.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function dropDownShow(Student $student)
    {
        $category = DB::table('categories')->select('id', 'category_name')->get();
        $class = DB::table('eclasses')->select('id', 'name')->get();
        $section = DB::table('sections')->select('id', 'name')->get();
        $student = Student::latest()->get();
        return view('superadmin.academics.student.index', ['class' => $class, 'section' => $section, 'category' => $category], compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function studentEdit($id)
    {
        $category = DB::table('categories')->select('id', 'category_name')->get();
        $class = DB::table('eclasses')->select('id', 'name')->get();
        $section = DB::table('sections')->select('id', 'name')->get();
        $std = Student::latest()->get();
        $student = Student::find($id);
        return view('superadmin.academics.student.edit', ['category' => $category, 'class' => $class, 'section' => $section, 'student' => $student, 'std' => $std]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateStudentRequest $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function studentUpdate(UpdateStudentRequest $request, Student $student)
    {
        $student = Student::find($request->id);
        if ($request->hasFile('profile_image')){
            $student->clearMediaCollection();
            $student->addMedia($request->file('profile_image'))->toMediaCollection();
        }
        $studentData = [
            'fname' => $request->fname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'category_id' => $request->category_id,
            'class_id' => $request->class_id,
            'section_id' => $request->section_id,
            'admission' => $request->admission,
            'roll' => $request->roll,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'bloodgroup' => $request->bloodgroup,
            'phone' => $request->phone,
            'caddress' => $request->caddress,
            'paddress' => $request->paddress,
            'caste' => $request->caste,
            'religion' => $request->religion,
        ];
        $student->update($studentData);
        if ($student){
            $parent = SParent::where('student_id', $student->id)->first();
            $parentData = [
                'student_id' => $student->id,
                'parent_email' => $request->parent_email,
                'parent_password' => bcrypt($request->fathercontact),
                'father_name' => $request->fathername,
                'father_contact' => $request->fathercontact,
                'father_job' => $request->fatherjob,
                'mother_name' => $request->mothername,
                'mother_contact' => $request->mothercontact,
                'mother_job' => $request->motherjob,
                'guardian_name' => $request->guardname,
                'guardian_email' => $request->guardemail,
                'guardian_relation' => $request->guardrelation,
                'guardian_job' => $request->guardjob,
                'guardian_contact' => $request->guardcontact,
                'guardian_address' => $request->guardaddress,
            ];
            $parent->update($parentData);
        }
        return redirect()->route('teacher.student')->with('success', 'Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function studentDestroy(Student $student, User $user, $id)
    {
        $student = Student::findOrFail($id);
        if ($student->hasMedia()){
            $student->deleteMedia($student->getMedia()[0]);
        }
        $student->delete();
        if ($student){
            $parent = SParent::where('student_id', $student->id);
            $parent->delete();
        }
        return redirect()->route('teacher.student')->with('success', 'Deleted successfully');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
