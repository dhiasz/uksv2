<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('total_stok_obats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('obat_id');
            $table->integer('total_jumlah')->default(0);
            $table->timestamps();

            $table->foreign('obat_id')->references('id')->on('obats')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('total_stok_obats');
    }
};
