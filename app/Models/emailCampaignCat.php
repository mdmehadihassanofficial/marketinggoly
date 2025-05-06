<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailCampaignCat extends Model
{
    use HasFactory;
    protected $table = 'email_campaign_cats';

    protected $fillable = array(
        'uid',
        'campaignCategory',
        'status',
    );
}