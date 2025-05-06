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
        Schema::create('config_linkedins', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->longText('clientID')->nullable();
            $table->longText('clientSecret')->nullable();
            $table->longText('linkedin_access_token')->nullable();
            $table->dateTime('expires_in')->nullable();
            $table->longText('refresh_token')->nullable();
            $table->dateTime('refresh_token_expires_in')->nullable();
            $table->string('linkedin_profile_name')->nullable();
            $table->string('linkedin_profile_id')->nullable();
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
        Schema::dropIfExists('config_linkedins');
    }
};