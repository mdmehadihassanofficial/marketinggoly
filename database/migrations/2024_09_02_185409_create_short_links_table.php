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
        //Start Short Link Details
        Schema::create('short_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->longText('longLink');
            $table->string('shortCode')->default('None');
            $table->integer('count')->default('0');
            $table->boolean('linkSEO')->default(0);
            $table->string('seoTitle')->nullable();
            $table->string('seoDescription')->nullable();
            $table->string('seoImage')->nullable();
            $table->string('seoUrl')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->foreign('uid')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
        //End Short Link Details

        //Start Short Link Hit Details
        Schema::create('hit_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lid');
            $table->unsignedBigInteger('campaignId')->nullable();
            $table->unsignedBigInteger('emailCollectionsId')->nullable();
            $table->string('countryCode', '50')->nullable();
            $table->string('region', '50')->nullable();
            $table->string('city', '50')->nullable();
            $table->string('zip', '50')->nullable();
            $table->string('lat', '50')->nullable();
            $table->string('lon', '50')->nullable();
            $table->string('timezone', '50')->nullable();
            $table->string('deviceFamily', '50')->nullable();
            $table->string('deviceModel', '50')->nullable();
            $table->string('platformName', '50')->nullable();
            $table->string('BrowserName', '50')->nullable();
            $table->string('browserFamily', '50')->nullable();
            $table->string('oparatingSystem', '50')->nullable();
            $table->string('deviceType', '50')->nullable();
            $table->string('isBot', '50')->nullable();
            $table->string('hiturl')->nullable();
            $table->string('ip', '50')->nullable();
            $table->string('email')->nullable();
            $table->boolean('vpn')->default(0);
            $table->boolean('uniqueUser')->default(0);
            $table->timestamps();
            $table->foreign('lid')->references('id')->on('short_links')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('campaignId')->references('id')->on('email_campaigns')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('emailCollectionsId')->references('id')->on('email_collections')->onUpdate('cascade')->onDelete('cascade');
        });
        //End Short Link Hit Details
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_links');
        Schema::dropIfExists('hit_links');
    }
};