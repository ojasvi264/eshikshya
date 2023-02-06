<?php

namespace App\Http\Controllers\Super\Academics;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedRequest;
use App\Http\Requests\UpdateFeedRequest;
use App\Models\Feed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FeedController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function feedCreate()
    {
        return view('superadmin.academics.feed.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreFeedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function feedStore(StoreFeedRequest $request)
    {
        $feed = new Feed();
        $feed->feed = $request->feed;
        $feed->feed_date= $request->feed_date;
        $feed->feed_content= $request->feed_content;
        $fileNames = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = $image->getClientOriginalName();
                $filename = date('YmdHi') . '.' . $imageName;
                $image->move(public_path('files/feed'), $filename);
                $fileNames[] = $filename;
            }
        }
        $feed->image=json_encode($fileNames);
        $feed->save();
        return redirect()->route('feed')->with('success', 'Created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feed $feed
     * @return \Illuminate\Http\Response
     */
    public function feedEdit($id)
    {
        $fd = Feed::all();
        $feed = Feed::find($id);
        return view('superadmin/academics/feed/edit', ['fd' => $fd, 'feed' => $feed]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFeedRequest  $request
     * @param  \App\Models\Feed $feed
     * @return \Illuminate\Http\Response
     */
    public function feedUpdate(UpdateFeedRequest $request)
    {
        $feed = Feed::findorFail($request->id);
        $feed->feed = $request->feed;
        $feed->feed_date= $request->feed_date;
        $feed->feed_content= $request->feed_content;
        foreach ($request->file('image') as $image){
            $imageName = $image->getClientOriginalName();
            $filename = date('YmdHi').'.'.$imageName;
            $image->move(public_path('files/feed') ,$filename);
            $fileNames[] = $filename;
        }
        $feed->image=json_encode($fileNames);
        $feed->update();
        return redirect()->route('feed')->with('success', 'Updated successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function feedShow(Feed $feed)
    {
        $feed = Feed::all();
        return view('superadmin.academics.feed.index',compact('feed'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function feedDestroy(Feed  $feed, $id)
    {
        $feed = Feed::findOrFail($id);
        $feed->delete();
        return redirect()->route('feed')->with('success', 'Deleted successfully');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feed= DB::table('feeds')
            ->select('feeds.id as feed_id','feeds.feed as feed_title', 'feeds.feed_date as created_date', 'feeds.feed_content as content', 'feeds.image as feed_image')
            ->orderBy('feeds.feed_date','DESC')
            ->get();
        return response()->json([
            'success' => true,
            'data'=>$feed,
        ],Response::HTTP_OK);
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
     * @param  \Illuminate\Http\StoreFeedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeedRequest $request)
    {
            $feed = new Feed();
            $feed->feed = $request->feed;
            $feed->feed_date= $request->feed_date;
            $feed->feed_content= $request->feed_content;
            $fileNames = [];
            if($request->hasFile('image')){
                foreach ($request->file('image') as $image){
                    $imageName = $image->getClientOriginalName();
                    $filename = date('YmdHi').'.'.$imageName;
                    $image-> move(public_path('files/feed'), $filename);
                    Storage::disk('local')->put('files/feed/'.$filename,'public');
                    $fileNames[] = $filename;
                }
            }
            $feed->image=json_encode($fileNames);
            $feed->save();
            return response()->json([
                'success' => true,
                'message'=>'Successfully created.',
                'data'=>$feed,
            ],Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feed = Feed::findOrFail($id);
        return $feed;
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
        $feed = Feed::findOrFail($id);
        $feed->feed = $request->feed;
        $feed->feed_date= $request->feed_date;
        $feed->feed_content= $request->feed_content;
        $fileNames = [];
        if($request->hasFile('image')){
            foreach ($request->file('image') as $image){
                $imageName = $image->getClientOriginalName();
                $filename = date('YmdHi').'.'.$imageName;
                $image-> move(public_path('files/feed'), $filename);
                Storage::disk('local')->put('files/feed/'.$filename,'public');
                $fileNames[] = $filename;
            }
        }
        $feed->image=json_encode($fileNames);
        $feed->update();
        return response()->json([
            'success' => true,
            'message'=>'Successfully updated.',
            'data'=>$feed,
        ],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feed $feed, $id)
    {
        $feed = Feed::findOrFail($id);
        $feed->delete();
        return response()->json([
            'success' => true,
            'message'=>'Successfully deleted.',
        ],Response::HTTP_OK);
    }

}
