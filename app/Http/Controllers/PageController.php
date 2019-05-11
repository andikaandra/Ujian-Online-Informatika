<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TcExamSoal;
use App\TcExamUjian;
use App\TcExamPacket;
use App\TcExamPesertaUjian;
use Auth;
use Log;
use DB;

class PageController extends Controller
{
    public function getMahasiswaPage()
    {
        return view('pages.mahasiswa.index');
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
        $listUjian = TcExamUjian::where('id_dosen', Auth::user()->idUser)->get();
        return response()->json(['data' => $listUjian]);
    }

    public function getUjianData($id)
    {
        return response()->json(['ujian' => TcExamUjian::where('id_dosen', Auth::user()->idUser)->where('id', $id)->first()]);
    }

    public function getSoalData($id)
    {
        return response()->json(['soal' => TcExamSoal::find($id)]);
    }

    public function finishTour(Request $request) {
        $user = User::find(Auth::user()->id)->update(['has_finish_tour' => 1]);
        return response()->json(['message' => $user], 200);
    }

    public function getHistoryPage()
    {
        return view('pages.mahasiswa.historis');
    }

    public function getPesertaUjianPage($id)
    {
        $ujian = TcExamUjian::where('id_dosen', Auth::user()->idUser)->where('id', $id)->first();
        if (!$ujian) {
            return redirect('tcexam/dosen/');
        }
        $users = User::where('role', 'mahasiswa')->get();
        return view('pages.dosen.peserta_ujian', compact('ujian', 'users'));
    }

    public function getSoalUjianPage($id)
    {
        // return $id;
        $ujian = TcExamUjian::where('id_dosen', Auth::user()->idUser)->where('id', $id)->first();
        if (!$ujian) {
            return "500, This is not your authority";
        }
        $listUjian = TcExamUjian::where('id_dosen', Auth::user()->idUser)->where('id', '!=' , $id)->get();
        return view('pages.dosen.soal_ujian', compact('ujian', 'listUjian'));
    }

    public function getUjianPage($id, $name, Request $request)
    {
        // $starts = microtime(true);
        $ujian = TcExamUjian::find($id);
        $status = 0;
        foreach ($ujian->peserta as $peserta) {
            if ($peserta->user_id == Auth::user()->idUser) {
                $status = 1;
                break;
            }
        }
        // return $status;
        if ($status) {
            $packets = TcExamPesertaUjian::where('ujian_id', $ujian->id)->where('user_id', Auth::user()->idUser)->first();
            date_default_timezone_set('Asia/Jakarta');
            $format = 'Y-m-d H:i:s';
            $start = date($format,strtotime(substr($ujian->date_start, 0, 11).$ujian->time_start));
            $end = date($format,strtotime(substr($ujian->date_end, 0, 11).$ujian->time_end));
            $now = date($format);
            if ($packets && strlen($packets->soal)>0 && $now <= $end && $now > $start && $packets->status==0) {
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
                // return microtime(true) - $starts;
                return view('pages.mahasiswa.ujian-joined', compact('ujian', 'total', 'soal', 'index', 'packets'));
            }
            elseif ($packets->status==1) {
                // return "You already ended test! nilai : ".$packets->nilai;
                $nilai = $packets->nilai;
                return view('pages.mahasiswa.ujian-done', compact('ujian', 'nilai'));
            }
            return view('pages.mahasiswa.ujian', compact('ujian'));
        }
        return redirect('tcexam/mahasiswa/');
    }

    public function getUjianPageDummy($id, $flag)
    {
        if ($flag=='authority') {
            $packets = TcExamPesertaUjian::where('ujian_id', $id)->where('user_id', Auth::user()->idUser)->first();
            return $packets->packet;
        }
        return '404';
    }

    public function raguRagu(Request $request){
        try {
            TcExamPacket::find($request->packet_id)->update(['status' => -1]);
            return redirect()->back(); 
        } catch (\Exception $e) {
            $eMessage = 'ragu-ragu - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
            Log::emergency($eMessage);
            return redirect()->back()->with('error', 'Whoops, something error!'); 
        }
    }

    public function yakinJawab(Request $request){
        try {
            TcExamPacket::find($request->packet_id)->update(['status' => 1]);
            return redirect()->back(); 
        } catch (\Exception $e) {
            $eMessage = 'yakin - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
            Log::emergency($eMessage);
            return redirect()->back()->with('error', 'Whoops, something error!'); 
        }
    }

    public function jawabSoal(Request $request){
        try {
            TcExamPacket::find($request->packet_id)->update(['jawaban' => $request->jawaban, 'status' => 1]);
            return redirect()->back(); 
        } catch (\Exception $e) {
            $eMessage = 'jawab - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
            Log::emergency($eMessage);
            return redirect()->back()->with('error', 'Whoops, something error!'); 
        }
    }

    public function resetSoal(Request $request){
        try {
            TcExamPacket::find($request->packet_id)->update(['jawaban' => null, 'status' => 0]);
            return redirect()->back(); 
        } catch (\Exception $e) {
            $eMessage = 'jawab - User: ' . Auth::user()->id . ', error: ' . $e->getMessage();
            Log::emergency($eMessage);
            return redirect()->back()->with('error', 'Whoops, something error!'); 
        }
    }

}
