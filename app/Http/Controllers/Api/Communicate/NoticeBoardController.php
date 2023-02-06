<?php

namespace App\Http\Controllers\Api\Communicate;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoticeBoardRequest;
use App\Http\Requests\UpdateNoticeBoardRequest;
use App\Models\NoticeBoard;
use Illuminate\Http\Response;

class NoticeBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticeBoard = NoticeBoard::all();
        return response()->json([
            'success' => true,
            'data'=>$noticeBoard
        ],Response::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreNoticeBoardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticeBoardRequest $request)
    {
        $notice_board = new NoticeBoard();
        $notice_board->title = $request->title;
        $notice_board->notice_date = $request->notice_date;
        $notice_board->published_on = $request->published_on;
        $notice_board->message_to = json_encode($request->receivers);
        $notice_board->message = $request->message;
        $notice_board->save();
        return response()->json([
            'success' => true,
            'message'=>'Successfully added.',
            'data'=>$notice_board
        ],Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NoticeBoard  $noticeBoard
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticeBoard = NoticeBoard::findOrFail($id);
        return $noticeBoard;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCalendarRequest  $request
     * @param  \App\Models\Calendar  $calendar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNoticeBoardRequest $request, $id)
    {
        $noticeBoard = NoticeBoard::where('id', '=', $id)
            ->where('title', '=', $request->title)
            ->where('notice_date', '=', $request->notice_date)
            ->where('published_on','=', $request->published_on)
            ->where('message_to','=', $request->message_to)
            ->first();
        if($noticeBoard === null){
            $noticeBoard = NoticeBoard::findorFail($id);
            $noticeBoard->title = $request->title;
            $noticeBoard->notice_date = $request->notice_date;
            $noticeBoard->published_on = $request->published_on;
            $noticeBoard->message_to = json_encode($request->receivers);
            $noticeBoard->message = $request->message;
            $noticeBoard->update();
            return response()->json([
                'success' => true,
                'message'=>'Successfully updated.',
                'data'=>$noticeBoard,
            ],Response::HTTP_OK);
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
        return response()->json([
            'success' => true,
            'message'=>'Successfully deleted.',
        ],Response::HTTP_OK);
    }
}
