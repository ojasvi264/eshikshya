<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LibraryMember;

class LibraryMemberController extends Controller
{
//    public function index(){
//        $staffs = StaffDirectory::where('status', 1)->latest()->get();
//        return view('dashboard.pages.library.library_member', compact('staffs'));
//    }

    public function create(Request $request, $id)
    {
        if ($request->type == "Staff"){
            $data = [
                'directory_id' => $id,
                'library_card_number' => $request->library_card_number,
                'member_type' => $request->type,
                'status' => 1,
            ];
        }
        elseif ($request->type == "Student"){
            $data = [
                'student_id' => $id,
                'library_card_number' => $request->library_card_number,
                'member_type' => $request->type,
                'status' => 1,
            ];
        }
        $libraryMember = LibraryMember::create($data);
        return response(json_encode($libraryMember)) ;
    }
    public function destroy($id)
    {
        $libraryMember = LibraryMember::find($id);
        $libraryMember->delete();
        return response(json_encode($libraryMember));
    }
}
