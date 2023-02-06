<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\NoticeBoard;
use Illuminate\Http\Request;
use App\Http\Requests\NoticeBoardRequest;

class NoticeBoardController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notice_boards = NoticeBoard::all();
        return  view('superadmin.notice_board.index', compact('notice_boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receivers = array('student','parent','teacher','accountant', 'librarian','receptionist', 'superadmin');
        return view('superadmin.notice_board.create', compact('receivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\NoticeBoardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticeBoardRequest $request)
    {
        $notice_board = new NoticeBoard();
        $notice_board->title = $request->title;
        $notice_board->notice_date = $request->notice_date;
        $notice_board->published_on = $request->published_on;
        $notice_board->message_to = json_encode($request->receivers);
        $notice_board->message = $request->message;
        if($notice_board->save()){
            return redirect()->route('notice.board.index')->with('success', 'Created successfully');
        }else{
            return redirect()->route('notice.board.create')->with('error', 'Oops!! something went wrong');
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
        $noticeBoard = NoticeBoard::findOrFail($id);
        $noticeBoard->delete();
        return redirect()->route('notice.board.index')->with('success', 'Deleted successfully');
    }
}
