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
        Schema::create('chi_tiet_hoa_dons', function (Blueprint $table) {
           $table->id('MaCTHD');
            $table->foreignId('MaHD')->constrained('hoa_dons', 'MaHD');
            $table->foreignId('MaMon')->constrained('mon_ans', 'MaMon');
            $table->integer('SoLuong');
            $table->decimal('ThanhTien', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_hoa_dons');
    }
};
