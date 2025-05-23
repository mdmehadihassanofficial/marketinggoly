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
        Schema::create('email_managers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->string('emailTemplateId');
            $table->string('emailSubject')->nullable();
            $table->unsignedBigInteger('emailCampaignId')->nullable();
            $table->dateTime('postDateTime')->nullable();
            $table->dateTime('nextPostDateTime')->nullable();
            $table->dateTime('endPostDateTime')->nullable();
            $table->string('postRepeatType')->nullable();
            $table->string('totalRepeatPost')->nullable();
            $table->boolean('postRepeatStatus')->default(0);
            $table->boolean('postStatus')->default(1)->comment('0 = " Waiting For Time", 1 = "Waiting Work", 2 = "Work Done", 3 = "Work Processing"	');
            $table->boolean('status')->default(1);
            $table->boolean('notificationStatus')->default(0);
            //$table->string('socialTemplate')->nullable();
            $table->foreign('uid')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('emailCampaignId')->references('id')->on('email_campaigns')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_managers');
    }
};