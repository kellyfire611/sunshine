<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SanPham extends Model
{
    const     CREATED_AT    = 'sp_taoMoi';
    const     UPDATED_AT    = 'sp_capNhat';

    protected $table        = 'cusc_sanpham';
    protected $fillable     = ['sp_ten', 'sp_giaGoc', 'sp_giaBan', 'sp_hinh', 'sp_thongTin', 'sp_danhGia', 'sp_taoMoi', 'sp_capNhat', 'sp_trangThai', 'l_ma'];
    protected $guarded      = ['sp_ma'];

    protected $primaryKey   = 'sp_ma';

    protected $dates        = ['sp_taoMoi', 'sp_capNhat'];
    protected $dateFormat   = 'Y-m-d H:i:s';

    public function getSpTaoMoiAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }

    public function setSpTaoMoiAttribute($value)
    {
        $this->attributes['sp_taoMoi'] = Carbon::createFromFormat('d/m/Y H:i:s', $value);
    }

    public function getSpCapNhatAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }

    public function setSpCapNhatAttribute($value)
    {
        $this->attributes['sp_capNhat'] = Carbon::createFromFormat('d/m/Y H:i:s', $value);
    }

    public function loaisanpham()
    {
        return $this->belongsTo('App\Loai', 'l_ma', 'l_ma');
    }
}
