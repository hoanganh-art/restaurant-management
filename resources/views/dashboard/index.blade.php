<!-- resources/views/dashboard/index.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Tổng quan nhà hàng')

@section('content')
<div class="space-y-6">
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Doanh thu hôm nay -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white card-hover animate-bounce-in">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100 text-sm">Doanh thu hôm nay</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($doanhThuHomNay) }} VNĐ</p>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                    <i class="fas fa-money-bill-wave text-xl"></i>
                </div>
            </div>
            <div class="flex items-center mt-4 text-blue-100 text-sm">
                <i class="fas fa-arrow-up mr-1"></i>
                <span>12% so với hôm qua</span>
            </div>
        </div>

        <!-- Số hóa đơn -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 card-hover">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm">Hóa đơn hôm nay</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $soHoaDonHomNay }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-xl">
                    <i class="fas fa-receipt text-green-600 text-xl"></i>
                </div>
            </div>
            <div class="flex items-center mt-4 text-green-600 text-sm">
                <i class="fas fa-arrow-up mr-1"></i>
                <span>5% so với hôm qua</span>
            </div>
        </div>

        <!-- Bàn đang phục vụ -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 card-hover">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm">Bàn đang phục vụ</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $banDangPhucVu }}/{{ $tongSoBan }}</p>
                </div>
                <div class="bg-orange-100 p-3 rounded-xl">
                    <i class="fas fa-chair text-orange-600 text-xl"></i>
                </div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2 mt-4">
                <div class="bg-orange-500 h-2 rounded-full" style="width: {{ ($banDangPhucVu/$tongSoBan)*100 }}%"></div>
            </div>
        </div>

        <!-- Đánh giá trung bình -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 card-hover">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-600 text-sm">Đánh giá trung bình</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $danhGiaTrungBinh }}/5</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-xl">
                    <i class="fas fa-star text-purple-600 text-xl"></i>
                </div>
            </div>
            <div class="flex mt-2">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= $danhGiaTrungBinh ? 'text-yellow-400' : 'text-gray-300' }} text-sm"></i>
                @endfor
            </div>
        </div>
    </div>

    <!-- Charts & Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Doanh thu 7 ngày -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Doanh thu 7 ngày qua</h3>
                <select class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-primary">
                    <option>7 ngày</option>
                    <option>30 ngày</option>
                    <option>90 ngày</option>
                </select>
            </div>
            <canvas id="revenueChart" height="250"></canvas>
        </div>

        <!-- Món ăn bán chạy -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-900 mb-6">Top món ăn bán chạy</h3>
            <div class="space-y-4">
                @foreach($topMonAn as $index => $monAn)
                <div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-primary bg-opacity-10 rounded-lg flex items-center justify-center">
                            <span class="text-primary font-semibold text-sm">#{{ $index + 1 }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $monAn->TenMon }}</p>
                            <p class="text-sm text-gray-500">{{ number_format($monAn->so_luong_ban) }} đơn</p>
                        </div>
                    </div>
                    <span class="text-success font-semibold">{{ number_format($monAn->doanh_thu) }} VNĐ</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl p-6 text-white card-hover cursor-pointer" onclick="window.location='{{ route('hoa-don.create') }}'">
            <div class="text-center">
                <i class="fas fa-plus-circle text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Tạo hóa đơn mới</h3>
                <p class="text-purple-100">Bắt đầu phục vụ khách hàng</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-teal-500 rounded-2xl p-6 text-white card-hover cursor-pointer" onclick="window.location='{{ route('dat-ban.create') }}'">
            <div class="text-center">
                <i class="fas fa-calendar-plus text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Đặt bàn</h3>
                <p class="text-green-100">Quản lý đặt chỗ</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl p-6 text-white card-hover cursor-pointer" onclick="window.location='{{ route('mon-an.create') }}'">
            <div class="text-center">
                <i class="fas fa-utensils text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Thêm món ăn</h3>
                <p class="text-orange-100">Mở rộng thực đơn</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: [1200000, 1900000, 1500000, 2200000, 1800000, 2500000, 2800000],
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return (value / 1000000) + 'Tr';
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
