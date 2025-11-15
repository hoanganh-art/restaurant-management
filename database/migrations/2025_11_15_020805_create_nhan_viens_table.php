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
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id('MaNV');
            $table->string('HoTen');
            $table->enum('VaiTro', ['Quản lý', 'Thu ngân', 'Phục vụ', 'Đầu bếp']);
            $table->string('SDT')->nullable();
            $table->decimal('Luong', 12, 2);
            $table->string('TaiKhoan')->unique()->nullable();
            $table->string('MatKhau');
            $table->date('NgayVaoLam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_viens');
    }
};
