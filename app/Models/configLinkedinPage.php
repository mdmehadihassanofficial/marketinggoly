<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configLinkedinPage extends Model
{
    use HasFactory;
    protected $table = 'config_linkedin_pages';

    protected $fillable = array(
        'uid',
        'uldconfigid',
        'clientID',
        'linkedinProfileId',
        'pageName',
        'pageId',
        'pageURN',
        'userRole',
        'status',
    );
}