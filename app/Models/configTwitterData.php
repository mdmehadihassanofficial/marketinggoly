<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configTwitterData extends Model
{
    use HasFactory;
    protected $table = 'config_twitter_data';

    protected $fillable = array(
        'uid',
        'twitter_user_id',
        'twitter_screen_name',
        'CONSUMER_KEY',
        'CONSUMER_SECRET',
        'twitter_oauth_token',
        'twitter_oauth_token_secrete',
        'status',
    );
}