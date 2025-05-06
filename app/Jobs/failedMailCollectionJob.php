<?php

namespace App\Jobs;

use App\Models\configSMTP;
use App\Models\failedMailCollection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class failedMailCollectionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;

    /**
     * Create a new job instance.
     */
    public function __construct($userId)
    {
        $this->userId = $userId;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $userId = $this->userId;
        $configSMTP = configSMTP::where('uid', $userId)->first();

        $EmailUsername = $configSMTP->EmailUsername;
        $EmailPasswoard = $configSMTP->EmailPasswoard;
        $imapHostServer = $configSMTP->imapHostServer;
        $imapPort = $configSMTP->imapPort;
        $imapInboxFrom = $configSMTP->imapInboxFrom ?? 'INBOX';
        
        //Email label Found

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


}