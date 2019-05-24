<?php

namespace App\Http\Controllers;

use App\Comunity;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class CommunityController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function show($name) {
        $comunity = DB::table('posts')
            ->join('comunities','comunities.id', '=', 'posts.comunity_id')
            ->join('users','posts.user_id','=','users.id')
            ->select('comunities.*','users.username','users.id','posts.*')
            ->where('comunities.name',$name)->orderBy('posts.updated_at','desc')
            ->distinct()->get();
        $event = DB::table('events')
            ->join('eventcomunity','events.id','eventcomunity.event_id')
            ->join('comunities','comunities.id', '=', 'eventcomunity.comunity_id')
            ->select('events.type as event_name','events.date')
            ->where('comunities.name',$name)
            ->where('events.date','>=',Carbon::now()->toDateString())
            ->distinct()->get();
        $followers = DB::table('comunities')
            ->join('usercomunity','comunities.id','usercomunity.comunity_id')
            ->join('users','usercomunity.user_id','users.id')
            ->select('users.username','comunities.name')
            ->where('comunities.name',$name)->distinct()->get();
        $info = Comunity::where('name',$name)->firstOrFail();
        if (!empty($request->q)) {
            $comunity = DB::table('comunities')
                ->join('posts','comunities.id', '=', 'posts.comunity_id')
                ->join('users','posts.user_id','=','users.id')
                ->select('comunities.*','users.id','users.username','posts.*')
                ->where('posts.title','LIKE',"%{$request->q}%")
                ->where('comunities.name',$name)
                ->orderBy('posts.updated_at','desc')
                ->distinct()->get();
        }
        // return $followers;
        return view('comunity.show', compact('comunity','followers','info','event'));
    }

    public function unfollow($name) {
        $com_id = Comunity::select('id')->where('name',$name)->firstOrFail();
        $user_id = User::findOrFail(Auth::id());
        DB::table('usercomunity')
            ->where('user_id',$user_id->id)->where('comunity_id',$com_id->id)
            ->delete();
        DB::table('comunities')->where('name', $name)->decrement('followers',1);
        return redirect()->route('comunity.show',$name);
    }

    public function follow($name) {
        $com_id = Comunity::select('id')->where('name',$name)->firstOrFail();
        $user_id = User::select('id')->where('id',Auth::id())->firstOrFail();
        $now = Carbon::now();
        $follow_com = DB::table('usercomunity')->insert([
            ['user_id' => $user_id->id,'comunity_id' => $com_id->id,'created_at' => $now,'updated_at' => $now],
        ]);
        if ($follow_com) {
            DB::table('comunities')->where('name', $name)->increment('followers',1);
        }
        // return $user_id;
        return redirect()->route('comunity.show',$name);

    }
    public function edit(Community $community)
    {
        //
    }

    public function update(Request $request, Community $community)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Community  $community
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        //
    }
}
