<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Soal;
use App\Ujian;
use App\Packet;
use App\PesertaUjian;
use Auth;
use Log;
use DB;

class PageController extends Controller
{
    public function getMahasiswaPage()
    {
        return view('pages.mahasiswa.index');
    }

    public function getDataFillingPage()
    {
    	if (Auth::user()->role == "mahasiswa") {
	        return view('pages.mahasiswa.fill-data');
    	}
    	return view('pages.dosen.fill-data');
    }    

    public function getDosenPage()
    {
        return view('pages.dosen.index');
    }

    public function getTambahUjianPage()
    {
        $matkul = DB::table('agenda')->where('fk_idPIC',Auth::user()->idUser)->get();
        return view('pages.dosen.tambah-ujian', compact('matkul'));
    }

    public function getListUjianPage()
    {
        return view('pages.dosen.list-ujian');
    }

    public function getListUjianData()
    {
        $listUjian = Ujian::where('id_dosen', Auth::user()->idUser)->get();
        return response()->json(['data' => $listUjian]);
    }

    public function getUjianData($id)
    {
        return response()->json(['ujian' => Ujian::where('id_dosen', Auth::user()->idUser)->where('id', $id)->first()]);
    }

    public function getSoalData($id)
    {
        return response()->json(['soal' => Soal::find($id)]);
    }

    public function finishTour(Request $request) {
        $user = User::find(Auth::user()->id)->update(['has_finish_tour' => 1]);
        return response()->json(['message' => $user], 200);
    }

    public function getHistoryPage()
    {
        // $ujian = PesertaUjian::where('user_id', Auth::user()->idUser)->get();
        // // return $ujian[0]->ujians;
        // return $ujian;
        // return Auth::user()->ujians;
        return view('pages.mahasiswa.historis', compact('ujian'));
    }

    public function getPesertaUjianPage($id)
    {
        $ujian = Ujian::where('id_dosen', Auth::user()->idUser)->where('id', $id)->first();
        if (!$ujian) {
            return redirect('dosen/');
        }
        $users = User::where('role', 'mahasiswa')->get();
        return view('pages.dosen.peserta_ujian', compact('ujian', 'users'));
    }

    public function getSoalUjianPage($id)
    {
        // return $id;
        $ujian = Ujian::where('id_dosen', Auth::user()->idUser)->where('id', $id)->first();
        $users = User::where('role', 'mahasiswa')->get();
        return view('pages.dosen.soal_ujian', compact('ujian', 'users'));
    }

    public function getUjianPage($id, $name, Request $request)
    {
        $ujian = Ujian::find($id);
        $status = 0;
        foreach ($ujian->peserta as $peserta) {
            if ($peserta->user_id == Auth::user()->idUser) {
                $status = 1;
                break;
            }
        }
        // return $status;
        if ($status) {
            $packets = PesertaUjian::where('ujian_id', $ujian->id)->where('user_id', Auth::user()->idUser)->first();
            date_default_timezone_set('Asia/Jakarta');
            $format = 'Y-m-d H:i:s';
            $start = date($format,strtotime(substr($ujian->date_start, 0, 11).$ujian->time_start));
            $end = date($format,strtotime(substr($ujian->date_end, 0, 11).$ujian->time_end));
            $now = date($format);
            if ($packets && strlen($packets->soal)>0 && $now <= $end && $now > $start) {
                $daftarSoal = $packets->packet;
                $total = count($daftarSoal);
                if ($request->packet_id) {
                    $soal = $daftarSoal[$request->packet_id];
                    $index = $request->packet_id;
                }
                else{
                    $soal = $packets->packet[0];
                    $index = 0;
                }
                // return $soal->id;
                return view('pages.mahasiswa.ujian-joined', compact('ujian', 'total', 'soal', 'index'));
            }
            return view('pages.mahasiswa.ujian', compact('ujian'));
        }
        return redirect('mahasiswa/');
    }

    public function changeQuestion(Request $request)
    {
        return $request;
        return view('pages.dosen.soal_ujian', compact('ujian', 'users'));
    }

}
