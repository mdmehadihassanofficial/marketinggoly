<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailTemplateDesign extends Model
{
    use HasFactory;
    protected $table = 'email_template_designs';

    protected $fillable = array(
        'uid',
        'etid',
        'html',
        'css',
        'status',
    );
}