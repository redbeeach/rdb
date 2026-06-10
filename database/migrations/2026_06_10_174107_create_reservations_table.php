<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('treatment_id')->constrained('treatments')->comment('시술 ID');
            $table->foreignId('time_slot_id')->constrained('time_slots')->comment('시간 슬롯 ID');
            $table->date('date')->comment('예약 날짜');
            $table->string('name')->comment('예약자 이름');
            $table->string('phone')->comment('연락처');
            $table->text('memo')->nullable()->comment('메모');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending')->comment('예약 상태');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};