<!-- resources/views/ban-an/index.blade.php -->
@extends('layouts.app')

@section('title', 'Quản lý bàn ăn')
@section('page-title', 'Quản lý bàn ăn')

@section('content')
<div x-data="banAnManager()" class="space-y-6">
    <!-- Filter & Search -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <div class="flex space-x-4">
            <button @click="filter = 'all'"
                    :class="filter === 'all' ? 'bg-primary text-white' : 'bg-white text-gray-700'"
                    class="px-4 py-2 rounded-lg border border-gray-300 transition-all duration-200 hover:shadow-md">
                Tất cả ({{ $banAns->count() }})
            </button>
            <button @click="filter = 'trong'"
                    :class="filter === 'trong' ? 'bg-success text-white' : 'bg-white text-gray-700'"
                    class="px-4 py-2 rounded-lg border border-gray-300 transition-all duration-200 hover:shadow-md">
                Trống ({{ $banAns->where('TrangThai', 'Trống')->count() }})
            </button>
            <button @click="filter = 'dang-phuc-vu'"
                    :class="filter === 'dang-phuc-vu' ? 'bg-warning text-white' : 'bg-white text-gray-700'"
                    class="px-4 py-2 rounded-lg border border-gray-300 transition-all duration-200 hover:shadow-md">
                Đang phục vụ ({{ $banAns->where('TrangThai', 'Đang phục vụ')->count() }})
            </button>
            <button @click="filter = 'da-dat'"
                    :class="filter === 'da-dat' ? 'bg-purple-600 text-white' : 'bg-white text-gray-700'"
                    class="px-4 py-2 rounded-lg border border-gray-300 transition-all duration-200 hover:shadow-md">
                Đã đặt ({{ $banAns->where('TrangThai', 'Đã đặt')->count() }})
            </button>
        </div>

        <div class="flex space-x-3">
            <div class="relative">
                <input type="text" x-model="search" placeholder="Tìm bàn..."
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent transition-all duration-200">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <button @click="showAddModal = true"
                    class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-secondary transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Thêm bàn</span>
            </button>
        </div>
    </div>

    <!-- Ban Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-6">
        <template x-for="ban in filteredBans" :key="ban.MaBan">
            <div :class="getStatusClass(ban.TrangThai)"
                 class="rounded-2xl p-6 text-white cursor-pointer transform transition-all duration-300 hover:scale-105 card-hover"
                 @click="selectBan(ban)"
                 draggable="true"
                 @dragstart="dragStart(ban)">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="text-xl font-bold" x-text="ban.TenBan"></h3>
                        <p class="text-opacity-90" x-text="ban.KhuVuc"></p>
                    </div>
                    <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                        <i class="fas fa-chair"></i>
                        <span x-text="ban.SoGhe"></span>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium px-3 py-1 rounded-full bg-white bg-opacity-20"
                          x-text="getStatusText(ban.TrangThai)"></span>
                    <div class="flex space-x-2">
                        <button @click.stop="editBan(ban)"
                                class="p-2 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-colors duration-200">
                            <i class="fas fa-edit text-sm"></i>
                        </button>
                        <button @click.stop="changeStatus(ban)"
                                class="p-2 bg-white bg-opacity-20 rounded-lg hover:bg-opacity-30 transition-colors duration-200">
                            <i class="fas fa-sync-alt text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Empty State -->
    <div x-show="filteredBans.length === 0" class="text-center py-12">
        <i class="fas fa-chair text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-600 mb-2">Không tìm thấy bàn nào</h3>
        <p class="text-gray-500">Thử thay đổi bộ lọc hoặc thêm bàn mới</p>
    </div>

    <!-- Add/Edit Modal -->
    @include('ban-an.components.modal')
</div>

@push('scripts')
<script>
function banAnManager() {
    return {
        filter: 'all',
        search: '',
        showAddModal: false,
        editingBan: null,
        bans: @json($banAns),

        get filteredBans() {
            let filtered = this.bans;

            // Apply filter
            if (this.filter !== 'all') {
                const statusMap = {
                    'trong': 'Trống',
                    'dang-phuc-vu': 'Đang phục vụ',
                    'da-dat': 'Đã đặt'
                };
                filtered = filtered.filter(ban => ban.TrangThai === statusMap[this.filter]);
            }

            // Apply search
            if (this.search) {
                filtered = filtered.filter(ban =>
                    ban.TenBan.toLowerCase().includes(this.search.toLowerCase()) ||
                    ban.KhuVuc.toLowerCase().includes(this.search.toLowerCase())
                );
            }

            return filtered;
        },

        getStatusClass(status) {
            const classes = {
                'Trống': 'bg-gradient-to-br from-success to-green-600',
                'Đang phục vụ': 'bg-gradient-to-br from-warning to-orange-600',
                'Đã đặt': 'bg-gradient-to-br from-purple-500 to-purple-700'
            };
            return classes[status] || 'bg-gray-500';
        },

        getStatusText(status) {
            const texts = {
                'Trống': 'Có thể đặt',
                'Đang phục vụ': 'Đang phục vụ',
                'Đã đặt': 'Đã đặt trước'
            };
            return texts[status] || status;
        },

        selectBan(ban) {
            if (ban.TrangThai === 'Trống') {
                window.location.href = `/hoa-don/create?ban=${ban.MaBan}`;
            } else {
                this.showBanDetails(ban);
            }
        },

        showBanDetails(ban) {
            // Show ban details modal
            console.log('Show details for:', ban);
        },

        dragStart(ban) {
            event.dataTransfer.setData('text/plain', ban.MaBan);
        },

        editBan(ban) {
            this.editingBan = {...ban};
            this.showAddModal = true;
        },

        changeStatus(ban) {
            // Cycle through statuses
            const statuses = ['Trống', 'Đang phục vụ', 'Đã đặt'];
            const currentIndex = statuses.indexOf(ban.TrangThai);
            const nextIndex = (currentIndex + 1) % statuses.length;

            // Update status via API
            fetch(`/ban-an/${ban.MaBan}/trang-thai`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    TrangThai: statuses[nextIndex]
                })
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      ban.TrangThai = statuses[nextIndex];
                  }
              });
        }
    }
}
</script>
@endpush
@endsection
