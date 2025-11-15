<!-- resources/views/mon-an/index.blade.php -->
@extends('layouts.app')

@section('title', 'Quản lý món ăn')
@section('page-title', 'Quản lý thực đơn')

@section('content')
<div x-data="monAnManager()" class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Thực đơn nhà hàng</h2>
            <p class="text-gray-600">Quản lý {{ $monAns->count() }} món ăn trong thực đơn</p>
        </div>

        <div class="flex space-x-3">
            <div class="relative">
                <input type="text" x-model="search" placeholder="Tìm món ăn..."
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200 w-64">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>

            <select x-model="selectedCategory"
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-200">
                <option value="">Tất cả loại</option>
                @foreach($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>

            <button @click="showAddModal = true"
                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Thêm món</span>
            </button>
        </div>
    </div>

    <!-- Menu Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <template x-for="monAn in filteredMonAns" :key="monAn.MaMon">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden card-hover group">
                <!-- Image -->
                <div class="relative overflow-hidden bg-gray-200 h-48">
                    <img :src="monAn.HinhAnh || 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80'"
                         :alt="monAn.TenMon" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-3 right-3">
                        <span :class="getCategoryColor(monAn.Loai)"
                              class="px-2 py-1 rounded-full text-xs font-medium text-white">
                            <span x-text="monAn.Loai"></span>
                        </span>
                    </div>
                    <div class="absolute bottom-3 left-3">
                        <span class="bg-black bg-opacity-50 text-white px-2 py-1 rounded-lg text-sm font-bold">
                            <span x-text="formatPrice(monAn.Gia)"></span>
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 text-lg mb-2" x-text="monAn.TenMon"></h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2" x-text="monAn.MoTa || 'Không có mô tả'"></p>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <span class="flex items-center space-x-1">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span>4.5</span>
                            </span>
                            <span class="flex items-center space-x-1">
                                <i class="fas fa-fire text-orange-500"></i>
                                <span x-text="monAn.so_luong_ban || 0"></span>
                            </span>
                        </div>

                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            <button @click="editMonAn(monAn)"
                                    class="p-2 bg-primary text-white rounded-lg hover:bg-secondary transition-colors duration-200">
                                <i class="fas fa-edit text-sm"></i>
                            </button>
                            <button @click="deleteMonAn(monAn)"
                                    class="p-2 bg-danger text-white rounded-lg hover:bg-red-700 transition-colors duration-200">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Empty State -->
    <div x-show="filteredMonAns.length === 0" class="text-center py-12">
        <i class="fas fa-utensils text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Không tìm thấy món ăn nào</h3>
        <p class="text-gray-500">Thử thay đổi bộ lọc hoặc thêm món ăn mới</p>
    </div>
</div>

@push('scripts')
<script>
function monAnManager() {
    return {
        search: '',
        selectedCategory: '',
        showAddModal: false,
        editingMonAn: null,
        monAns: @json($monAns),
        categories: @json($categories),

        get filteredMonAns() {
            let filtered = this.monAns;

            // Apply category filter
            if (this.selectedCategory) {
                filtered = filtered.filter(monAn => monAn.Loai === this.selectedCategory);
            }

            // Apply search
            if (this.search) {
                filtered = filtered.filter(monAn =>
                    monAn.TenMon.toLowerCase().includes(this.search.toLowerCase()) ||
                    (monAn.MoTa && monAn.MoTa.toLowerCase().includes(this.search.toLowerCase()))
                );
            }

            return filtered;
        },

        getCategoryColor(category) {
            const colors = {
                'Khai vị': 'bg-green-500',
                'Món chính': 'bg-blue-500',
                'Tráng miệng': 'bg-pink-500',
                'Đồ uống': 'bg-purple-500',
                'Đặc biệt': 'bg-red-500'
            };
            return colors[category] || 'bg-gray-500';
        },

        formatPrice(price) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(price);
        },

        editMonAn(monAn) {
            this.editingMonAn = {...monAn};
            this.showAddModal = true;
        },

        deleteMonAn(monAn) {
            if (confirm(`Bạn có chắc muốn xóa món "${monAn.TenMon}"?`)) {
                fetch(`/mon-an/${monAn.MaMon}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          this.monAns = this.monAns.filter(m => m.MaMon !== monAn.MaMon);
                      }
                  });
            }
        }
    }
}
</script>
@endpush
@endsection
