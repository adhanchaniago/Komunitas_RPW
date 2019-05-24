<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comunity;

class LandingPageController extends Controller {
    public function index(){
    	$comunity = Comunity::where('followers','>=',3000)->get();
    	// return $comunity;
    	return view('landing', compact('comunity'));
    }
}
