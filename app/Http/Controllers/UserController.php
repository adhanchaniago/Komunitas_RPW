<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comunity;
use App\User;
use App\Status;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {
        $user = User::findOrFail($id);
        return view('home', ['user'=>$user]);
    }

    public function changePassword(Request $request, $username) {
        $user = User::where('username', $username)->firstOrFail();
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('users.show',$user->username)->with('status','Password Successfully Changed');
    }
    public function create() {
        
    }

    public function store(Request $request) {
        //
    }

    public function show($username) {
        $user = User::where('username', $username)->withTrashed()->firstOrFail();
        return view('user.show', compact('user'));
    }

    public function edit($id) {
        //
    }

    public function update(Request $request, $username) {
        $update_user = User::where('username', $username)->firstOrFail();
        $request->validate([
            'email' => 'email',
        ]);
        if ($request->file('avatar')) {
            $ex_avatar = explode('.',$request->file('avatar'));
            if ($ex_avatar != 'png' || $ex_avatar != 'jpg' || $ex_avatar != 'jpeg') {
                return back()->withErrors('Format avatar yang diterima hanya jpg, jpeg, atau png')->withInput();
            }
            $file = $request->file('avatar')->store('avatars','public');
            $update_user->avatar = $file;
        }
        $update_user->email = $request->email;
        $update_user->username = $request->username;
        $update_user->save();

        return redirect()->route('users.show',$request->username);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        Auth::logout();
        $user = User::where('username',$username)->firstOrFail();
        if ($user->avatar && file_exists(storage_path('app/public/'.$user->avatar))) {
            Storage::delete('public/'.$user->avatar);
        }
        $user->delete();
        return redirect()->route('home');
    }
}
