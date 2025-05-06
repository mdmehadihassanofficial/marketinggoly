<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Models\emailtrackings;
use Illuminate\Support\Facades\Log;

//Load Composer's autoloader
//require 'vendor/autoload.php';

class directEmailSendSMTP implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $emailData;
    public $emailContent;
    public $emailSubject;
    public $smtpSettingData;
    public $code;
    public $emailManagerId;
    public $emailTemplateId;
    public $postDateTime;

    /**
     * Create a new job instance.
     */
    public function __construct($emailData, $emailContent, $emailSubject, $smtpSettingData, $code, $emailManagerId, $emailTemplateId, $postDateTime)
    {
        $this->emailData = $emailData;
        $this->emailContent = $emailContent;
        $this->emailSubject = $emailSubject;
        $this->smtpSettingData = $smtpSettingData;
        $this->code = $code;
        $this->emailManagerId = $emailManagerId;
        $this->emailTemplateId = $emailTemplateId;
        $this->postDateTime = $postDateTime;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $Config = $this->smtpSettingData;

        $mail = new PHPMailer(true);

        try {
            // Configure PHPMailer
            $mail->isSMTP();
            $mail->Host = $Config->Host;
            $mail->SMTPAuth = true;
            $mail->Username = $Config->EmailUsername;
            $mail->Password = $Config->EmailPasswoard;
            $mail->SMTPSecure = $Config->SMTPSecure;
            $mail->Port = $Config->Port;
            $mail->setFrom($Config->SetFrom, $Config->EmailName);
            $mail->addReplyTo($Config->ReplyToEmail, $Config->ReplyToEmailName);
            $mail->addAddress($this->emailData->email);

            $mail->isHTML(true);
            $mail->Subject = $this->emailSubject;
            $mail->Body = $this->emailContent;
            $mail->AltBody = 'Only HTML Support';
            
            // Attempt to send the email
            if ($mail->send()) {
                emailtrackings::create([
                    'cid' => $this->emailData->emailCampaignsId,
                    'emailtemplateid' => $this->emailTemplateId,
                    'emailmanagerid' => $this->emailManagerId,
                    'emailid' => $this->emailData->id,
                    'semail' => $this->emailData->email,
                    'shortcode' => $this->code,
                    'postDateTime' => $this->postDateTime,
                ]);
                Log::channel('email')->info('Email sent successfully to: ' . $this->emailData->email);
              //  Log::channel('email')->info('Email sent successfully code: ' . $mail->send());

            } else {
                Log::channel('email')->error('Failed to send email to: ' . $this->emailData->email);
                throw new \Exception('Failed to send email to: ' . $this->emailData->email);
            }
        } catch (Exception $e) {
            throw new \Exception('Email sending failed: ' . $e->getMessage());
            Log::channel('email')->error('Email sending failed: ' . $e->getMessage());
        }
    }
}