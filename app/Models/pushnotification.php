<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pushnotification extends Model
{
    use HasFactory;
    protected $table = 'pushnotifications';
    protected $fillable = array(
        'uid',
        'device_token',
        'sendStatus',
    );
}