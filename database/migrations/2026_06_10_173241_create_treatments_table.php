<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('시술명');
            $table->text('description')->nullable()->comment('시술 설명');
            $table->integer('duration')->default(60)->comment('소요시간(분)');
            $table->integer('price')->default(0)->comment('가격');
            $table->boolean('is_active')->default(true)->comment('활성여부');
            $table->integer('sort_order')->default(0)->comment('정렬순서');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};