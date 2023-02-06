<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIssueReturnRequest;
use App\Models\Book;
use App\Models\IssueReturn;
use App\Models\LibraryMember;
use App\Models\LibraryStaffMember;
use App\Models\LibraryStudentMember;
use Illuminate\Http\Request;

class IssueReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $classes = Eclass::all();
//        $sections = Section::all();
        $libraryMembers = LibraryMember::latest()->get();
        return view('dashboard.pages.library.issue_return', compact('libraryMembers'));
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
    /*Student Issue Return Store*/
    public function store(StoreIssueReturnRequest $request)
    {
        $book = Book::where('id', $request->book_id)->first();
        $book->quantity--;
        $book->save();
        IssueReturn::create($request->all());
        return redirect()->back()->with('success', 'Book Issued Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getBookQuantity($id)
    {
        $book = Book::find($id);
        $quantity = $book->quantity;
        return json_encode($quantity);
    }

    public function issueReturn($id){
        $libraryMember = LibraryMember::find($id);
        $issuedBooks = IssueReturn::where('library_member_id', $id)->latest()->get();
        $books = Book::all();
        return view('dashboard.pages.library.issue_return_detail', compact('libraryMember', 'books', 'issuedBooks'));
    }

    public function returnBook(Request $request, $id)
    {
        $issueReturn = IssueReturn::find($id);
        $issueReturn->return_date = $request->return_date;
        $issueReturn->save();
        $book_id = $issueReturn->book_id;
        $book = Book::find($book_id);
        $book->quantity = $book->quantity+1;
        $book->save();
        return json_encode($issueReturn);
    }
}
