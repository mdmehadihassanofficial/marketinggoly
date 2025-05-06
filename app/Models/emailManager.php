<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailManager extends Model
{
    use HasFactory;
    protected $table = 'email_managers';

    protected $fillable = array(
        'uid',
        'emailTemplateId',
        'emailSubject',
        'emailCampaignId',
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