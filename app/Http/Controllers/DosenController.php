<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TcExamSoal;
use App\TcExamUjian;
use App\TcExamPesertaUjian;
use Validator;
use Auth;
use Log;
use DB;

class DosenController extends Controller
{
    public function setTambahUjian(Request $request)
    {
    	// return $request;
		try {
			$ujian = TcExamUjian::create([
				'nama' => $request->nama,
				'id_dosen' => Auth::user()->idUser,
				'true_answer'	=>	100/$request->jumlah_soal,
				'false_answer'	=>	$request->nilai_salah,
				'pass_test'	=>	$request->pass_test,
				'jumlah_soal'	=>	$request->jumlah_soal,
				'result_to_user'	=>	$request->result,
				'report_to_user'	=>	$request->report,
				'date_start'	=>	$request->tanggal_mulai,
				'date_end'	=>	$request->tanggal_akhir,
				'time_start'	=>	$request->waktu_mulai,
				'time_end'	=>	$request->waktu_akhir,
	      	]);

	      	$peserta =  DB::table('kehadiran')->where('idAgenda', $request->idAgenda)->get();
			foreach ($peserta as $p) {
				TcExamPesertaUjian::updateOrCreate ([
					'ujian_id' => $ujian->id,
					'user_id' => $p->idUser
		      	]);
			}

		} catch (\Exception $e) {
	        $eMessage = 'new ujian - User: ' . Auth::user()->idUser . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }
	    return redirect('tcexam/dosen/list-ujian')->with('success', 'Test successfully created!'); 
    }

    public function setUpdateUjian(Request $request)
    {
    	// return $request;
		try {
			TcExamUjian::find($request->id_ujian)->update([
				'nama' => $request->nama,
				'true_answer'	=>	100/$request->jumlah_soal,
				'false_answer'	=>	$request->nilai_salah,
				'pass_test'	=>	$request->pass_test,
				'jumlah_soal'	=>	$request->jumlah_soal,
				'result_to_user'	=>	$request->result,
				'report_to_user'	=>	$request->report,
				'date_start'	=>	$request->tanggal_mulai,
				'date_end'	=>	$request->tanggal_akhir,
				'time_start'	=>	$request->waktu_mulai,
				'time_end'	=>	$request->waktu_akhir,
      	]);
		} catch (\Exception $e) {
	        $eMessage = 'update ujian - User: ' . Auth::user()->idUser . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }
	    return redirect('tcexam/dosen/list-ujian')->with('success', 'Test successfully updated!'); 
    }

    public function setTambahPeserta(Request $request)
    {
		try {
			foreach ($request->peserta as $peserta) {
				TcExamPesertaUjian::updateOrCreate ([
					'ujian_id' => $request->ujian_id,
					'user_id' => $peserta
		      	]);
			}
		} catch (\Exception $e) {
	        $eMessage = 'new participant - User: ' . Auth::user()->idUser . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return response()->json(['error' => $eMessage]);
	    }
	    return response()->json(['success' => 'Success!']);
    }

    public function deletePeserta(Request $request)
    {
		try {
			TcExamPesertaUjian::find($request->id)->delete();
		} catch (\Exception $e) {
	        $eMessage = 'delete participant - User: ' . Auth::user()->idUser . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }
	    return redirect()->back()->with('success', 'Delete Success!');
    }


    public function setTambahSoal(Request $request)
    {
		try {
	        $validator = Validator::make($request->all(), [
	            'description' =>  'required|max:2000',
	            'pilihan1' => 'required|max:600',
	            'pilihan2' => 'required|max:600',
	            'pilihan3' => 'required|max:600',
	            'pilihan4' => 'required|max:600',
	            'jawaban' => 'required|max:600'
	        ]);

	        if ($validator->fails()) {
	            return redirect()->back()->withErrors($validator)->withInput();
	        }

			$soal = new TcExamSoal;

		    $soal->ujian_id = $request->ujian_id;
		    $soal->deskripsi = $request->description;
		    $soal->pilihan_a = $request->pilihan1;
		    $soal->pilihan_b = $request->pilihan2;
		    $soal->pilihan_c = $request->pilihan3;
		    $soal->pilihan_d = $request->pilihan4;
		    $soal->jawaban = $request->{$request->jawaban};
        	if ($request->pilihan5!='') {
	    		$validator = Validator::make($request->all(), [
    	            'pilihan5' => 'required|max:600',
	        	]);
				if ($validator->fails()) {
		            return redirect()->back()->withErrors($validator);
		        }
    			$soal->pilihan_e = $request->pilihan5;
    		}
	    	if ($request->image) {
	    		$validator = Validator::make($request->all(), [
    	            'image' => 'bail|required|max:1000'
	        	]);
				if ($validator->fails()) {
		            return redirect()->back()->withErrors($validator);
		        }

	    		$file_path = $request->file('image')->store('public/question-image/'.$request->ujian_id);

	    		$soal->file_path = str_replace("public","", $file_path);
	    	}
		    $soal->save();
		} catch (\Exception $e) {
	        $eMessage = 'new soal - User: ' . Auth::user()->idUser . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', $eMessage); 
	    }
	    return redirect()->back()->with('success', 'Question successfully created!');
    }

    public function deleteSoal(Request $request)
    {
		try {
			TcExamSoal::find($request->id)->delete();
		} catch (\Exception $e) {
	        $eMessage = 'delete soal - User: ' . Auth::user()->idUser . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }
	    return redirect()->back()->with('success', 'Delete Success!');
    }

    public function importSoal(Request $request){
		try {
	    	$ujian = TcExamUjian::find($request->ujian);
	    	$jumlahSoalYgDiimport = count($ujian->soals);

	    	$ujianSekarang = TcExamUjian::find($request->ujianid);
	    	if (count($ujianSekarang->soals) + $jumlahSoalYgDiimport > $ujianSekarang->jumlah_soal) {
	    		return redirect()->back()->with('error', 'Jumlah soal tidak boleh melebihi kapasitas!'); 
	    	}
	    	foreach ($ujian->soals as $u) {
				TcExamSoal::create([
					'ujian_id'	=>	$request->ujianid,
					'deskripsi'	=>	$u->deskripsi,
					'file_path'	=>	$u->file_path,
					'pilihan_a'	=>	$u->pilihan_a,
					'pilihan_b'	=>	$u->pilihan_b,
					'pilihan_c'	=>	$u->pilihan_c,
					'pilihan_d'	=>	$u->pilihan_d,
					'pilihan_e'	=>	$u->pilihan_e,
					'status'	=>	$u->status,
					'jawaban'	=>	$u->jawaban,
		      	]);
	    	}
		} catch (\Exception $e) {
	        $eMessage = 'import soal - User: ' . Auth::user()->idUser . ', error: ' . $e->getMessage();
	        Log::emergency($eMessage);
	    	return redirect()->back()->with('error', 'Whoops, something error!'); 
	    }
	    return redirect()->back()->with('success', 'Import from '.$ujian->name.' Success!');
    }
    
}
