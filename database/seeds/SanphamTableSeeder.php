<?php

use Illuminate\Database\Seeder;
use Illuminate\PhpVnDataGenerator\VnBase;
use Illuminate\PhpVnDataGenerator\VnFullname;
use Illuminate\PhpVnDataGenerator\VnPersonalInfo;

class SanphamTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $list = [];
        $uFN = new VnFullname();
        $uPI = new VnPersonalInfo();

        for ($i=1; $i <= 30; $i++) {
            $today = new DateTime();
            array_push($list, [
                'sp_ten'                  => "sp_ten $i",
                'sp_giaGoc'               => $i,
                'sp_giaBan'               => $i,
                'sp_hinh'                 => "sp_hinh $i",
                'sp_thongTin'             => "sp_thong $i",
                'sp_danhGia'              => "sp_danhGia $i",
                'sp_taoMoi'               => $today->format('Y-m-d H:i:s'),
                'sp_capNhat'              => $today->format('Y-m-d H:i:s'),
                'sp_trangThai'            => $i,
                'l_ma'                    => $i
            ]);
        }
        DB::table('cusc_sanpham')->insert($list);
    }
}