<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Ujian;

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
        $listUjian = Ujian::where('id_dosen', Auth::user()->id)->get();
        return view('pages.dosen.list-ujian', compact('listUjian'));
    }

}
