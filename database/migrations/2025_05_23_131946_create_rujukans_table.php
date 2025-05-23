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
        Schema::create('rujukans', function (Blueprint $table) {
            $table->id();
             $table->bigInteger('kunjungan_id')->unsigned();
             $table->string('alamat');
             $table->string('diagnosa');
             $table->string('tujuan');
            
            $table->foreign('kunjungan_id')->references('id')->on('kunjungans')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rujukans');
    }
};
