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
        Schema::create('social_templates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->string('title');
            $table->longText('postMessage');
            $table->string('postMessageShort');
            $table->string('postImage')->nullable();
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
        Schema::dropIfExists('social_templates');
    }
};