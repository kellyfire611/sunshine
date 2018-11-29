<?php

namespace App\Exports;

use App\SanPham;
use App\Loai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SanPhamExport implements FromView
{
    public function view(): View
    {
        return view('sanpham.excel', [
            'danhsachsanpham' => SanPham::all(),
            'danhsachloai' => Loai::all(),
        ]);
    }
}
