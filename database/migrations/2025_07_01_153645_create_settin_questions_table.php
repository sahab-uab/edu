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
        Schema::create('settin_questions', function (Blueprint $table) {
            $table->id();
            $table->double('mcq_price')->default(0);
            $table->double('cq_price')->default(0);
            $table->double('sq_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settin_questions');
    }
};
