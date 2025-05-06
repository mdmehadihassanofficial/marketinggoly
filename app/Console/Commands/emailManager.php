<?php

namespace App\Console\Commands;

use App\Models\configSMTP;
use App\Models\emailCampaign;
use App\Models\emailCollection;
use App\Models\emailManager as ModelsEmailManager;
use App\Models\emailTemplateDesign;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use App\Jobs\directEmailSendSMTP;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class emailManager extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:manager';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Auto Send Manager';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $dateTime = $now->toDateTimeString();

        $emailsToProcess = ModelsEmailManager::where('postDateTime', '<=', $dateTime)
            ->where('status', 1)
            ->get();

        foreach ($emailsToProcess as $emailManager) {
            $this->processEmailManager($emailManager);
        }

        Log::channel('email')->info('Email Manager executed at: ' . now());
    }

    private function processEmailManager($emailManager)
    {
        try {
            // Mark the email as processing
            $emailManager->update(['postStatus' => 3]);

            $userId = $emailManager->uid;
            $emailCampaignId = $emailManager->emailCampaignId;
            $emailTemplateIds = json_decode($emailManager->emailTemplateId);
            $emailSubject = $emailManager->emailSubject;

            $emailCampaign = emailCampaign::where('uid', $userId)->find($emailCampaignId);
            $emailCollection = emailCollection::where('uid', $userId)
                ->where('emailCampaignsId', $emailCampaignId)->where('status', 1)
                ->get();
            $smtpSettings = configSMTP::where('uid', $userId)->first();

            $emailTemplateId = $this->getRandomTemplateId($emailTemplateIds);
            $emailTemplate = emailTemplateDesign::where('uid', $userId)
                ->where('etid', $emailTemplateId)
                ->first();

            $updatedHtml = $this->prepareEmailHtml($emailTemplate->html, $emailTemplate->css);

            foreach ($emailCollection as $emailData) {
                if ($emailData->status == 1) {
                    $code = $this->generateShortCode();
                    $emailContent = $this->embedTracking($updatedHtml, $code);
                    directEmailSendSMTP::dispatch($emailData, $emailContent, $emailSubject, $smtpSettings, $code, $emailManager->id, $emailTemplateId, $emailManager->postDateTime)->onQueue('medium');
                    //Log::channel('email')->error('Email processing email ' . $emailData->email);
                }
            }

            $this->updateEmailManager($emailManager);
        } catch (Exception $e) {
            Log::channel('email')->error('Error processing email manager: ' . $e->getMessage());
        }
    }

    private function getRandomTemplateId(array $templateIds)
    {
        return $templateIds[array_rand($templateIds)];
    }

    private function prepareEmailHtml($html, $css)
    {
        $cssToInlineStyles = new CssToInlineStyles();
        return $cssToInlineStyles->convert($html, $css);
    }

    private function embedTracking($html, $code)
    {
        $trackOpen = '<img src="' . route('emailOpenTrack', $code) . '" width="1" height="1" class="trackMyOpen258">';
        $htmlWithTracking = $html . ' ' . $trackOpen;

        $dom = new \DOMDocument();
        @$dom->loadHTML($htmlWithTracking);
        foreach ($dom->getElementsByTagName('a') as $link) {
            $href = $link->getAttribute('href');
            $link->setAttribute('href', $href . '?link=' . $code);
        }

        return $dom->saveHTML();
    }

    private function updateEmailManager($emailManager)
    {
        $totalRepeatPost = $emailManager->totalRepeatPost + 1;
        $postStatus = 2;
        $nextPostDateTime = null;
        $postDateTime = null;
        
        if ($emailManager->postRepeatStatus == 1) {
            $postStatus = 0;
            $postDateTime = $emailManager->nextPostDateTime;
            $nextPostDateTime = $this->calculateNextPostDate($emailManager);
        }

        $emailManager->update([
            'postDateTime' => $postDateTime,
            'postStatus' => $postStatus,
            'nextPostDateTime' => $nextPostDateTime,
            'totalRepeatPost' => $totalRepeatPost,
            'notificationStatus' => 0,
        ]);

        Log::channel('email')->info('Email manager updated successfully for ID: ' . $emailManager->id);
    }

    private function calculateNextPostDate($emailManager)
    {
        $repeatInterval = match ($emailManager->postRepeatType) {
            'daily' => 1,
            'weekly' => 7,
            'monthly' => 30,
            default => 0,
        };

        if ($repeatInterval === 0) {
            return null;
        }

        $nextPostDate = Carbon::parse($emailManager->nextPostDateTime)->addDays($repeatInterval);

        if ($emailManager->endPostDateTime) {
            $endPostDate = Carbon::parse($emailManager->endPostDateTime);
            return $nextPostDate->lessThan($endPostDate) ? $nextPostDate : null;
        }

        return $nextPostDate;
    }

    private function generateShortCode()
    {
        do {
            $shortCode = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 10)), 0, 100);
        } while (DB::table('short_links')->where('shortCode', $shortCode)->exists());

        return $shortCode;
    }
}