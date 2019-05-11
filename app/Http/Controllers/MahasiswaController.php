<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TcExamPacket;
use App\TcExamUjian;
use App\TcExamPesertaUjian;
use Auth;
use Log;
use DB;

class MahasiswaController extends Controller
{
    public function ujian(Request $request)
    {
		try {
			$start = microtime(true);
			$ujian = TcExamUjian::find($request->ujian_id);
			$pesertaUjian = TcExamPesertaUjian::where('ujian_id', $request->ujian_id)->where('user_id', Auth::user()->idUser)->first();
			$daftarSoal = $ujian->soals;
			$totalSoal = count($daftarSoal);
			$array = range(0, $totalSoal - 1);
			$end = microtime(true);
			shuffle($array);
			if (strlen($pesertaUjian->soal)>0) {
				return redirect()->back()->with('success', 'Already Joined test!');
			}
			foreach ($array as $a) {
				DB::table('tcexam_packet')->insert([
					'peserta_ujian_id' => $pesertaUjian->id,
					'ujian_id' => $request->ujian_id,
					'soal_id' => $daftarSoal[$a]->id,
					'jawaban_soal' => $daftarSoal[$a]->jawaban,
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
		return redirect('/tcexam/mahasiswa');
    }

    public function finishTest(Request $request)
    {
		try {
			$pesertaUjian = TcExamPesertaUjian::find($request->peserta_ujian);
			$packets = $pesertaUjian->packet;
			$true = 0;
			$false = 0;
			foreach ($packets as $packet) {
				if ($packet->jawaban == $packet->jawaban_soal) {
					$true = $true + 1;
				}
				else{
					$false = $false + 1;
				}
			}
			$valueTrue = $pesertaUjian->ujians->true_answer;
			$valueFalse = $pesertaUjian->ujians->false_answer;
			$nilai = ($true*(int)$valueTrue) + ($false*(int)$valueFalse);
			$pesertaUjian->update(['status' => 1, 'total_true_answer' => $true, 'total_false_answer' => $false, 'nilai' => $nilai ]);

			return redirect()->back()->with('success', 'Finished Test!');
			
		} catch (\Exception $e) {
	        $eMessage = 'finish test - User: ' . Auth::user()->idUser . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	        // return $e->getMessage();
	    	return redirect()->back()->with('error', 'Whoops, something error!');
	    }
    }
    
}
