<?php

namespace App\Http\Controllers;

use App\Models\LibraryStaffMember;
use App\Models\StaffDirectory;
use Illuminate\Http\Request;

class LibraryStaffMemberController extends Controller
{
    public function index(){
        $staffs = StaffDirectory::where('status', 1)->with('issue_return')->latest()->get();
        return view('dashboard.pages.library.library_staff_member', compact('staffs'));
    }
}
