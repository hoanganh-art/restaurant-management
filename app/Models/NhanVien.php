<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;

    protected $table = 'nhan_viens';
    protected $primaryKey = 'MaNV';
    public $timestamps = true;

    protected $fillable = [
        'HoTen', 'VaiTro', 'SDT', 'Luong', 'TaiKhoan', 'MatKhau', 'NgayVaoLam'
    ];

    protected $hidden = [
        'MatKhau'
    ];

    // Quan hệ
    public function hoaDons()
    {
        return $this->hasMany(HoaDon::class, 'MaNV', 'MaNV');
    }

    public function datBans()
    {
        return $this->hasMany(DatBan::class, 'MaNV', 'MaNV');
    }

    public function phieuNhaps()
    {
        return $this->hasMany(PhieuNhap::class, 'MaNV', 'MaNV');
    }
}
