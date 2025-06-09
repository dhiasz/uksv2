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
        Schema::create('kesehatan_historis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kesehatan_id')->unsigned();
            $table->integer('umur');
            $table->integer('tb'); 
            $table->integer('bb'); 
            $table->string('tensi')->nullable();
            $table->char('goldar',2)->nullable();
            $table->timestamps();

            $table->foreign('kesehatan_id')->references('id')->on('kesehatans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesehatan_historis');
    }
};
