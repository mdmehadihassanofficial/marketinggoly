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
        Schema::create('config_linkedin_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->unsignedBigInteger('uldconfigid');
            $table->string('clientID')->nullable();
            $table->string('linkedinProfileId')->nullable();
            $table->string('pageName')->nullable();
            $table->string('pageId')->nullable();
            $table->string('pageURN')->nullable();
            $table->string('userRole')->nullable();
            $table->boolean('status')->default(1);
            $table->foreign('uldconfigid')->references('id')->on('config_linkedins')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('uid')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_linkedin_pages');
    }
};