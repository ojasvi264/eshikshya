<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffDirectory;

class LibraryStaffMemberController extends Controller
{
    public function index(){
        $staffs = StaffDirectory::where('status', 1)->with('issue_return')->latest()->get();
        return view('dashboard.pages.library.library_staff_member', compact('staffs'));
    }
}
