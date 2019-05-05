<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Packet;
use App\Ujian;
use App\PesertaUjian;
use Auth;
use Log;
use DB;

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

    public function ujian(Request $request)
    {
    	// return $request;
		try {
			$start = microtime(true);
			$ujian = Ujian::find($request->ujian_id);
			$pesertaUjian = PesertaUjian::where('ujian_id', $request->ujian_id)->where('user_id', Auth::user()->idUser)->first();
			$daftarSoal = $ujian->soals;
			$totalSoal = count($daftarSoal);
			$array = range(0, $totalSoal - 1);

			$end = microtime(true);
			shuffle($array);
			if (strlen($pesertaUjian->soal)>0) {
				return redirect()->back()->with('success', 'Already Joined test!');
			}
			foreach ($array as $a) {
				DB::table('packet')->insert([
					'peserta_ujian_id' => $pesertaUjian->id,
					'soal_id' => $daftarSoal[$a]->id,
		      	]);
			}
			$pesertaUjian->soal = implode("|",$array);
			$pesertaUjian->save();

			return redirect()->back()->with('success', 'Successfully joined test!');
			
		} catch (\Exception $e) {
	        $eMessage = 'ujian - User: ' . Auth::user()->idUser . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	        // return $e->getMessage();
	    	return redirect()->back()->with('error', 'Whoops, something error!');
	    }
		return redirect('/mahasiswa');
    }
}
