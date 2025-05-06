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
        Schema::create('config_facebooks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->longText('appId')->nullable();
            $table->longText('appSecret')->nullable();
            $table->longText('facebook_access_token')->nullable();
            $table->string('fbName')->nullable();
            $table->string('fdId')->nullable();
            $table->boolean('status')->default(1);
            $table->foreign('uid')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('config_facebooks');
    }
};