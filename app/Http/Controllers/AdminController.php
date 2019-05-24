<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Comunity;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller {
	public function index() {
		$popular = DB::table('posts')
                ->join('users','posts.user_id','=','users.id')
                ->join('comunities','posts.comunity_id','=','comunities.id')
                ->select('posts.id as post_id','posts.content','posts.title','posts.vote','posts.media','comunities.name','users.username','posts.user_id')
                ->where('view','>=',50)->distinct()->get();
        $newPost = DB::table('posts')
                ->join('users','posts.user_id','=','users.id')
                ->join('comunities','posts.comunity_id','=','comunities.id')
                ->select('posts.id as post_id','posts.content','posts.title','posts.vote','posts.media','comunities.name','users.username','posts.user_id')
                ->orderBy('posts.updated_at', 'desc')->distinct()->get();
        return view('admin', compact('popular','newPost'));
	}

    public function UserIndex(Request $request) {
    	$users = User::orderBy('updated_at','desc')->paginate(10);
    	return view('admin.userindex',compact('users'));
    }

    public function CommunityIndex(Request $request) {
    	$comunity = Comunity::orderBy('updated_at','desc')->paginate(10);
    	return view('admin.comunityindex',compact('comunity'));
    }

    public function CommunityStore(Request $request) {
        $request->validate([
            'type'=>'required|string',
            'name'=>'required|string',
            'banner'=>'required|mimes:jpg,png,jpeg',
        ]);

        $new_comunity = new Event();
        $new_comunity->type = $request->type;
        $new_comunity->name = $request->name;
        if ($request->file('banner')) {
                $file = $request->file('banner')->store('avatars','public');
                $new_comunity->banner = $file;
        }
        $new_comunity->save();
        return redirect()->route('community.show');
    }

    public function CommunityDestroy($id) {
        $comunity = Comunity::findOrFail($id);
        $comunity->delete();
        return redirect()->route('community.index');
    }
}