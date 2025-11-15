<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('danh_gias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hoa_don_id');
            $table->integer('SoSao')->between(1, 5);
            $table->text('nhan_xet')->nullable();
            $table->timestamps();

            $table->foreign('hoa_don_id')->references('id')->on('hoa_dons')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('danh_gias');
    }
};
