<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller {
    public function index() {
        //
    }

    public function create() {
        $user_id = Auth::id();
        $comunity = DB::table('users')->join('usercomunity', 'users.id', '=', 'usercomunity.user_id')
                ->join('comunities','usercomunity.comunity_id', '=', 'comunities.id')
                ->join('posts','comunities.id', '=', 'posts.comunity_id')
                ->select('comunities.name','comunities.id as comunity_id')
                ->where('users.id', $user_id)->distinct()->get();
        // return $comunity;
        return view('post.create',compact('comunity'));
    }

    public function store(Request $request) {
        $request->validate([
            'title'=>'required|unique:posts',
            'content'=>'required',
            'media'=>'mimes:jpg,jpeg,png,bmp',
            'comunity_id'=>'required',
        ]);
        $new_post = new Post();
        $new_post->title = $request->title;
        $new_post->content = $request->content;
        $new_post->comunity_id = $request->comunity_id;
        $new_post->user_id = Auth::id();
        if ($request->file('media')) {
                $file = $request->file('media')->store('media','public');
                $new_post->media = $file;
        }
        $new_post->save();
        return redirect()->route('posts.show',$request->title);
    }

    public function show($title) {
        // $post = Post::join('users','posts.user_id','users.id')
        //     ->join('comunities','posts.comunity_id','comunities.id')
        //     ->select('posts.*','users.username','comunities.name')
        //     ->where('title', $title)->firstOrFail();
        $post = Post::where('title', $title)->firstOrFail();
        $comment = Post::join('comments','posts.id','comments.post_id')
            ->join('users','comments.user_id','users.id')
            ->select('posts.id','users.username','comments.content','comments.parent_id')
            ->where('title', $title)->get();

        $newPost = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->join('comunities','posts.comunity_id','=','comunities.id')
            ->select('posts.id as post_id','posts.content','posts.title','posts.vote','posts.media','comunities.name','users.username','posts.user_id')
            ->orderBy('posts.updated_at', 'desc')->distinct()->get();
        $popPost = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->join('comunities','posts.comunity_id','=','comunities.id')
            ->select('posts.id as post_id','posts.content','posts.title','posts.vote','posts.media','comunities.name','users.username')
            ->where('view','>=',100)->get();
        if(Auth::id() != $post->user_id){
            DB::table('posts')->where('title', $title)->increment('view',1);
        }
        // $update_view = $post->vote++;
        // $update_view->save();
        // return $post;
        return view('post.show', compact('post','newPost','comment'))->with(['popular'=>$popPost]);
    }

    public function edit($title) {
        $posts = Post::where('title', $title)->firstOrFail();
        return view('post.edit',compact('posts'));
    }

    public function update(Request $request, $title) {
        $update_post = Post::where('title', $title)->firstOrFail();
        $request->validate([
            'content'=>'required',
            'media'=>'mimes:jpg,jpeg,png,bmp',
        ]);

        $update_post->content = $request->content;
        if ($request->file('media')) {
                $file = $request->file('media')->store('media','public');
                $update_post->media = $file;
        }
        $update_post->save();
        return redirect()->route('posts.show',$title);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    
    public function delete($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('home');
    }
}
