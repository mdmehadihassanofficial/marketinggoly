<?php

namespace App\Jobs;

use App\Mail\directEmailSender;
use App\Models\emailtrackings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Exception;

class directSendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $emailData;
    public $emailContent;
    public $emailSubject;
    public $smtpSettingData;
    public $code;
    
    public function __construct($emailData, $emailContent, $emailSubject,  $smtpSettingData, $code)
    {
        $this->emailData = $emailData;
        $this->emailContent = $emailContent;
        $this->emailSubject = $emailSubject;
        $this->smtpSettingData = $smtpSettingData;
        $this->code = $code;
    }

    public function handle(): void
    {
        try {
            $this->setSmtpConfig($this->smtpSettingData);
            
            // Send the email using the mailable class
            Mail::to($this->emailData->email)->send(new directEmailSender($this->emailContent, $this->emailSubject));
    
            // Log email tracking after successful sending
            emailtrackings::create([
                'cid' => $this->emailData->emailCampaignsId,
                'emailid' => $this->emailData->id,
                'semail' => $this->emailData->email,
                'shortcode' => $this->code,
            ]);
        } catch (Exception $e) {
            // Log error message for failed sending
            Log::error('Failed to send email to ' . $this->emailData->email . ': ' . $e->getMessage());
            throw $e;  // Re-throw to let the queue handle retries or failures
        }
    }
    

    protected function setSmtpConfig($smtpSettings)
    {
        try {
            Config::set('mail.mailers.smtp.host', $smtpSettings->Host);
            Config::set('mail.mailers.smtp.port', $smtpSettings->Port);
            Config::set('mail.mailers.smtp.encryption', $smtpSettings->SMTPSecure);
            Config::set('mail.mailers.smtp.username', $smtpSettings->EmailUsername);
            Config::set('mail.mailers.smtp.password', $smtpSettings->EmailPassword); // Fixed typo
            Config::set('mail.from.address', $smtpSettings->SetFrom);
            Config::set('mail.from.name', $smtpSettings->EmailName);
            Config::set('mail.reply_to.address', $smtpSettings->ReplyToEmail);
            Config::set('mail.reply_to.name', $smtpSettings->ReplyToEmailName);
        } catch (Exception $e) {
            Log::error('SMTP configuration failed: ' . $e->getMessage());
            throw new Exception('Failed to set SMTP configuration');
        }
    }
}