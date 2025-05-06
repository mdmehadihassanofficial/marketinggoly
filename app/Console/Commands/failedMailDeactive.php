<?php

namespace App\Console\Commands;

use App\Models\emailCollection;
use App\Models\failedMailCollection;
use Illuminate\Console\Command;

class failedMailDeactive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:failed-mail-deactive';

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
        $failedMailCollection = failedMailCollection::where('status', 1)->get();
        if($failedMailCollection){
            foreach ($failedMailCollection as $failedMailCollectionItem) {
                if($failedMailCollectionItem->repeateFailedNumber >= 2){
                    $userId = $failedMailCollectionItem->uid;
                    $email = $failedMailCollectionItem->email;
                    $emailCollectionCampaign = emailCollection::where('uid', $userId)->where('email', $email)->get();
                    foreach ($emailCollectionCampaign as $emailCollectionCampaignItem) {
                        $emailCollectionCampaignItem->status = 44;
                        $emailCollectionCampaignItem->note = "Mail Deactive From Failed Mail Collection";
                        $emailCollectionCampaignItem->save();
                    }
                    $failedMailCollectionItem->status = 2;
                    $failedMailCollectionItem->save();
                }
            }
        }
    }
}