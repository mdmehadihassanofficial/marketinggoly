<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class socialPostReport extends Model
{
    use HasFactory;
    protected $table = 'social_post_reports';

    protected $fillable = array(
        'uid',
        'stId',
        'spmId',
        'postDateTime',
        'socialMedia',
        'postMessage',
        'totalTryingNumber',
        'status',
    );
}