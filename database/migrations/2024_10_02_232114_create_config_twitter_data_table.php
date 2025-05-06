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
        Schema::create('config_twitter_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->bigInteger('twitter_user_id')->nullable();
            $table->string('twitter_screen_name')->nullable();
            $table->string('CONSUMER_KEY')->nullable();
            $table->string('CONSUMER_SECRET')->nullable();
            $table->string('twitter_oauth_token')->nullable();
            $table->string('twitter_oauth_token_secrete')->nullable();
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
        Schema::dropIfExists('config_twitter_data');
    }
};