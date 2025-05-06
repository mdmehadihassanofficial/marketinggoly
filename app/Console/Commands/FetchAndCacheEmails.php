<?php

namespace App\Console\Commands;

use App\Jobs\FetchAndCacheEmails as JobsFetchAndCacheEmails;
use App\Models\configSMTP;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchAndCacheEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:fetch-and-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and cache emails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch Config SMTP Server
        $smtpConfig = configSMTP::where('status', 1)->get();

        foreach ($smtpConfig as $smtpConfigItem) {
            $userId = $smtpConfigItem->uid;
            JobsFetchAndCacheEmails::dispatch($userId, 'UNSEEN')->onQueue('medium');
            JobsFetchAndCacheEmails::dispatch($userId, 'ALL')->onQueue('medium');
        }

        Log::channel('emailfetch')->info('Fetch and cache emails Command Run Successfully ' . now());

       // socialTwitterPost::dispatch($userId,  $socialMediaItem, $socialPostManagerId,$socialTemplateId, $postDateTime,)->onQueue('medium');
       // JobsFetchAndCacheEmails::dispatch($userId, $msgUnseenAll)->onQueue('medium');

    }
}