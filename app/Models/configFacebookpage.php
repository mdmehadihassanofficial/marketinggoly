<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configFacebookpage extends Model
{
    use HasFactory;
    protected $table = 'config_facebookpages';

    protected $fillable = array(
        'uid',
        'ufbconfigid',
        'appId',
        'facebookId',
        'pageName',
        'pageId',
        'pageAccessToken',
        'status',
    );
}