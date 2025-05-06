<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailTemplate extends Model
{
    use HasFactory;
    protected $table = 'email_templates';

    protected $fillable = array(
        'uid',
        'title',
        'emailSubject',
        'description',
        'status',
    );
}