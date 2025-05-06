<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailCampaign extends Model
{
    use HasFactory;
    protected $table = 'email_campaigns';

    protected $fillable = array(
        'uid',
        'campaignCategoryId',
        'title',
        'description',
        'status',
    );
}