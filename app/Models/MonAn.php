<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonAn extends Model
{
    use HasFactory;

    protected $table = 'mon_ans';
    protected $primaryKey = 'MaMon';
    public $timestamps = true;

    protected $fillable = [
        'TenMon', 'MoTa', 'Gia', 'Loai'
    ];

    // Quan hệ
    public function chiTietHoaDons()
    {
        return $this->hasMany(ChiTietHoaDon::class, 'MaMon', 'MaMon');
    }

    public function congThucs()
    {
        return $this->hasMany(CongThuc::class, 'MaMon', 'MaMon');
    }

    // Scope tìm kiếm
    public function scopeTheoLoai($query, $loai)
    {
        return $query->where('Loai', $loai);
    }

    public function scopeTimKiem($query, $keyword)
    {
        return $query->where('TenMon', 'like', "%{$keyword}%")
                    ->orWhere('MoTa', 'like', "%{$keyword}%");
    }
}
