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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            // Website info
            $table->string('site_name')->nullable();             // সাইটের নাম
            $table->string('site_title')->nullable();            // টাইটেল
            $table->string('logo')->nullable();                  // লোগো URL বা path
            $table->string('favicon')->nullable();               // ফেভিকন path

            // Contact info
            $table->string('contact_email')->nullable();         // যোগাযোগ ইমেইল
            $table->string('contact_phone')->nullable();         // ফোন নম্বর
            $table->string('contact_phone_2')->nullable();       // বিকল্প ফোন নম্বর
            $table->string('address')->nullable();               // ঠিকানা
            $table->text('map_embed_url')->nullable();         // গুগল ম্যাপ embed লিংক

            // Social media links
            $table->json('social_links')->nullable();

            // SEO settings
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // System & Maintenance
            $table->boolean('maintenance_mode')->default(false); // মেইন্টেনেন্স মোড
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
