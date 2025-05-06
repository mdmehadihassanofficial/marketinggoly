<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class failedMailCollection extends Model
{
    use HasFactory;
    protected $table = 'failed_mail_collections';
    protected $fillable = array(
        'uid',
        'email',
        'repeateFailedNumber',
        'status',
    );
}