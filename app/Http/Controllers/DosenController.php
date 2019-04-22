<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Soal;
use App\Ujian;
use App\PesertaUjian;
use Auth;
use Log;

class DosenController extends Controller
{
    public function setTambahUjian(Request $request)
    {
    	// return $request;
		try {
			Ujian::create([
				'nama' => $request->nama,
				'id_dosen' => Auth::user()->id,
				'test_time'	=>	$request->waktu_ujian,
				'true_answer'	=>	$request->nilai_benar,
				'false_answer'	=>	$request->nilai_salah,
				'jumlah_soal'	=>	$request->jumlah_soal,
				'result_to_user'	=>	$request->result,
				'report_to_user'	=>	$request->report,
				'date_start'	=>	$request->tanggal_mulai,
				'date_end'	=>	$request->tanggal_akhir,
				'time_start'	=>	$request->waktu_mulai,
				'time_end'	=>	$request->waktu_akhir,
	      	]);
		} catch (\Exception $e) {
	        $eMessage = 'new ujian - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }
	    return redirect('dosen/list-ujian')->with('success', 'Test successfully created!'); 
    }

    public function setUpdateUjian(Request $request)
    {
    	// return $request;
		try {
			Ujian::find($request->id_ujian)->update([
				'nama' => $request->nama,
				'test_time'	=>	$request->waktu_ujian,
				'true_answer'	=>	$request->nilai_benar,
				'false_answer'	=>	$request->nilai_salah,
				'result_to_user'	=>	$request->result,
				'report_to_user'	=>	$request->report,
				'date_start'	=>	$request->tanggal_mulai,
				'date_end'	=>	$request->tanggal_akhir,
				'time_start'	=>	$request->waktu_mulai,
				'time_end'	=>	$request->waktu_akhir,
      	]);
		} catch (\Exception $e) {
	        $eMessage = 'update ujian - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }
	    return redirect('dosen/list-ujian')->with('success', 'Test successfully updated!'); 
    }

    public function setTambahPeserta(Request $request)
    {
    	// return $request;
		try {
			foreach ($request->peserta as $peserta) {
				PesertaUjian::updateOrCreate ([
					'ujian_id' => $request->ujian_id,
					'user_id' => $peserta
		      	]);
			}
		} catch (\Exception $e) {
	        $eMessage = 'new participant - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return response()->json(['error' => $eMessage]);
	    }
	    return response()->json(['success' => 'Success!']);
    }

    public function deletePeserta(Request $request)
    {
		try {
			PesertaUjian::find($request->id)->delete();
		} catch (\Exception $e) {
	        $eMessage = 'delete participant - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }
	    return redirect()->back()->with('success', 'Delete Success!');
    }


    public function setTambahSoal(Request $request)
    {
    	return $request;
		try {
			Soal::create([

	      	]);
		} catch (\Exception $e) {
	        $eMessage = 'new soal - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return response()->json(['error' => $eMessage]);
	    }
	    return response()->json(['success' => 'Success!']);
    }

    public function deleteSoal(Request $request)
    {
		try {
			Soal::find($request->id)->delete();
		} catch (\Exception $e) {
	        $eMessage = 'delete soal - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }
	    return redirect()->back()->with('success', 'Delete Success!');
    }
    
}
