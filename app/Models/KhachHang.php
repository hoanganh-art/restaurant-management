<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;

    protected $table = 'khach_hangs';
    protected $primaryKey = 'MaKH';
    public $timestamps = true;

    protected $fillable = [
        'HoTen', 'SDT', 'Email', 'DiemTichLuy'
    ];

    // Quan hệ
    public function hoaDons()
    {
        return $this->hasMany(HoaDon::class, 'MaKH', 'MaKH');
    }

    public function datBans()
    {
        return $this->hasMany(DatBan::class, 'MaKH', 'MaKH');
    }

    public function danhGias()
    {
        return $this->hasMany(DanhGia::class, 'MaKH', 'MaKH');
    }
}
