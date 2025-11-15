<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;

    protected $table = 'hoa_dons';
    protected $primaryKey = 'MaHD';
    public $timestamps = true;

    protected $fillable = [
        'MaKH', 'MaNV', 'MaBan', 'NgayHD', 'TongTien', 'PhuongThucTT', 'GhiChu'
    ];

    protected $casts = [
        'NgayHD' => 'datetime',
        'TongTien' => 'decimal:2'
    ];

    // Quan hệ
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }

    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'MaNV', 'MaNV');
    }

    public function banAn()
    {
        return $this->belongsTo(BanAn::class, 'MaBan', 'MaBan');
    }

    public function chiTietHoaDons()
    {
        return $this->hasMany(ChiTietHoaDon::class, 'MaHD', 'MaHD');
    }

    public function danhGia()
    {
        return $this->hasOne(DanhGia::class, 'MaHD', 'MaHD');
    }

    public function khuyenMais()
    {
        return $this->belongsToMany(KhuyenMai::class, 'hoa_don_khuyen_mais', 'MaHD', 'MaKM')
                    ->withPivot('GiaTriGiam')
                    ->withTimestamps();
    }

    // Tính tổng tiền
    public function tinhTongTien()
    {
        return $this->chiTietHoaDons->sum('ThanhTien');
    }

    // Scope thống kê
    public function scopeTheoThang($query, $thang, $nam)
    {
        return $query->whereYear('NgayHD', $nam)
                    ->whereMonth('NgayHD', $thang);
    }
}
