<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SanPham;
use App\Loai;
use Session;
use Storage;
use DB;

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
        $validation = $request->validate([
            'sp_hinh' => 'required|file|image|mimes:jpeg,png,gif,webp|max:2048',
            // Cú pháp dùng upload nhiều file
            'sp_hinhanhlienquan.*' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
        ]);
        
        //dd($request);

        try {
            DB::beginTransaction();
            
            $sp = new SanPham();
            $sp->sp_ten = $request->sp_ten;
            $sp->sp_giaGoc = $request->sp_giaGoc;
            $sp->sp_giaBan = $request->sp_giaBan;
            $sp->sp_thongTin = $request->sp_thongTin;
            $sp->sp_danhGia = $request->sp_danhGia;
            $sp->sp_taoMoi = $request->sp_taoMoi;
            $sp->sp_capNhat = $request->sp_capNhat;
            $sp->sp_trangThai = $request->sp_trangThai;
            $sp->l_ma = $request->l_ma;

            if($request->hasFile('sp_hinh'))
            {
                $file = $request->sp_hinh;

                // Lưu tên hình vào column sp_hinh
                $sp->sp_hinh = $file->getClientOriginalName();
                
                // Chép file vào thư mục "photos"
                $fileSaved = $file->storeAs('public/photos', $sp->sp_hinh);
            }
            $sp->save();

            // Lưu hình ảnh liên quan
            if($request->hasFile('sp_hinhanhlienquan')) {
                $files = $request->sp_hinhanhlienquan;
                dd($files);

                // duyệt từng ảnh và thực hiện lưu
                foreach ($request->sp_hinhanhlienquan as $index => $photo) {
                    $filename = $photo->store('public/photos');
                    
                    // Tạo đối tưọng HinhAnh
                    $hinhAnh = new HinhAnh();
                    $hinhAnh->sp_ma = $sp->sp_ma;
                    $hinhAnh->ha_stt = $index;
                    $hinhAnh->ha_ten = $filename;
                    $hinhAnh->save();
                }
            }
            DB::commit();

            Session::flash('alert-info', 'Them moi thanh cong ^^~!!!');
            return redirect()->route('danhsachsanpham.index');
        } catch(\Exception $e) {
            DB::rollback();

            Session::flash('alert-info', 'Them moi thanh cong ^^~!!!');
            return redirect()->route('danhsachsanpham.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sp = SanPham::where("sp_ma",  $id)->first();
        $ds_loai = Loai::all();

        return view('sanpham.edit')
            ->with('sp', $sp)
            ->with('danhsachloai', $ds_loai);
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
        $sp = SanPham::where("sp_ma",  $id)->first();
        $sp->sp_ten = $request->sp_ten;
        $sp->sp_giaGoc = $request->sp_giaGoc;
        $sp->sp_giaBan = $request->sp_giaBan;
        $sp->sp_thongTin = $request->sp_thongTin;
        $sp->sp_danhGia = $request->sp_danhGia;
        $sp->sp_taoMoi = $request->sp_taoMoi;
        $sp->sp_capNhat = $request->sp_capNhat;
        $sp->sp_trangThai = $request->sp_trangThai;
        $sp->l_ma = $request->l_ma;

        if($request->hasFile('sp_hinh'))
        {
            // Xóa hình cũ để tránh rác
            Storage::delete('public/photos/' . $sp->sp_hinh);

            // Upload hình mới
            // Lưu tên hình vào column sp_hinh
            $file = $request->sp_hinh;
            $sp->sp_hinh = $file->getClientOriginalName();
            
            // Chép file vào thư mục "photos"
            $fileSaved = $file->storeAs('public/photos', $sp->sp_hinh);
        }

        $sp->save();

        Session::flash('alert-info', 'Cập nhật thành công ^^~!!!');
        return redirect()->route('danhsachsanpham.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sp = SanPham::where("sp_ma",  $id)->first();
        if(empty($sp) == false)
        {
            // Xóa hình cũ để tránh rác
            Storage::delete('public/photos/' . $sp->sp_hinh);
        }

        $sp->delete();

        Session::flash('alert-info', 'Xóa sản phẩm thành công ^^~!!!');
        return redirect()->route('danhsachsanpham.index');
    }
}