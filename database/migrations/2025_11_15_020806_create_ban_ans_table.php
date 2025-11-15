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
        Schema::create('ban_ans', function (Blueprint $table) {
            $table->id('MaBan');
            $table->string('TenBan');
            $table->integer('SoGhe');
            $table->enum('KhuVuc', ['Trong nhà', 'Ngoài trời', 'VIP']);
            $table->enum('TrangThai', ['Trống', 'Đang phục vụ', 'Đã đặt'])->default('Trống');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ban_ans');
    }
};
