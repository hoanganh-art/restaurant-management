<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dat_bans', function (Blueprint $table) {
            $table->id('MaDatBan');
            $table->foreignId('MaKH')->constrained('khach_hangs', 'MaKH');
            $table->foreignId('MaBan')->constrained('ban_ans', 'MaBan');
            $table->foreignId('MaNV')->constrained('nhan_viens', 'MaNV');
            $table->dateTime('ThoiGianDat')->useCurrent();
            $table->dateTime('ThoiGianDen');
            $table->integer('SoNguoi');
            $table->enum('TrangThai', ['Đã đặt', 'Đã hủy', 'Đã đến'])->default('Đã đặt');
            $table->text('GhiChu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dat_bans');
    }
};
