<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configLinkedIn extends Model
{
    use HasFactory;
    protected $table = 'config_linkedins';

    protected $fillable = array(
        'uid',
        'clientID',
        'clientSecret',
        'linkedin_access_token',
        'expires_in',
        'refresh_token',
        'refresh_token_expires_in',
        'linkedin_profile_name',
        'linkedin_profile_id',
        'status',
    );
}