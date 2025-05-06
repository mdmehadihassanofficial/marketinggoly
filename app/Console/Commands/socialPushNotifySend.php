<?php

namespace App\Console\Commands;

use App\Models\socialPostManager;
use Illuminate\Console\Command;

class socialPushNotifySend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:social-push-notify-send';

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
        $socialPostManager = socialPostManager::where('notificationStatus' , 1)->get();

        if (!empty($socialPostManager)) {
            foreach ($socialPostManager as $socialPostManagerItem) {
                
            }
        }
    }
}