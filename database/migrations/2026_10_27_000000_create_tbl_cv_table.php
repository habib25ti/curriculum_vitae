<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tbl_cv', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 150);
            $table->string('profesi', 100);
            $table->string('email', 100)->unique();
            $table->string('no_telp', 20);
            $table->text('tentang_saya');
            $table->text('riwayat_pendidikan')->nullable();
            $table->text('keahlian')->nullable();
            $table->string('foto_profil')->nullable();
            $table->string('video_url', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_cv');
    }
};
