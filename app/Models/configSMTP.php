<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configSMTP extends Model
{
    use HasFactory;
    protected $table = 'config_s_m_t_p_s';

    protected $fillable = array(
        'uid',
        'SMTPSecure',
        'Host',
        'Port',
        'EmailUsername',
        'EmailPasswoard',
        'SetFrom',
        'EmailName',
        'ReplyToEmail',
        'ReplyToEmailName',
        'imapHostServer',
        'imapPort',
        'imapInboxFrom',
        'status',
    );
}