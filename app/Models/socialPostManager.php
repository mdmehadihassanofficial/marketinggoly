<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class socialPostManager extends Model
{
    use HasFactory;
    protected $table = 'social_post_managers';

    protected $fillable = array(
        'uid',
        'socialTemplateId',
        'title',
        'socialMedia',
        'postDateTime',
        'nextPostDateTime',
        'endPostDateTime',
        'postRepeatType',
        'totalRepeatPost',
        'postRepeatStatus',
        'postStatus',
        'status',
        'notificationStatus',
    );
}