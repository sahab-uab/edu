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
        Schema::create('mcq_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('lession_id');
            $table->unsignedBigInteger('type_id');
            $table->string('lavel');
            $table->text('video_link')->nullable();
            $table->text('image_link')->nullable();
            $table->text('image_positon')->default('left');
            $table->text('title');
            $table->json('normal_questions')->nullable();
            $table->json('advance_questions')->nullable();
            $table->text('right');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->bigInteger('total_usage')->default(0);
            $table->enum('delete', ['deleted', 'no'])->default('no');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('class_id')->references('id')->on('groupe_classes')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('allsubjects')->onDelete('cascade');
            $table->foreign('lession_id')->references('id')->on('lessions')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('question_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcq_questions');
    }
};
