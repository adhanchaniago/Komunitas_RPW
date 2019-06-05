<?php

namespace App\Http\Controllers;

use App\Status;
use App\User;
use Illuminate\Http\Request;

class StatusController extends Controller {
    public function index() {
        
    }

    public function create()
    {
        
    }

    public function store(Request $request) {
        $request->validate([
            'status'=>'required',
            'user_id'=>'required',
        ]);

        Status::where('user_id',$request->user_id)->delete();

        $new_status = new Status();
        $new_status->user_id = $request->user_id;
        $new_status->status = $request->status;
        $new_status->save();

        $user = User::where('id', $request->user_id)->withTrashed()->with('statuses')->firstOrFail();
        // return $user;
        return response()->json($user);
    }

    public function show(Status $status)
    {
        
    }

    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
    }
}
