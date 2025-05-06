<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailtrackings extends Model
{
    use HasFactory;
    protected $table = 'emailtrackings';
    protected $fillable = array(
        'cid',
        'emailtemplateid',
        'emailmanagerid',
        'emailid',
        'semail',
        'shortcode',
        'opencount',
        'opendate',
        'lastopendate',
        'postDateTime',
    );
}