<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PostController extends Controller {
    /**
     * fungsi membuat postingan
     * @return [view] [mengembalikan view beserta data komunitas]
     */
    public function create() {
        /**
         * id dari user yang login
         * @var int
         */
        $user_id = Auth::id();

        /**
         * mengambil data komunitas yang di follow oleh user dari database
         * @var object
         */
        $comunity = DB::table('users')->join('usercomunity', 'users.id', '=', 'usercomunity.user_id')
                ->join('comunities','usercomunity.comunity_id', '=', 'comunities.id')
                ->join('posts','comunities.id', '=', 'posts.comunity_id')
                ->select('comunities.name','comunities.id as comunity_id')
                ->where('users.id', $user_id)->distinct()->get();
        
        return view('post.create',compact('comunity'));
    }

    /**
     * fungsi menyimpan postingan kedalam database
     * @param  Request $request [variabel data inputan dari form html]
     * @return [redirect] [mengembalikan redirect kembali ke halaman menampilkan postingan]
     */
    public function store(Request $request) {
        /**
         * validasi data inputan dari form html
         */
        $request->validate([
            'title'=>'required|unique:posts',
            'content'=>'required',
            'media'=>'mimes:jpg,jpeg,png,bmp',
            'comunity_id'=>'required',
        ]);

        /**
         * membuat object model postingan baru untuk disimpan kedalam database
         * @var Post
         */
        $new_post = new Post();
        $new_post->title = $request->title;
        $new_post->content = nl2br($request->content);
        $new_post->comunity_id = $request->comunity_id;
        $new_post->user_id = Auth::id();
        if ($request->file('media')) {
                $file = $request->file('media')->store('media','public');
                $new_post->media = $file;
        }
        $new_post->save();
        return redirect()->route('posts.show',$request->title);
    }

    /**
     * fungsi menampilkan postingan
     * @param  [string] $title [judul dari postingan]
     * @return [view] [mengembalikan halaman html untuk menampilkan postingan bersama dengan data komentar dan postingan baru dan popular]
     */
    public function show($title) {
        /**
         * mengambil postingan berdasarkan judulnya
         * @var object
         */
        $post = Post::where('title', $title)->firstOrFail();

        /**
         * mengambil komentar dari postingan berdasarkan judul postingan
         * @var object
         */
        $comment = Post::join('comments','posts.id','comments.post_id')
            ->join('users','comments.user_id','users.id')
            ->select('posts.id','users.username','users.deleted_at','users.role','comments.content','comments.parent_id')
            ->where('title', $title)->get();

        /**
         * mengupdate kolom last_view dalam postingan sesuai dengan tanggal dan jam sekarang
         * (nggak tau dipakai atau nggak, lupa)
         */
        DB::table('posts')->where('title', $title)->update(['last_view'=>Carbon::now()]);

        /**
         * mengambil data postingan terbaru beserta komunitas dan user yang memposting
         * @var object
         */
        $newPost = DB::table('posts')
            ->join('users','posts.user_id','=','users.id')
            ->join('comunities','posts.comunity_id','=','comunities.id')
            ->select('posts.id as post_id','posts.content','posts.title','posts.vote','posts.media','comunities.name','users.username','posts.user_id')
            ->orderBy('posts.updated_at', 'desc')->distinct()->get();

        /**
         * mengambil data postingan dengan jumlah kunjungan terbanyak dalam 3 hari terakhir beserta komunitas dan user yang memposting
         * @var object
         */
        $popPost = DB::table('mostvisited')
            ->join('users','mostvisited.user_id','=','users.id')
            ->join('comunities','mostvisited.comunity_id','=','comunities.id')
            ->select('mostvisited.id as post_id','mostvisited.content','mostvisited.title','mostvisited.vote','mostvisited.media','comunities.name','users.username','mostvisited.user_id','mostvisited.updated_at','mostvisited.view')
            ->where('mostvisited.updated_at','>=','NOW() - INTERVAL 3 day')
            ->orWhere('mostvisited.view','>',500)->orderBy('mostvisited.view','desc')
            ->distinct()->get();

        /**
         * menambahkan jumlah view postingan dengan satu hanya jika user yang melihat bukan user yang membuat postingan
         * (nggak tau kenapa begini, lupa)
         */
        if(Auth::id() != $post->user_id){
            DB::table('posts')->where('title', $title)->increment('view',1);
        }
        return view('post.show', compact('post','newPost','comment'))->with(['popular'=>$popPost]);
    }

    /**
     * fungsi edit postingan
     * @param  [string] $title [judul dari postingan]
     * @return [redirect] [mengembalikan redirect kembali ke halaman menampilkan postingan]
     */
    public function edit($title) {
        /**
         * mengambil data pertama postingan berdasarkan judulnya
         * @var object
         */
        $posts = Post::where('title', $title)->firstOrFail();
        return view('post.edit',compact('posts'));
    }

    public function update(Request $request, $title) {
        /**
         * mengambil data pertama postingan berdasarkan judulnya
         * @var object
         */
        $update_post = Post::where('title', $title)->firstOrFail();

        /**
         * validasi data inputan dari form html
         */
        $request->validate([
            'content'=>'required',
            'media'=>'mimes:jpg,jpeg,png,bmp',
        ]);

        /**
         * updata data database dengan data baru sesuai inputan form html yang sudah divalidasi
         * @var Post
         */
        $update_post->content = $request->content;
        /**
         * jika inputan yang masuk ada gambar maka agambar akan disimpan didalam folder storage/public/media
         */
        if ($request->file('media')) {
            $file = $request->file('media')->store('media','public');
            $update_post->media = $file;
        }
        $update_post->save();
        return redirect()->route('posts.show',$title);

    }
    
    /**
     * fungsi menghapus postingan
     * @param  [int] $id [id dari postingan]
     * @return [redirect]     [mengembalikan redirect kembali ke halaman utama]
     */
    public function delete($id) {
        /**
         * mengambil data pertama postingan berdasarkan idnya
         * @var object
         */
        $post = Post::findOrFail($id);

        /**
         * menghapus data postingan
         */
        $post->delete();
        return redirect()->route('home');
    }

}
