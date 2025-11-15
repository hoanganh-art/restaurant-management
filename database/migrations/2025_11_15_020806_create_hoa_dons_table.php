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
        Schema::create('hoa_dons', function (Blueprint $table) {
           $table->id('MaHD');
            $table->foreignId('MaKH')->constrained('khach_hangs', 'MaKH');
            $table->foreignId('MaNV')->constrained('nhan_viens', 'MaNV');
            $table->foreignId('MaBan')->constrained('ban_ans', 'MaBan');
            $table->dateTime('NgayHD')->useCurrent();
            $table->decimal('TongTien', 12, 2)->default(0);
            $table->enum('PhuongThucTT', ['Tiền mặt', 'Chuyển khoản', 'Thẻ'])->default('Tiền mặt');
            $table->text('GhiChu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_dons');
    }
};
