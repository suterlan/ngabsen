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
        Schema::create('undangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tema_undangan_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('nama', 100);
            $table->string('bg_cover')->nullable();
            $table->string('cover_dekor_tengah')->nullable();
            $table->string('cover_dekor_atas_kanan')->nullable();
            $table->string('cover_dekor_atas_kiri')->nullable();
            $table->string('cover_dekor_bawah_kanan')->nullable();
            $table->string('cover_dekor_bawah_kiri')->nullable();

            $table->string('home_dekor_tengah')->nullable();
            $table->string('home_dekor_atas_kanan')->nullable();
            $table->string('home_dekor_atas_kiri')->nullable();
            $table->string('home_dekor_bawah_kanan')->nullable();
            $table->string('home_dekor_bawah_kiri')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('undangans');
    }
};
