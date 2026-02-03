<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('nama_lengkap');
            $table->string('bidang');
            $table->date('tanggal');
            $table->string('hari');
            $table->string('jam');
            $table->string('foto')->nullable();
            $table->text('alamat')->nullable();
            $table->enum('jenis', ['izin', 'sakit'])->nullable();
            $table->enum('status_hadir', ['hadir', 'terlambat'])->nullable();
            $table->enum('status_izin', ['pending', 'diterima', 'ditolak'])->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
