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
        Schema::create('mon_ans', function (Blueprint $table) {
            $table->id('MaMon');
            $table->string('TenMon');
            $table->text('MoTa')->nullable();
            $table->decimal('Gia', 10, 2);
            $table->string('Loai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mon_ans');
    }
};
