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
        Schema::create('cq_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('lession_id');
            $table->unsignedBigInteger('type_id');
            $table->string('questiontitle');
            $table->string('q_1');
            $table->string('q_1_ans')->nullable();
            $table->string('q_2');
            $table->string('q_2_ans')->nullable();
            $table->string('q_3');
            $table->string('q_3_ans')->nullable();
            $table->string('q_4');
            $table->string('q_4_ans')->nullable();
            $table->string('image')->nullable();
            $table->string('image_align')->nullable();
            $table->string('videoLink')->nullable();
            $table->timestamps();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->bigInteger('total_usage')->default(0);
            $table->enum('delete', ['deleted', 'no'])->default('no');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('cq_questions');
    }
};
