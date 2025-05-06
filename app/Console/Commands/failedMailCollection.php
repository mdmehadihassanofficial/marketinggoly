<?php

namespace App\Console\Commands;

use App\Jobs\failedMailCollectionJob;
use App\Models\configSMTP;
use Illuminate\Console\Command;

class failedMailCollection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:failed-mail-collection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $smtpConfig = configSMTP::where('status', 1)->get();
        if($smtpConfig){
            foreach ($smtpConfig as $smtpConfigItem) {
                $userId = $smtpConfigItem->uid;
                failedMailCollectionJob::dispatch($userId)->onQueue('medium');
                //dispatch(new failedMailCollectionJob($userId))->onQueue('medium');
                
            }
        }
    }
}