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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kelas');
            $table->string('image');
            $table->string('keluhan');
            $table->string('status');
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->index();

            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};