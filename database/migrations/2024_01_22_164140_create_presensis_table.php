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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('attendance_id')->constrained()->cascadeOnDelete();
            $table->date('presence_date');
            $table->time('entry_time')->nullable();
            $table->time('out_time')->nullable();
            $table->string('entry_foto')->nullable();
            $table->string('out_foto')->nullable();
            $table->text('entry_location');
            $table->text('out_location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
