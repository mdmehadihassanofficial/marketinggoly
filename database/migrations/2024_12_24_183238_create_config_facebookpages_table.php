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
        Schema::create('config_facebookpages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->unsignedBigInteger('ufbconfigid');
            $table->string('appId')->nullable();
            $table->string('facebookId')->nullable();
            $table->longText('pageName')->nullable();
            $table->longText('pageId')->nullable();
            $table->longText('pageAccessToken')->nullable();
            $table->boolean('status')->default(1);
            $table->foreign('ufbconfigid')->references('id')->on('config_facebooks')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('uid')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_facebookpages');
    }
};