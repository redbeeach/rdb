<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->string('time')->comment('예약 시간 (예: 10:00)');
            $table->boolean('is_active')->default(true)->comment('활성여부');
            $table->integer('sort_order')->default(0)->comment('정렬순서');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};