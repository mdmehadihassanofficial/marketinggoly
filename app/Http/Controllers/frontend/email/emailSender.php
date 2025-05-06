<?php

namespace App\Http\Controllers\frontend\email;

use App\Http\Controllers\Controller;
use App\Jobs\directEmailSendSMTP;
use App\Jobs\directSendEmailJob;
use App\Mail\directEmailSender;
use App\Models\configSMTP;
use App\Models\emailCampaign;
use App\Models\emailCollection;
use App\Models\emailTemplate;
use App\Models\emailTemplateDesign;
use App\Models\emailtrackings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;

use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\Exception;

class emailSender extends Controller
{
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }
    public function emailDirectSenderView(){
        $userId = $this->userId();
        //$emailTemplate = emailTemplate::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
        $emailTemplate = DB::table('email_template_designs')
                                        ->join('email_templates', 'email_templates.id', '=', 'email_template_designs.etid')
                                        //->join('orders', 'users.id', '=', 'orders.user_id')
                                        ->select('email_template_designs.etid', 'email_templates.*')
                                        ->where('email_template_designs.uid', $userId)
                                        ->orderBy('email_template_designs.etid', 'DESC')
                                        ->get();
        $emailCampaign = emailCampaign::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
        return view('frontend.email.send.direct', compact('emailTemplate', 'emailCampaign'));
    }

    public function shortCodeM() {
        $shortCode = substr( str_shuffle( str_repeat( $x = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMONPQRSTUVWXYZ", ceil( 100 / strlen( $x ) ) ) ), 1, 100 );
        $codeCheck = DB::table( 'short_links' )->where( 'shortCode', $shortCode )->first();
        if ( $codeCheck ) {
            $codePass = $this->shortCodeM();
            return $codePass;
        } else {
            $codePass = $shortCode;
            return $codePass;
        }
    }

    

public function emailDirectSenderSend(Request $request) {
    $validator = Validator::make($request->all(), [
        'emailSubject' => 'required',
        'emailTemplate' => 'required',
        'emailCampaign' => 'required',
    ]);

    $userId = $this->userId();

    if ($validator->fails()) {
        return response()->json(['errors' => 'Sorry, looks like there are some validation errors detected: ' . $validator->errors()]);
    } else {
        $emailSubject = $request->emailSubject;
        $emailTemplateId = $request->emailTemplate;
        $emailCampaignId  = $request->emailCampaign;

        // Fetch Email Template Data
        $emailTemplateData = emailTemplate::where('uid', $userId)->where('id', $emailTemplateId)->orderBy('id', 'DESC')->first();
        $emailTemplateDesignData = emailTemplateDesign::where('uid', $userId)->where('etid', $emailTemplateId)->first();

        // Fetch Email Campaign Data
        $emailCampaignData = emailCampaign::where('uid', $userId)->where('id', $emailCampaignId)->orderBy('id', 'DESC')->first();
        $emailCollectionData = emailCollection::where('uid', $userId)->where('emailCampaignsId', $emailCampaignId)->orderBy('id', 'DESC')->get();

        // SMTP Configaration
        $smtpSettingData = configSMTP::where('uid', $userId)->first();

        // Modify Template
        $html = $emailTemplateDesignData->html;
        $css = $emailTemplateDesignData->css;

        // Start sending emails to the list
        foreach ($emailCollectionData as $emailData) {
            // Email Open Tracking Code
            $code = $this->shortCodeM();
            $trackOpen = '<img src="' . route('emailOpenTrack', $code) . '" width="1px" height="1px" class="trackMyOpen258">';
            $htmlUpdateWithTrack = $html . ' ' . $trackOpen;

            // Convert CSS to inline styles
            $cssToInlineStyles = new CssToInlineStyles();
            $emailHTMLContent = $cssToInlineStyles->convert($htmlUpdateWithTrack, $css);

            // Update links in the HTML content
            $dom = new \DOMDocument();
            @$dom->loadHTML($emailHTMLContent);
            $links = $dom->getElementsByTagName('a');
            
            foreach ($links as $link) {
                $oldHref = $link->getAttribute('href');
                $newHref = $oldHref . '?link='.$code;
                $link->setAttribute('href', $newHref);
            }

            // Save the updated HTML
            $updatedHtmlCSS = $dom->saveHTML();
            //dd($updatedHtmlCSS);
            // Prepare the data for the email view
            // $emailDataArray = [
            //     'htmlContent' => $updatedHtmlCSS,
            //     'emailSubject' => $emailSubject
            // ];

            // Send email using Laravel's Mail facade and the Mailable class
            //Mail::to($emailData->email)->send(new directEmailSender($updatedHtmlCSS, $emailSubject ));

            //dd($updatedHtmlCSS);

            // Dispatch the email job to the queue
           // directSendEmailJob::dispatch($emailData, $updatedHtmlCSS, $emailSubject, $smtpSettingData, $code)->onQueue('medium');
            directEmailSendSMTP::dispatch($emailData, $updatedHtmlCSS, $emailSubject, $smtpSettingData, $code)->onQueue('medium');
        }

        return response()->json(['success' => 'Emails have been sent successfully!']);
    }
}

    

        /*
    Open Email Tracking
     */
    public function emailOpenTrack( $code ) {

        $count = DB::table( 'emailtrackings' )->where( 'shortcode', $code )->count();
        if ( $count > 0 ) {
            $select = DB::table( 'emailtrackings' )->where( 'shortcode', $code )->first();

            $id = $select->id;
            $openCount = $select->opencount;
            $openUpdate = $openCount + 1;

            if ( $openCount == 0 ) {
                $todayDate = Carbon::now();
                $update = emailtrackings::findOrFail( $id );
                $update->opencount = $openUpdate;
                $update->opendate = $todayDate;
                $update->lastopendate = $todayDate;
                $update->save();
            } else {
                $lastOpenDate = Carbon::now();
                $update = emailtrackings::findOrFail( $id );
                $update->opencount = $openUpdate;
                $update->lastopendate = $lastOpenDate;
                $update->save();
            }
        } else {
            //echo "I am not get data";
        }
    }
}