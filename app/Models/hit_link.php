<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hit_link extends Model
{
    use HasFactory;
    protected $table = 'hit_links';
    protected $fillable = array(
        'lid',
        'campaignId',
        'emailCollectionsId',
        'countryCode',
        'region',
        'city',
        'zip',
        'lat',
        'lon',
        'timezone',
        'deviceFamily',
        'deviceModel',
        'platformName',
        'BrowserName',
        'browserFamily',
        'oparatingSystem',
        'deviceType',
        'isBot',
        'hiturl',
        'ip',
        'email',
        'vpn',
        'uniqueUser',
    );
}