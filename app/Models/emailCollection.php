<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailCollection extends Model
{
    use HasFactory;
    protected $table = 'email_collections';

    protected $fillable = array(
        'uid',
        'emailCampaignsId',
        'name',
        'email',
        'note',
        'status',
    );
}