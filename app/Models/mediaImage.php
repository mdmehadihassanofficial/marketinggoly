<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mediaImage extends Model
{
    use HasFactory;
    protected $table = 'media_images';
    protected $fillable = array(
        'uid',
        'title',
        'description',
        'imagePath',
        'status',
    );
}