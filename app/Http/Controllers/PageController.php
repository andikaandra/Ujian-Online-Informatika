<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Ujian;
use App\User;

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
        return view('pages.dosen.tambah-ujian');
    }

    public function getListUjianPage()
    {
        return view('pages.dosen.list-ujian');
    }

    public function getListUjianData()
    {
        $listUjian = Ujian::where('id_dosen', Auth::user()->id)->get();
        return response()->json(['data' => $listUjian]);
    }

    public function getUjianData($id)
    {
        return response()->json(['ujian' => Ujian::find($id)]);
    }

    public function finishTour(Request $request) {
        $user = User::find(Auth::user()->id)->update(['has_finish_tour' => 1]);
        return response()->json(['message' => $user], 200);
    }

}
