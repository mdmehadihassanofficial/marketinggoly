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
        Schema::create('emailtrackings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'cid' );
            $table->unsignedBigInteger( 'emailtemplateid' );
            $table->unsignedBigInteger( 'emailmanagerid' );
            $table->unsignedBigInteger( 'emailid' );
            $table->string( 'semail', '50' )->default( 'none' );
            $table->string( 'shortcode', '150' )->default( 'none' );
            $table->boolean( 'opencount' )->default( 0 );
            $table->dateTime( 'opendate' )->nullable();
            $table->dateTime( 'lastopendate' )->nullable();
            $table->dateTime( 'postDateTime' )->nullable();
            $table->timestamps();
            $table->foreign( 'cid' )->references( 'id' )->on( 'email_campaigns' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreign( 'emailtemplateid' )->references( 'id' )->on( 'email_templates' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
            $table->foreign( 'emailmanagerid' )->references( 'id' )->on( 'email_managers' )->onUpdate( 'cascade' )->onDelete( 'cascade' );  
            $table->foreign( 'emailid' )->references( 'id' )->on( 'email_collections' )->onUpdate( 'cascade' )->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emailtrackings');
    }
};