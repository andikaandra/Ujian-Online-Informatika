<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Log;

class MahasiswaController extends Controller
{
    public function setDataFilling(Request $request)
    {
		try {
			if (Auth::user()->role == "mahasiswa") {
				User::where('id', Auth::user()->id)->update(['email' => $request->email, 'name' => $request->nama]);
			}
			else{
				User::where('id', Auth::user()->id)->update(['name' => $request->nama]);
			}
		} catch (\Exception $e) {
	        $eMessage = 'fill data - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }

		if (Auth::user()->role == "mahasiswa") {
	        return redirect('/mahasiswa');
		}
		return redirect('/dosen');
    }
}
