<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\configSMTP;
use Illuminate\Support\Facades\Cache;

class FetchAndCacheEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $msgUnseenAll;
    /**
     * Create a new job instance.
     */
    public function __construct($userId, $msgUnseenAll)
    {
        $this->userId = $userId;
        $this->msgUnseenAll = $msgUnseenAll;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $msgUnseenAll = $this->msgUnseenAll;
        $cacheKey = 'email_'.$msgUnseenAll.'_' . $this->userId;

        $configSMTP = configSMTP::where('uid', $this->userId)->first();

        $EmailUsername = $configSMTP->EmailUsername;
        $EmailPasswoard = $configSMTP->EmailPasswoard;
        $imapHostServer = $configSMTP->imapHostServer;
        $imapPort = $configSMTP->imapPort;
        $imapInboxFrom = $configSMTP->imapInboxFrom ?? 'INBOX';
        
        //Email label Found
        // $mailboxes = imap_list(imap_open('{imap.gmail.com:993/imap/ssl}', $username, $password), '{imap.gmail.com:993/imap/ssl}', '*');
        // dd($mailboxes);

        // Server IMAP server details
        $hostname = '{'.$imapHostServer.':'.$imapPort.'/imap/ssl}'.$imapInboxFrom;
        $username = $EmailUsername;
        $password = $EmailPasswoard;

        $inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

        $emailDetailsOldData = Cache::get($cacheKey);
        if($msgUnseenAll == 'UNSEEN'){
            $emailDetails = $this->allInboxFetchmanual($inbox, $msgUnseenAll);
        }else{
            if(!empty($emailDetailsOldData)){
                $emailDetails = $this->specificNumberInboxGet($inbox, $msgUnseenAll, $emailDetailsOldData);
            }else{
                $emailDetails = $this->allInboxFetchmanual($inbox, $msgUnseenAll);
            }
        }

        imap_close($inbox);

        // Cache the array for 60 minutes
        Cache::put($cacheKey, $emailDetails, now()->addHours(24));
    }

    private function specificNumberInboxGet($inbox, $msgUnseenAll, $emailDetailsOldData){
        $rangeStart = $emailDetailsOldData[0]['email_number'] +1;
        //dd($emailDetailsOldData );
        $range = $rangeStart.":*"; 
        $emails = imap_fetch_overview($inbox, $range, 0);

        if ($emails) {
            rsort($emails); // Sort emails in descending order
            //dd($emails);
            foreach ($emails as $email_number) {
                
                //dd($email_number);
                $overview = imap_fetch_overview($inbox, $rangeStart, 0);
                //dd($overview);
                //$message = imap_fetchbody($inbox, $email_number, 1);
		if ($msgUnseenAll == 'UNSEEN' ) {
			if ($overview[0]->seen == 0) {
				array_unshift($emailDetailsOldData,  [
					'subject' => $overview[0]->subject ?? '(No Subject)',
					'from' => $overview[0]->from ?? '(Unknown Sender)',
					'date' => $overview[0]->date ?? '(No Date)',
					'email_number' => $rangeStart,
					'email_seen' => $overview[0]->seen,
					//'message' => $message ?? '(No Message)',
				]);
			}
		}else{
			array_unshift($emailDetailsOldData,  [
				'subject' => $overview[0]->subject ?? '(No Subject)',
				'from' => $overview[0]->from ?? '(Unknown Sender)',
				'date' => $overview[0]->date ?? '(No Date)',
				'email_number' => $rangeStart,
				'email_seen' => $overview[0]->seen,
				//'message' => $message ?? '(No Message)',
			]);
		}

                $rangeStart++;
            }
        }
        //dd($emailDetailsOldData);
        return $emailDetailsOldData;

    }

    private function allInboxFetchmanual($inbox, $msgUnseenAll){
        $emails = imap_search($inbox, $msgUnseenAll);

        $emailDetails = []; // Array to store email details

        if ($emails) {
            rsort($emails); // Sort emails in descending order

            foreach ($emails as $email_number) {
                $overview = imap_fetch_overview($inbox, $email_number, 0);
                //$message = imap_fetchbody($inbox, $email_number, 1);

                $emailDetails[] = [
                    'subject' => $overview[0]->subject ?? '(No Subject)',
                    'from' => $overview[0]->from ?? '(Unknown Sender)',
                    'date' => $overview[0]->date ?? '(No Date)',
                    'email_number' => $email_number,
                    'email_seen' => $overview[0]->seen,
                    //'message' => $message ?? '(No Message)',
                ];
            }
        }
        //dd($emails);
        return $emailDetails;
    }
}