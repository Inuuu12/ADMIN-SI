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
        Schema::create('tblguru', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nip', 20);
            $table->string('jabatan', 50);
            $table->text('mata_pelajaran');
            $table->integer('pengalaman');
            $table->string('gambar')->nullable();
            $table->string('pendidikan_terakhir', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblguru');
    }
};
