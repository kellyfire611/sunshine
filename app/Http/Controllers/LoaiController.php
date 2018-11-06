<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loai;
use DB;

class LoaiController extends Controller
{
    public function index()
    {
        // Eloquent Model de lay du lieu
        //$ds_loai = Loai::all(); // SELECT * FROM cusc_loai

        // Query Builder
        $ds_loai = DB::table('cusc_loai')->get();
        
        return view('loai.index')
            ->with('danhsachloai', $ds_loai);
    }
}
