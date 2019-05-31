<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\TcExamSoal;
use App\TcExamUjian;
use App\TcExamPacket;
use App\TcExamPesertaUjian;
use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use Log;
use DB;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMahasiswaPage()
    {
        return view('tcexam.pages.mahasiswa.index');
    }   

    public function getDosenPage()
    {
        return view('tcexam.pages.dosen.index');
    }

    public function getTambahUjianPage()
    {
        // $matkul = DB::table('agenda')->where('fk_idPIC',Auth::user()->kode)->get();
        return view('tcexam.pages.dosen.tambah-ujian');
    }

    public function getListUjianPage()
    {
        return view('tcexam.pages.dosen.list-ujian');
    }

    public function getListUjianData()
    {
        $listUjian = TcExamUjian::where('id_dosen', Auth::user()->kode)->get();
        return response()->json(['data' => $listUjian]);
    }

    public function getUjianData($id)
    {
        return response()->json(['ujian' => TcExamUjian::where('id_dosen', Auth::user()->kode)->where('id', $id)->first()]);
    }

    public function getSoalData($id)
    {
        return response()->json(['soal' => TcExamSoal::find($id)]);
    }

    public function finishTour(Request $request) {
        $user = User::where('kode', Auth::user()->kode)->update(['has_finish_tour' => 1]);
        return response()->json(['message' => $user], 200);
    }

    public function getHistoryPage()
    {
        return view('tcexam.pages.mahasiswa.historis');
    }

    public function getPesertaUjianPage($id)
    {
        $ujian = TcExamUjian::where('id_dosen', Auth::user()->kode)->where('id', $id)->first();
        if (!$ujian) {
            return redirect('tcexam/dosen/');
        }
        $users = User::where('role', 'mahasiswa')->get();
        return view('tcexam.pages.dosen.peserta_ujian', compact('ujian', 'users'));
    }

    public function getSoalUjianPage($id)
    {
        // return $id;
        $ujian = TcExamUjian::where('id_dosen', Auth::user()->kode)->where('id', $id)->first();
        if (!$ujian) {
            return "500, This is not your authority";
        }
        $listUjian = TcExamUjian::where('id_dosen', Auth::user()->kode)->where('id', '!=' , $id)->get();
        return view('tcexam.pages.dosen.soal_ujian', compact('ujian', 'listUjian'));
    }

    public function getUjianPage($id, $name, Request $request)
    {
        // $starts = microtime(true);
        $ujian = TcExamUjian::find($id);
        $status = 0;
        foreach ($ujian->peserta as $peserta) {
            if ($peserta->user_id == Auth::user()->kode) {
                $status = 1;
                break;
            }
        }
        // return $status;
        if ($status) {
            $packets = TcExamPesertaUjian::where('ujian_id', $ujian->id)->where('user_id', Auth::user()->kode)->first();
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
                return view('tcexam.pages.mahasiswa.ujian-joined', compact('ujian', 'total', 'soal', 'index', 'packets'));
            }
            elseif ($packets->status==1) {
                // return "You already ended test! nilai : ".$packets->nilai;
                $nilai = $packets->nilai;
                return view('tcexam.pages.mahasiswa.ujian-done', compact('ujian', 'nilai'));
            }
            return view('tcexam.pages.mahasiswa.ujian', compact('ujian', 'packets'));
        }
        return redirect('tcexam/mahasiswa/');
    }

    public function raguRagu(Request $request){
        try {
            TcExamPacket::find($request->packet_id)->update(['status' => -1]);
            return redirect()->back(); 
        } catch (\Exception $e) {
            $eMessage = 'ragu-ragu - User: ' . Auth::user()->kode . ', error: ' . $e->getMessage();
            Log::emergency($eMessage);
            return redirect()->back()->with('error', 'Whoops, something error!'); 
        }
    }

    public function yakinJawab(Request $request){
        try {
            TcExamPacket::find($request->packet_id)->update(['status' => 1]);
            return redirect()->back(); 
        } catch (\Exception $e) {
            $eMessage = 'yakin - User: ' . Auth::user()->kode . ', error: ' . $e->getMessage();
            Log::emergency($eMessage);
            return redirect()->back()->with('error', 'Whoops, something error!'); 
        }
    }

    public function jawabSoal(Request $request){
        try {
            TcExamPacket::find($request->packet_id)->update(['jawaban' => $request->jawaban, 'status' => 1]);
            return redirect()->back(); 
        } catch (\Exception $e) {
            $eMessage = 'jawab - User: ' . Auth::user()->kode . ', error: ' . $e->getMessage();
            Log::emergency($eMessage);
            return redirect()->back()->with('error', 'Whoops, something error!'); 
        }
    }

    public function resetSoal(Request $request){
        try {
            TcExamPacket::find($request->packet_id)->update(['jawaban' => null, 'status' => 0]);
            return redirect()->back(); 
        } catch (\Exception $e) {
            $eMessage = 'jawab - User: ' . Auth::user()->kode . ', error: ' . $e->getMessage();
            Log::emergency($eMessage);
            return redirect()->back()->with('error', 'Whoops, something error!'); 
        }
    }

    public function getUjianDoneQuestion($id, $kode){
        $packets = TcExamPesertaUjian::where('ujian_id', $id)->where('user_id', $kode)->first();
        return view('tcexam.pages.dosen.soal_read_only', compact('packets'));
        return $packets->packet;
    }

    public function exportNilai($id){
        $ujian = TcExamUjian::find($id);

        date_default_timezone_set('Asia/Jakarta');
        $format = 'Y-m-d H:i:s';
        $end = date($format,strtotime(substr($ujian->date_end, 0, 11).$ujian->time_end));
        $now = date($format);

        if ($now <= $end) {
            return "Anda tidak dapat export sampai ujian telah selesai";
        }

        $peserta = $ujian->peserta;

        foreach ($peserta as $pes) {
            if (strlen($pes->soal)>0 && $pes->nilai==null) {
                $packets = $pes->packet;
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
                $valueTrue = $pes->ujians->true_answer;
                $valueFalse = $pes->ujians->false_answer;
                $nilai = ($true*(100/count($packets))) + ($false*(int)$valueFalse);
                $pes->update(['status' => 1, 'total_true_answer' => $true, 'total_false_answer' => $false, 'nilai' => $nilai ]);
            }
        }
        $jumlahSoal = count($ujian->soals);
        $nilaiSalah = $ujian->false_answer;
        $data = array(['NO', 'NRP', 'NAMA', 'JUMLAH BENAR', 'JUMLAH SALAH', 'NILAI']);
        $no=1;
        foreach ($peserta as $p) {
            array_push($data, [$no++, $p->user_id, $p->user->name, $p->total_true_answer, $p->total_false_answer, $p->nilai]);
        }
        $export = new NilaiExport([
            $data
        ]);

        return Excel::download($export, 'Rekap Nilai '.$ujian->nama.'.xlsx');
        return $ujian->peserta;
    }
}
