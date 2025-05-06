<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class socialTemplate extends Model
{
    use HasFactory;
    protected $table = 'social_templates';

    protected $fillable = array(
        'uid',
        'title',
        'postMessage',
        'postMessageShort',
        'postImage',
        'status',
    );
}