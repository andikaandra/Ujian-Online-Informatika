<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Log;

class DosenController extends Controller
{
    public function setTambahUjian(Request $request)
    {
    	return $request;
		try {

		} catch (\Exception $e) {
	        $eMessage = 'fill data - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }
    }
}
