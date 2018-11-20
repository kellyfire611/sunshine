<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoaiRequest;
use App\Loai;
use DB;
use Session;
use Validator;

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

    public function create() {

    }

    public function store() {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loai = Loai::where("l_ma", $id)->first();
        return view('loai.edit')->with('loai', $loai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LoaiRequest $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'l_ten' => 'required|unique:cusc_loai|max:60',
        //     'l_taoMoi' => 'required',
        //     'l_capNhat' => 'required',
        //     'l_trangThai' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return redirect(route('danhsachloai.edit', ['id' => $id]))
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }

        $loai = Loai::where("l_ma", $id)->first();
        $loai->l_ten = $request->l_ten;
        $loai->l_taoMoi = $request->l_taoMoi;
        $loai->l_capNhat = $request->l_capNhat;
        $loai->l_trangThai = $request->l_trangThai;
        $loai->save();

        Session::flash('alert-info', 'Cap nhat thanh cong ^^~!!!');
        return redirect()->route('danhsachloai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loai = Loai::where("l_ma",  $id)->first();
        $loai->delete();

        Session::flash('alert-danger', 'Xoa du lieu thanh cong ^^~!!!');
        return redirect()->route('danhsachloai.index');
    }
}
