<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SanPham;
use App\Loai;
use Session;

class SanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Eloquent Model de lay du lieu
        $ds_sanpham = SanPham::all(); // SELECT * FROM cusc_sanpham

        return view('sanpham.index')
            ->with('danhsachsanpham', $ds_sanpham);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ds_loai = Loai::all();

        return view('sanpham.create')
            ->with('danhsachloai', $ds_loai);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sp = new SanPham();
        $sp->sp_ten = $request->sp_ten;

        if($request->hasFile('sp_hinh'))
        {
            $file = $request->sp_hinh;
            // Lưu tên hình vào column sp_hinh
            $sp->sp_hinh = $file->getClientOriginalName();

            // Chép file vào thư mục "photos"
            $file->store('photos');
        }

        $sp->save();

        Session::flash('alert-info', 'Them moi thanh cong ^^~!!!');
        return redirect()->route('danhsachsanpham.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
