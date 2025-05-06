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
        Schema::create('social_post_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid')->comment('User Id');
            $table->unsignedBigInteger('stId')->comment('Social Template Id');
            $table->unsignedBigInteger('spmId')->comment('Social Post Manager Id');
            $table->dateTime('postDateTime')->nullable();
            $table->string('socialMedia')->nullable();
            $table->longText('postMessage')->nullable();
            $table->string('totalTryingNumber')->nullable();
            $table->boolean('status')->default(1);
            $table->foreign('uid')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('spmId')->references('id')->on('social_post_managers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('stId')->references('id')->on('social_templates')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_post_reports');
    }
};