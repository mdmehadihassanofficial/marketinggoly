<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configFacebook extends Model
{
    use HasFactory;
    protected $table = 'config_facebooks';

    protected $fillable = array(
        'uid',
        'appId',
        'appSecret',
        'facebook_access_token',
        'fbName',
        'fdId',
        'status',
    );
}