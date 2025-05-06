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
        Schema::create('pushnotifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid')->comment('User Id');
            $table->text('device_token')->nullable();
            $table->boolean('sendStatus')->default(1);
            $table->foreign('uid')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pushnotifications');
    }
};