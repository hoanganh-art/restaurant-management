<!-- resources/views/layouts/header.blade.php -->
<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex justify-between items-center px-6 py-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
            <p class="text-gray-600">@yield('page-description', 'Quản lý nhà hàng toàn diện')</p>
        </div>

        <div class="flex items-center space-x-4">
            <!-- Notifications -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="p-2 text-gray-600 hover:text-primary transition-colors duration-200 relative">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute -top-1 -right-1 bg-danger text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">3</span>
                </button>

                <!-- Notification Dropdown -->
                <div x-show="open" @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="font-semibold text-gray-900">Thông báo</h3>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <!-- Notification items -->
                        <div class="p-4 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                            <p class="text-sm text-gray-800">Có đơn đặt bàn mới từ Nguyễn Văn A</p>
                            <p class="text-xs text-gray-500 mt-1">5 phút trước</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Menu -->
            <div x-data="{ open: false }" class="relative">
                {{-- <button @click="open = !open" class="flex items-cen<img src="https://ui-avatars.com/api/?name={{ auth()->user()->HoTen }}&background=3B82F6&color=fff"ter space-x-3 p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200"> --}}

                         alt="Avatar" class="w-8 h-8 rounded-full">
                    {{-- <span class="text-sm font-medium text-gray-700">{{ auth()->user()->HoTen }}</span> --}}
                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                </button>

                <div x-show="open" @click.away="open = false"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                        <i class="fas fa-user mr-2"></i>Hồ sơ
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                        <i class="fas fa-cog mr-2"></i>Cài đặt
                    </a>
                    <div class="border-t border-gray-200"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-danger hover:bg-gray-100 transition-colors duration-150">
                            <i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
