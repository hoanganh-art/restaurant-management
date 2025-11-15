<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_hoa_dons';
    protected $primaryKey = 'MaCTHD';
    public $timestamps = true;

    protected $fillable = [
        'MaHD', 'MaMon', 'SoLuong', 'ThanhTien'
    ];

    // Quan hệ
    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'MaHD', 'MaHD');
    }

    public function monAn()
    {
        return $this->belongsTo(MonAn::class, 'MaMon', 'MaMon');
    }

    // Tự động tính thành tiền
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $monAn = MonAn::find($model->MaMon);
            if ($monAn) {
                $model->ThanhTien = $monAn->Gia * $model->SoLuong;
            }
        });

        static::updating(function ($model) {
            $monAn = MonAn::find($model->MaMon);
            if ($monAn) {
                $model->ThanhTien = $monAn->Gia * $model->SoLuong;
            }
        });
    }
}
