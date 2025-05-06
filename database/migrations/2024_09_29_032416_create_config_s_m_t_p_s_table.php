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
        Schema::create('config_s_m_t_p_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid');
            $table->string('SMTPSecure', '50')->nullable();
            $table->string('Host', '50')->nullable();
            $table->string('Port', '50')->nullable();
            $table->string('EmailUsername', '50')->nullable();
            $table->string('EmailPasswoard', '50')->nullable();
            $table->string('SetFrom', '50')->nullable();
            $table->string('EmailName', '50')->nullable();
            $table->string('ReplyToEmail', '50')->nullable();
            $table->string('ReplyToEmailName', '50')->nullable();
            $table->string('imapHostServer', '50')->nullable();
            $table->string('imapPort', '50')->nullable();
            $table->string('imapInboxFrom', '50')->nullable();
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
        Schema::dropIfExists('config_s_m_t_p_s');
    }
};