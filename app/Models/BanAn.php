<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanAn extends Model
{
    use HasFactory;

    protected $table = 'ban_ans';
    protected $primaryKey = 'MaBan';
    public $timestamps = true;

    protected $fillable = [
        'TenBan', 'SoGhe', 'KhuVuc', 'TrangThai'
    ];

    // Quan hệ
    public function hoaDons()
    {
        return $this->hasMany(HoaDon::class, 'MaBan', 'MaBan');
    }

    public function datBans()
    {
        return $this->hasMany(DatBan::class, 'MaBan', 'MaBan');
    }
}
