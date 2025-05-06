<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shortLink extends Model
{
    use HasFactory;
    protected $table = 'short_links';

    protected $fillable = array(
        'uid',
        'title',
        'description',
        'longLink',
        'shortCode',
        'count',
        'seoTitle',
        'seoDescription',
        'seoImage',
        'seoUrl',
        'status',
    );
}