<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\BanAn;
use App\Models\MonAn;
use App\Models\KhachHang;
use App\Models\NhanVien;

class HoaDonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doanhThuHomNay = HoaDon::whereDate('created_at', today())->sum('tong_tien');

        return view('hoa-don.index', compact('doanhThuHomNay'));
    }

    public function create()
    {
        $banAns = BanAn::where('TrangThai', 'Trống')->get();
        $monAns = MonAn::all();
        $khachHangs = KhachHang::all();
        $nhanViens = NhanVien::all();

        return view('hoa-don.create', compact('banAns', 'monAns', 'khachHangs', 'nhanViens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'MaKH' => 'required|exists:khach_hangs,MaKH',
            'MaNV' => 'required|exists:nhan_viens,MaNV',
            'MaBan' => 'required|exists:ban_ans,MaBan',
            'mon_ans' => 'required|array',
            'so_luongs' => 'required|array'
        ]);

        // Tạo hóa đơn
        $hoaDon = HoaDon::create([
            'MaKH' => $request->MaKH,
            'MaNV' => $request->MaNV,
            'MaBan' => $request->MaBan,
            'GhiChu' => $request->GhiChu
        ]);

        // Thêm chi tiết hóa đơn
        foreach ($request->mon_ans as $index => $maMon) {
            $hoaDon->chiTietHoaDons()->create([
                'MaMon' => $maMon,
                'SoLuong' => $request->so_luongs[$index]
            ]);
        }

        // Cập nhật tổng tiền
        $hoaDon->update(['TongTien' => $hoaDon->tinhTongTien()]);

        // Cập nhật trạng thái bàn
        BanAn::where('MaBan', $request->MaBan)->update(['TrangThai' => 'Đang phục vụ']);

        return redirect()->route('hoa-don.index')->with('success', 'Tạo hóa đơn thành công!');
    }

    public function thanhToan($id)
    {
        $hoaDon = HoaDon::findOrFail($id);

        // Cập nhật trạng thái bàn
        BanAn::where('MaBan', $hoaDon->MaBan)->update(['TrangThai' => 'Trống']);

        return redirect()->route('hoa-don.index')->with('success', 'Thanh toán thành công!');
    }

    public function thongKe(Request $request)
    {
        $thang = $request->get('thang', date('m'));
        $nam = $request->get('nam', date('Y'));

        $doanhThu = HoaDon::theoThang($thang, $nam)->sum('TongTien');
        $soHoaDon = HoaDon::theoThang($thang, $nam)->count();
        $hoaDons = HoaDon::theoThang($thang, $nam)->with('khachHang')->get();

        return view('hoa-don.thong-ke', compact('doanhThu', 'soHoaDon', 'hoaDons', 'thang', 'nam'));
    }
}
