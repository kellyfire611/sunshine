<?php

use Illuminate\Database\Seeder;
use Illuminate\PhpVnDataGenerator\VnBase;
use Illuminate\PhpVnDataGenerator\VnFullname;
use Illuminate\PhpVnDataGenerator\VnPersonalInfo;

class KhuyenmaiTableSeeder extends Seeder {
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
                'km_ten'                  => "km_ten $i",
                'km_noiDung'              => "km_noiD $i",
                'km_batDau'               => $today->format('Y-m-d H:i:s'),
                'km_ketThuc'              => $today->format('Y-m-d H:i:s'),
                'km_giaTri'               => "km_giaTri $i",
                'nv_nguoiLap'             => $i,
                'km_ngayLap'              => $today->format('Y-m-d H:i:s'),
                'nv_kyNhay'               => $i,
                'km_ngayKyNhay'           => $today->format('Y-m-d H:i:s'),
                'nv_kyDuyet'              => $i,
                'km_ngayDuyet'            => $today->format('Y-m-d H:i:s'),
                'km_taoMoi'               => $today->format('Y-m-d H:i:s'),
                'km_capNhat'              => $today->format('Y-m-d H:i:s'),
                'km_trangThai'            => $i
            ]);
        }
        DB::table('cusc_khuyenmai')->insert($list);
    }
}