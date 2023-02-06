<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function adminProfile (Request $request) {
        if(Auth::check()) {
            $admin = DB::table('staff_directories')
                ->join('roles', 'roles.id', '=', 'staff_directories.role_id')
                ->join('designations', 'designations.id', '=', 'staff_directories.designation_id')
                ->join('departments', 'departments.id', '=', 'staff_directories.department_id')
                ->where('staff_directories.id', '=', Auth::id())
                ->select('staff_directories.name', 'staff_directories.email','staff_directories.phone','staff_directories.gender','staff_directories.dob as date_of_birth',
                    'roles.name as role', 'designations.designation', 'departments.name as department', 'staff_directories.marital_status',
                    'staff_directories.permanent_address','staff_directories.current_address', 'staff_directories.qualification', 'staff_directories.work_experience',
                    'staff_directories.father_name', 'staff_directories.mother_name','staff_directories.emergency_phone',
                    'staff_directories.date_of_joining', 'staff_directories.note', 'staff_directories.pan_number',
                    'staff_directories.contract_type', 'staff_directories.work_shift', 'staff_directories.basic_salary',
                    'staff_directories.bank_name','staff_directories.bank_account_name', 'staff_directories.bank_account_number', 'staff_directories.bank_branch_name',
                    'staff_directories.facebook_link','staff_directories.instagram_link','staff_directories.twitter_link', 'staff_directories.linkedin_link',
                   )
                ->get();
            return $admin;
        }
    }
    public function teacherProfile (Request $request) {
        if(Auth::check()) {
            $teacher = DB::table('staff_directories')
                ->join('roles', 'roles.id', '=', 'staff_directories.role_id')
                ->join('designations', 'designations.id', '=', 'staff_directories.designation_id')
                ->join('departments', 'departments.id', '=', 'staff_directories.department_id')
                ->where('staff_directories.id', '=', Auth::id())
                ->select('staff_directories.name', 'staff_directories.email','staff_directories.phone','staff_directories.gender','staff_directories.dob as date_of_birth',
                    'roles.name as role', 'designations.designation', 'departments.name as department', 'staff_directories.marital_status',
                    'staff_directories.permanent_address','staff_directories.current_address', 'staff_directories.qualification', 'staff_directories.work_experience',
                    'staff_directories.father_name', 'staff_directories.mother_name','staff_directories.emergency_phone',
                    'staff_directories.date_of_joining', 'staff_directories.note', 'staff_directories.pan_number',
                    'staff_directories.contract_type', 'staff_directories.work_shift', 'staff_directories.basic_salary',
                    'staff_directories.bank_name','staff_directories.bank_account_name', 'staff_directories.bank_account_number', 'staff_directories.bank_branch_name',
                    'staff_directories.facebook_link','staff_directories.instagram_link','staff_directories.twitter_link', 'staff_directories.linkedin_link',
                )
                ->get();
            return $teacher;
        }
    }
   public function parentProfile (Request $request) {
       if(Auth::check()) {
           $parent= DB::table('parents')
               ->join('students', 'students.id', '=', 'parents.student_id')
               ->select('students.fname as student_name','parents.email','parents.father_name','parents.father_contact','parents.father_job',
                   'parents.mother_name','parents.mother_contact','parents.mother_job',
                   'parents.guardian_name', 'parents.guardian_email','parents.guardian_relation','parents.guardian_contact','parents.guardian_job', 'parents.guardian_address')
               ->where('parents.id', '=', Auth::id())
               ->get();
           return $parent;
       }
    }

    public function studentProfile(Request $request){
        if(Auth::check()) {
            $student = DB::table('students')
                ->join('parents', 'parents.student_id', '=', 'students.id')
                ->join('eclasses', 'eclasses.id', '=', 'students.class_id')
                ->join('sections', 'sections.id', '=', 'students.section_id')
                ->join('categories', 'categories.id', '=', 'students.category_id')
                ->select('students.fname','students.email','students.admission as admission_no','students.roll as roll_no','categories.category_name as category_name',
                    'eclasses.name as class_name','sections.name as section_name','students.bloodgroup as blood_group','students.gender','students.dob as date_of_birth',
                    'students.dob as date_of_birth','students.phone as contact_no', 'students.caddress as current_address', 'students.paddress as permanent_address',
                    'students.caste', 'students.religion','parents.email','parents.father_name','parents.father_contact','parents.father_job',
                    'parents.mother_name','parents.mother_contact','parents.mother_job',
                    'parents.guardian_name', 'parents.guardian_email','parents.guardian_relation','parents.guardian_contact','parents.guardian_job', 'parents.guardian_address')
                ->where('students.id', '=', Auth::id())
                ->get();
            return $student;
        }
    }
    public function parentStudentProfile(Request $request){
        if(Auth::check()) {
            $student = DB::table('parents')
                ->select('parents.student_id')
                ->where('parents.id', '=', Auth::id())
                ->first();
            if ($student){
                $userD = DB::table('students')
                    ->join('parents', 'parents.student_id', '=', 'students.id')
                    ->join('eclasses', 'eclasses.id', '=', 'students.class_id')
                    ->join('sections', 'sections.id', '=', 'students.section_id')
                    ->join('categories', 'categories.id', '=', 'students.category_id')
                    ->select('students.fname', 'students.email', 'students.admission as admission_no', 'students.roll as roll_no', 'categories.category_name as category_name',
                        'eclasses.name as class_name', 'sections.name as section_name', 'students.bloodgroup as blood_group',  'students.gender',  'students.dob as date_of_birth',
                        'students.dob as date_of_birth', 'students.phone as contact_no', 'students.caddress as current_address', 'students.paddress as permanent_address',
                        'students.caste', 'students.religion' )
                    ->where('parents.id', '=', Auth::id())
                    ->get();
                return $userD;
            }
        }
    }
}
