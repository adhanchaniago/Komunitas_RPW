<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
use App\Comunity;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {
	public function index() {
        if (Auth::user()->role != 'admin') {
            return redirect('/');
        }
		$popular = DB::table('mostvisited')
                ->join('users','mostvisited.user_id','=','users.id')
                ->join('comunities','mostvisited.comunity_id','=','comunities.id')
                ->select('mostvisited.id as post_id','mostvisited.content','mostvisited.title','mostvisited.vote','mostvisited.media','comunities.name','users.username','mostvisited.user_id','mostvisited.updated_at','mostvisited.view')
                ->where('mostvisited.updated_at','>=','NOW() - INTERVAL 3 day')
                ->orWhere('mostvisited.view','>',500)->orderBy('mostvisited.view','desc')
                ->distinct()->get();
        $newPost = DB::table('posts')
                ->join('users','posts.user_id','=','users.id')
                ->join('comunities','posts.comunity_id','=','comunities.id')
                ->select('posts.id as post_id','posts.content','posts.title','posts.vote','posts.media','comunities.name','users.username','posts.user_id')
                ->orderBy('posts.updated_at', 'desc')->distinct()->get();
        return view('admin', compact('popular','newPost'));
	}

    public function UserIndex(Request $request) {
        if ($request->ajax()) {
            $users = User::withTrashed()->get();
            return $users->toJson();
        }
    	return view('admin.userindex');
        
    }

    public function CommunityIndex(Request $request) {
        if ($request->ajax()) {
            $comunity = Comunity::all();
            return $comunity->toJson();
        }
    	return view('admin.comunityindex');
    }

    public function postIndex(Request $request) {
        if ($request->ajax()) {
            $post = Post::with('user')->get();
            return $post->toJson();
        }
        return view('admin.postindex');
    }

    public function replyIndex(Request $request) {
        if ($request->ajax()) {
            $reply = Comment::with(['user','post'])->get();
            return $reply->toJson();
        }
        return view('admin.replyindex');
    }

    public function CommunityCreate() {
        return view('admin.comunitycreate');
    }

    public function CommunityStore(Request $request) {
        $request->validate([
            'type'=>'required|string',
            'name'=>'required|string|unique:comunities',
            'banner'=>'required|mimes:jpg,png,jpeg',
        ]);

        $new_comunity = new Comunity();
        $new_comunity->type = $request->type;
        $new_comunity->name = $request->name;
        if ($request->file('banner')) {
                $file = $request->file('banner')->store('avatars','public');
                $new_comunity->banner = $file;
        }
        $new_comunity->followers = 1;
        if ($new_comunity->save()) {
            $new_comunity->user()->attach(Auth::id());
        }
        return redirect()->route('comunity.show',$request->name);
    }

    public function CommunityEdit($id) {
        $comunity = Comunity::find($id);
        return response()->json($comunity);
    }

    public function CommunityUpdate(Request $request) {
        $request->validate([
            'type'=>'string',
            'name'=>'string',
            'banner'=>'mimes:jpg,png,jpeg',
        ]);
        
        $new_comunity = Comunity::find($request->com_id);
        $new_comunity->name = $request->name;
        $new_comunity->type = $request->type;

        if ($request->file('banner')) {
            $file = $request->file('banner')->store('avatars','public');
            $new_comunity->banner = $file;
        }
        
        $new_comunity->save();

        return response()->json();
    }

    public function CommunityDestroy($id) {
        $comunity = Comunity::find($id)->delete();
        return response()->json();
    }

    public function postDestroy($id) {
        $post = Post::find($id)->delete();
        return response()->json();
    }

    public function replyDestroy($id) {
        $reply = Comment::find($id)->delete();
        return response()->json();
    }
}