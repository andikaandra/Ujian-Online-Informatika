<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        return view('pages.dosen.index');
    }

    public function getListUjianPage()
    {
        return view('pages.dosen.index');
    }

}
