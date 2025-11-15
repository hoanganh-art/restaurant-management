<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BanAnController extends Controller
{
    public function index()
    {
        $banAns = BanAn::all();
        return view('ban-an.index', compact('banAns'));
    }

    public function updateTrangThai(Request $request, $id)
    {
        $banAn = BanAn::findOrFail($id);
        $banAn->update(['TrangThai' => $request->TrangThai]);

        return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
    }

    public function getBanTrong()
    {
        $banTrong = BanAn::where('TrangThai', 'Trống')->get();
        return response()->json($banTrong);
    }
}
