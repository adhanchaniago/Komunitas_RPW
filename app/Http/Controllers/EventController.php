<?php

namespace App\Http\Controllers;

use App\Event;
use App\Comunity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller {
    public function index() {
        
    }

    public function create($name) {
        $com_name = Comunity::select('name')->where('name',$name)->firstOrFail();
        return view('event.create',compact('com_name'));
    }

    public function store(Request $request,$name) {
        $com_id = Comunity::select('id')->where('name',$name)->firstOrFail();
        $now = Carbon::now();
        $request->validate([
            'type'=>'required',
            'content'=>'required',
            'date'=>'required',
        ]);
        if (Carbon::parse($request->date)->toDateString() < $now->toDateString()) {
            return back()->withErrors('You Cant Start an Event In The Past')->withInput();
        }
        $new_event = new Event();
        $new_event->type = $request->type;
        $new_event->content = $request->content;
        $new_event->date = $request->date;
        if ($new_event->save()) {
            $new_event->comunity()->attach($com_id->id);
        }
        return redirect()->route('comunity.show',$name);
    }

    public function show(Event $event) {
        //
    }

    public function edit(Event $event) {
        //
    }

    public function update(Request $request, Event $event) {
        //
    }

    public function destroy(Event $event) {
        //
    }
}
