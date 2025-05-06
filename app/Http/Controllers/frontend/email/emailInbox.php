<?php

namespace App\Http\Controllers\frontend\email;

use App\Http\Controllers\Controller;
use App\Jobs\FetchAndCacheEmails;
use App\Models\configSMTP;
use App\Models\failedMailCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Cache;

class emailInbox extends Controller
{
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }

    public function checkEmailInbox(){
        $userId = $this->userId();
        //$cacheKey = 'email_inbox_' . $userId;
        $cacheKey = 'email_ALL_' . $userId;

        // Check if the cache exists, else fetch, set, and cache it
        //if (!Cache::has($cacheKey)) {
            $configSMTP = configSMTP::where('uid', $userId)->first();

            $EmailUsername = $configSMTP->EmailUsername;
            $EmailPasswoard = $configSMTP->EmailPasswoard;
            $imapHostServer = $configSMTP->imapHostServer;
            $imapPort = $configSMTP->imapPort;
            $imapInboxFrom = $configSMTP->imapInboxFrom ?? 'INBOX';
            
            // Server IMAP server details
            $hostname = '{'.$imapHostServer.':'.$imapPort.'/imap/ssl}'.$imapInboxFrom;
            $username = $EmailUsername;
            $password = $EmailPasswoard;

            $inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

            $emailDetails = Cache::get($cacheKey);
            //$countEmailInbox = count($emailDetails);
            if(!empty($emailDetails) ){
                $rangeStart = $emailDetails[0]['email_number'] +1 ;
                $range = $rangeStart.":*"; // Fetch all emails starting from 70
                //$range = $countEmailInbox.":*"; // Fetch all emails starting from 70
                 //dd($emailDetails[0]);
                
                $emails = imap_fetch_overview($inbox, $range, );
            }else{
                $emails = imap_search($inbox, 'ALL');
                //$emails = null;
            }


            dd($emails);


            $emails = imap_search($inbox, 'ALL');

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
                        //'message' => $message ?? '(No Message)',
                    ];
                }
            }

            imap_close($inbox);

            // Cache the array for 60 minutes
            Cache::put($cacheKey, $emailDetails, now()->addMinutes(60));
        // } else {
        //     // Retrieve the cached array
        //     $emailDetails = Cache::get($cacheKey);
        // }

        // Pass the cached or fresh email details to the view
        return view('frontend.email.emailInbox.listEmail', compact('emailDetails'));
    }

    // Email Single View
    public function emailSingleView($seenUnseen, $emialNumberId){
        // return view('frontend.email.emailInbox.view');
        // die();
        $userId = $this->userId();
        $configSMTP = configSMTP::where('uid', $userId)->first();
        if($configSMTP){
            if($seenUnseen === 'UNSEEN' OR $seenUnseen === 'ALL' ){
                $EmailUsername = $configSMTP->EmailUsername;
                $EmailPasswoard = $configSMTP->EmailPasswoard;
                $imapHostServer = $configSMTP->imapHostServer;
                $imapPort = $configSMTP->imapPort;
                $imapInboxFrom = $configSMTP->imapInboxFrom ?? 'INBOX';
                
                // Server IMAP server details
                $hostname = '{'.$imapHostServer.':'.$imapPort.'/imap/ssl}'.$imapInboxFrom;
                $username = $EmailUsername;
                $password = $EmailPasswoard;
            
                $inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());
                $overview = imap_fetch_overview($inbox, $emialNumberId, 0);


                $structure = imap_fetchstructure($inbox, $emialNumberId);

                //dd($structure);
                $message = null;
                //$structure = imap_fetchstructure($inbox, $id);

                if (!empty($structure->parts)) {
                    // Iterate through the parts to find the HTML part
                    foreach ($structure->parts as $index => $part) {
                    if ($part->subtype == 'HTML') {
                        $message = imap_fetchbody($inbox, $emialNumberId, $index + 1);
                        if ($part->encoding == 3) { // BASE64
                        $message = imap_base64($message);
                        } elseif ($part->encoding == 4) { // Quoted-printable
                        $message = quoted_printable_decode($message);
                        }
                        break;
                    }
                    }
                } else {
                    // When parts are empty, fetch the main body
                    $message = imap_fetchbody($inbox, $emialNumberId, 1);
                    
                    // Check if the main body is in HTML format
                    if ($structure->subtype == 'HTML') {
                    if ($structure->encoding == 3) { // BASE64
                        $message = imap_base64($message);
                    } elseif ($structure->encoding == 4) { // Quoted-printable
                        $message = quoted_printable_decode($message);
                    }
                    } else {
                    // If the main body is not in HTML, you might need to handle plain text or other formats
                    if ($structure->encoding == 3) { // BASE64
                        $message = imap_base64($message);
                    } elseif ($structure->encoding == 4) { // Quoted-printable
                        $message = quoted_printable_decode($message);
                    }
                    }
                }

                if (empty($message)) {
                    $message = imap_body($inbox, $emialNumberId);
                }
                imap_close($inbox);

                $this->messageSeenStatusUpdate($userId, $seenUnseen,  $emialNumberId);

                
                return view('frontend.email.emailInbox.view', compact('message', 'overview'));

            }
        } 
    }

    private function messageSeenStatusUpdate($userId, $seenUnseen,  $emialNumberId){
        $cacheKey = 'email_'.$seenUnseen.'_' . $userId;
        $emailDetails = Cache::get($cacheKey);

        $startIndex = array_search($emialNumberId, array_column($emailDetails, "email_number"));

        if ($startIndex !== false) {
            for ($i = $startIndex; $i < count($emailDetails); $i++) {
                if($emailDetails[$i]["email_number"] == $emialNumberId){
                    $emailDetails[$i]["email_seen"] = 1;
                    break;
                }
                //$emailDetails[$i]["email_seen"] = 0;
            }
            // Store the updated data back in the cache
           // dd($emailDetails);
            Cache::put($cacheKey, $emailDetails, now()->addHours(24)); // Adjust TTL as needed
        }
    }

    public function iframSrcEmailInboxSingle(){
        $userId = $this->userId();
        $configSMTP = configSMTP::where('uid', $userId)->first();
        if($configSMTP){
            
                $EmailUsername = $configSMTP->EmailUsername;
                $EmailPasswoard = $configSMTP->EmailPasswoard;
                $imapHostServer = $configSMTP->imapHostServer;
                $imapPort = $configSMTP->imapPort;
                $imapInboxFrom = $configSMTP->imapInboxFrom ?? 'INBOX';
                
                // Server IMAP server details
                $hostname = '{'.$imapHostServer.':'.$imapPort.'/imap/ssl}'.$imapInboxFrom;
                $username = $EmailUsername;
                $password = $EmailPasswoard;
            
                $inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());
                
                // Get yesterday's date
                $yesterday = date('d-M-Y', strtotime('-1 day'));
                $emails = imap_search($inbox, 'SINCE "'.$yesterday.'" BEFORE "'.date('d-M-Y').'"');
                if ($emails) {
                    rsort($emails);
                    foreach ($emails as $email_number) {
                        // Fetch the email overview
                        $overview = imap_fetch_overview($inbox, $email_number, 0)[0];
                        
                        // Fetch the email subject
                        $subject = iconv_mime_decode($overview->subject, 0, "UTF-8");

                        $subjectMatch = $this->emailFailSubjectMatch($subject);

                        
                        //dd($subjectMatch);

                        if($subjectMatch == true){

                            $headers = imap_fetchheader($inbox, $email_number);
        
                            // Extract the X-Failed-Recipients email address
                            if (preg_match('/X-Failed-Recipients:\s*([\w\.-]+@[\w\.-]+\.[a-zA-Z]+)/i', $headers, $matches)) {
                                $failedEmail  =  $matches[1];

                                $failedMailCheckDatabase = failedMailCollection::where('email', $failedEmail)->first();
                                $repeateFailedNumber =  $failedMailCheckDatabase->repeateFailedNumber ?? 0;
                                if(!$failedMailCheckDatabase){
                                    $repeateFailedNumber++;
                                    $failedMailCollection = new failedMailCollection();
                                    $failedMailCollection->uid = $userId;
                                    $failedMailCollection->email = $failedEmail;
                                    $failedMailCollection->repeateFailedNumber  = $repeateFailedNumber;
                                    $failedMailCollection->save();
                                }else{
                                    $repeateFailedNumber++;
                                    $failedMailCheckDatabase->repeateFailedNumber = $repeateFailedNumber;
                                    $failedMailCheckDatabase->save();
                                }
                            } else {
                                $failedEmail = null; 
                            }

                        }
                        
                    }
                    imap_close($inbox);
                }
                
        }

	//return view('frontend.email.emailInbox.iframeSrc');
    }

    private function emailFailSubjectMatch($getSubjects){
        //$getSubjects2 = 'Delivery Status Notification (Failure)';
        $failed_email_subjects = [
            // General Mail Servers (Exim, Postfix, Sendmail, etc.)
            "Mail Delivery Failed: Returning Message to Sender",
            "Undelivered Mail Returned to Sender",
            "Delivery Status Notification (Failure)",
            "Message Undeliverable",
            "Delivery Failed: Returned Mail",
            "Failed Delivery Notification",
        
            // Google (Gmail, Google Workspace)
            "Your message wasn’t delivered to [recipient]",
        
            // Microsoft (Outlook, Office 365, Exchange, Hotmail, Live)
            "Undeliverable: [Your Email Subject]",
            "Delivery has failed to these recipients or groups",
            "Your message couldn’t be delivered",
        
            // Yahoo Mail (Yahoo, AOL)
            "Delivery Failure",
            "Mail Delivery Error - Mailbox Unavailable",
            "Message not delivered: Unable to relay",
        
            // Apple Mail (iCloud, Mac.com, Me.com)
            "Delivery failed: Message could not be delivered",
            "Your message was not delivered",
        
            // Zoho Mail
            "Mail Delivery Failed: Address not found",
            "Message Delivery Failure",
        
            // ProtonMail
            "Message Undeliverable",
        
            // Yandex Mail
            "Message could not be delivered",
            "Error sending email: Address not found",
        
            // FastMail
            "Delivery Failure Notification",
            "Message Bounced: Address not found",
        
            // GMX / Mail.com
            "Email Delivery Failed",
            "Your email could not be delivered",
        
            // ISP / Web Hosting Mail Servers (GoDaddy, Bluehost, cPanel, etc.)
            "Permanent Error: Message Not Delivered",
            "Delivery Failure - Address Rejected"
        ];
        
        // Example usage: Print all subjects
        foreach ($failed_email_subjects as $subjectItem) {
            if ($subjectItem == $getSubjects) {
                return true;
            }
        }

        return false;
    }

//     array:1 [▼ // app\Http\Controllers\frontend\email\emailInbox.php:94
//   0 => { ▼
//     +"subject": "Delivery Status Notification (Delay)"
//     +"from": "Mail Delivery Subsystem <mailer-daemon@googlemail.com>"
//     +"to": "coexactemail@gmail.com"
//     +"date": "Tue, 28 Jan 2025 14:56:09 -0800 (PST)"
//     +"message_id": "<67996089.050a0220.14dd56.505f.GMR@mx.google.com>"
//     +"references": "<Kk2DKJ2g7zojqTzOLKGYHUB3HP33pC3webCQsz3gKYw@localhost.localdomain>"
//     +"in_reply_to": "<Kk2DKJ2g7zojqTzOLKGYHUB3HP33pC3webCQsz3gKYw@localhost.localdomain>"
//     +"size": 17834
//     +"uid": 746
//     +"msgno": 77
//     +"recent": 0
//     +"flagged": 0
//     +"answered": 0
//     +"deleted": 0
//     +"seen": 1
//     +"draft": 0
//     +"udate": 1738104970
//   }
// ]

    public function emailInbox(){
        $userId = $this->userId();
        $cacheKey = 'email_ALL_' . $userId;

        // Retrieve the cached array
        $emailDetails = [];
        $countEmailInbox = null;
        if (Cache::has($cacheKey)) {
            $emailDetails = Cache::get($cacheKey);
            $countEmailInbox = count($emailDetails);
        }else{
            //FetchAndCacheEmails::dispatch($userId, 'UNSEEN')->onQueue('medium');
            FetchAndCacheEmails::dispatch($userId, 'ALL')->onQueue('medium');
        }


        //dd($countEmailInbox);
        // Pass the cached or fresh email details to the view
        return view('frontend.email.emailInbox.listEmail', compact('emailDetails', 'countEmailInbox'));
    }

    public function emailInboxUnseen(){
        $userId = $this->userId();
        $cacheKey = 'email_UNSEEN_' . $userId;

        // Retrieve the cached array
        $emailDetails = [];
        $countEmailInbox = null;
        if (Cache::has($cacheKey)) {
            $emailDetails = Cache::get($cacheKey);
            $countEmailInbox = count($emailDetails);
        }else{
            FetchAndCacheEmails::dispatch($userId, 'UNSEEN')->onQueue('medium');
        }

        //dd($countEmailInbox);
        // Pass the cached or fresh email details to the view
        return view('frontend.email.emailInbox.unseen', compact('emailDetails', 'countEmailInbox'));
    }

    public function emailInboxUnseenReload(){
        $userId = $this->userId();
        //$cacheKey = 'email_UNSEEN_' . $userId;
        // FetchAndCacheEmails::dispatch($userId, 'UNSEEN')->onQueue('high');
        
        $this->manualReloadInbox($userId, 'UNSEEN');
        return redirect()->route('user.emailInboxUnseen');
    }

    public function emailInboxReload(){
        $userId = $this->userId();
        //$cacheKey = 'email_UNSEEN_' . $userId;
        // FetchAndCacheEmails::dispatch($userId, 'ALL')->onQueue('high');
       
        $this->manualReloadInbox($userId, 'ALL');
         return redirect()->route('user.emailInbox');
    }

    public function manualReloadInbox($userId, $msgUnseenAll){
        $cacheKey = 'email_'.$msgUnseenAll.'_' . $userId;

        $configSMTP = configSMTP::where('uid', $userId)->first();

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
        if(!empty($emailDetailsOldData)){
            $emailDetails = $this->specificNumberInboxGet($inbox, $msgUnseenAll, $emailDetailsOldData);
        }else{
            $emailDetails = $this->allInboxFetchmanual($inbox, $msgUnseenAll);
        }
        
       // dd($emailDetails);

        imap_close($inbox);

        // Cache the array for 60 minutes
        Cache::put($cacheKey, $emailDetails, now()->addHours(24));

        if($msgUnseenAll == 'UNSEEN'){
            return redirect()->route('user.emailInboxUnseen');
        }elseif($msgUnseenAll == 'ALL'){
            return redirect()->route('user.emailInbox');
        }else{
            return redirect()->route('user.dashboard');
        }
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
                    //'message' => $message ?? '(No Message)',
                ];
            }
        }
        //dd($emails);
        return $emailDetails;
    }
}