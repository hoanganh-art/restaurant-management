<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HoaDon;
use App\Models\BanAn;
use App\Models\DanhGia;
use App\Models\MonAn;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Doanh thu hôm nay
        $doanhThuHomNay = HoaDon::whereDate('NgayHD', $today)->sum('TongTien');

        // Số hóa đơn hôm nay
        $soHoaDonHomNay = HoaDon::whereDate('NgayHD', $today)->count();

        // Thống kê bàn
        $banDangPhucVu = BanAn::where('TrangThai', 'Đang phục vụ')->count();
        $tongSoBan = BanAn::count();
        $tongSoBan = max($tongSoBan, 1); // Ensure tongSoBan is at least 1 to avoid division by zero

        // Đánh giá trung bình
        $danhGiaTrungBinh = 4.5; // Define this variable

        // Top món ăn bán chạy
        $topMonAn = MonAn::withCount(['chiTietHoaDons as so_luong_ban' => function($query) {
            $query->select(DB::raw('SUM(SoLuong)'));
        }])->withSum('chiTietHoaDons as doanh_thu', 'ThanhTien')
        ->orderBy('so_luong_ban', 'desc')
        ->limit(5);
        // ->get();

        return view('dashboard.index', compact(
            'doanhThuHomNay',
            'soHoaDonHomNay',
            'banDangPhucVu',
            'tongSoBan',
            'danhGiaTrungBinh',
            'topMonAn'
        ));
    }
}
