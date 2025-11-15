<!-- resources/views/layouts/sidebar.blade.php -->
<div class="sidebar bg-white w-20 hover:w-64 transition-all duration-300 ease-in-out overflow-hidden shadow-lg flex flex-col">
    <!-- Logo -->
    <div class="p-4 border-b border-gray-200 flex items-center space-x-3">
        <div class="bg-gradient-to-r from-primary to-secondary p-2 rounded-lg">
            <i class="fas fa-utensils text-white text-xl"></i>
        </div>
        <span class="text-xl font-bold text-gray-800 whitespace-nowrap opacity-0 sidebar:hover:opacity-100 transition-opacity duration-300">Restaurant Pro</span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-all duration-200 group">
            <i class="fas fa-chart-pie text-lg w-6 text-center"></i>
            <span class="whitespace-nowrap opacity-0 sidebar:hover:opacity-100 transition-opacity duration-300">Dashboard</span>
        </a>

        <a href="{{ route('ban-an.index') }}" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-all duration-200 group">
            <i class="fas fa-chair text-lg w-6 text-center"></i>
            <span class="whitespace-nowrap opacity-0 sidebar:hover:opacity-100 transition-opacity duration-300">Quản lý bàn</span>
        </a>

        <a href="{{ route('hoa-don.index') }}" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-all duration-200 group">
            <i class="fas fa-receipt text-lg w-6 text-center"></i>
            <span class="whitespace-nowrap opacity-0 sidebar:hover:opacity-100 transition-opacity duration-300">Hóa đơn</span>
        </a>

        <a href="{{ route('mon-an.index') }}" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-all duration-200 group">
            <i class="fas fa-utensils text-lg w-6 text-center"></i>
            <span class="whitespace-nowrap opacity-0 sidebar:hover:opacity-100 transition-opacity duration-300">Món ăn</span>
        </a>

        <a href="{{ route('dat-ban.index') }}" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-all duration-200 group">
            <i class="fas fa-calendar-check text-lg w-6 text-center"></i>
            <span class="whitespace-nowrap opacity-0 sidebar:hover:opacity-100 transition-opacity duration-300">Đặt bàn</span>
        </a>

        <a href="{{ route('khach-hang.index') }}" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-all duration-200 group">
            <i class="fas fa-users text-lg w-6 text-center"></i>
            <span class="whitespace-nowrap opacity-0 sidebar:hover:opacity-100 transition-opacity duration-300">Khách hàng</span>
        </a>

        <a href="{{ route('thong-ke.index') }}" class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 hover:bg-primary hover:text-white transition-all duration-200 group">
            <i class="fas fa-chart-bar text-lg w-6 text-center"></i>
            <span class="whitespace-nowrap opacity-0 sidebar:hover:opacity-100 transition-opacity duration-300">Thống kê</span>
        </a>
    </nav>

    <!-- User Info -->
    <div class="p-4 border-t border-gray-200">
        <div class="flex items-center space-x-3">
            <img src="https://ui-avatars.com/api/?name={{ auth()->user()->HoTen }}&background=3B82F6&color=fff"
                 alt="Avatar" class="w-10 h-10 rounded-full">
            <div class="opacity-0 sidebar:hover:opacity-100 transition-opacity duration-300">
                <p class="text-sm font-medium text-gray-900">{{ auth()->user()->HoTen }}</p>
                <p class="text-xs text-gray-500 capitalize">{{ auth()->user()->VaiTro }}</p>
            </div>
        </div>
    </div>
</div>
