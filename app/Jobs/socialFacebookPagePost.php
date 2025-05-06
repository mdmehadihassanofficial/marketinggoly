<?php

namespace App\Jobs;

use App\Models\configFacebookpage;
use App\Models\socialPostReport;
use App\Models\socialTemplate;
use App\trait\userPushNotificationSend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class socialFacebookPagePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use userPushNotificationSend;

    /**
     * Create a new job instance.
     */
    public $userId;
    public $socialMediaItem;
    public $socialPostManagerId;
    public $socialTemplateId;
    public $postDateTime;
    
    public function __construct($userId, $socialMediaItem, $socialPostManagerId, $socialTemplateId, $postDateTime)
    {
        $this->userId = $userId;
        $this->socialMediaItem = $socialMediaItem;
        $this->socialPostManagerId = $socialPostManagerId;
        $this->socialTemplateId = $socialTemplateId;
        $this->postDateTime = $postDateTime;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $facebookGetResult = $this->facebookPostToPage($this->userId, $this->socialMediaItem, $this->socialPostManagerId, $this->socialTemplateId, $this->postDateTime);
    }

    public function facebookPostToPage($userId, $socialMediaItem, $socialPostManagerId, $socialTemplateId, $postDateTime)
    {

        $facebookPostData = socialTemplate::where('id', '=', $socialTemplateId)->first();
        if ($facebookPostData) {
            $postImages    = $facebookPostData->postImage;
            $postMessage    = $facebookPostData->postMessage;

            // Split the string by the delimiter '-'
            $parts = explode('-',  $socialMediaItem);
            $getPageId = end($parts);

            $facebookPageData = configFacebookpage::where('pageId', '=', $getPageId)->first();
            
            if ($facebookPageData) {
                $pageId = $facebookPageData->pageId;
                $pageAccessToken = $facebookPageData->pageAccessToken;
                $graphApiUrl = "https://graph.facebook.com/v16.0";

                if($postImages =="imageNotSet"){
                    try {
                        // Post text to the Facebook page
                        $postResponse = Http::post("{$graphApiUrl}/{$pageId}/feed", [
                            'access_token' => $pageAccessToken,
                            'message' => $postMessage,
                        ]);
            
                        $postData = $postResponse->json();
                        
                        //dd($postData['error']['message']);


                        if (!empty($postData['id']) || !empty($postData['post_id'])) {
                            $postId = $postData['id'] ?? 'Unknown ID';
                            $response = response()->json([
                                'success' => true,
                                'message' => "Facebook Page Posted Successfully, Id: {$postId}",
                                'status'  => 200,
                            ]);
                        } elseif (!empty($postData['error'])) {
                            $errorMessage = $postData['error']['message'] ?? 'Unknown error message';
                            $errorCode = $postData['error']['code'] ?? 'Unknown error code';
                            $response = response()->json([
                                'success' => false,
                                'message' => "Facebook Page Not Posted: {$errorMessage}",
                                'status'  => $errorCode,
                            ]);
                        } else {
                            $response = response()->json([
                                'success' => false,
                                'message' => 'Unknown error occurred',
                                'status'  => 500,
                            ]);
                        }
                        
            
                        // return response()->json([
                        //     'success' => true,
                        //     'post_id' => $postData['id'],
                        //     'message' => 'Post created successfully!',
                        // ]);
                    } catch (\Exception $e) {
                        $response = response()->json([
                            'success' => true,
                            'message' => "Facebook Page Post Something Wrong",
                            'status'    => "500",
                        ]);

                    }
                   // dd("Only Image");
                }else{
                    $imageFile = public_path($postImages);
                   // dd($imageFile);
                                // Upload the image to Facebook
                    $imageResponse = Http::attach(
                        'source',
                        fopen($imageFile, 'r'),
                        basename($imageFile)
                        //$request->file('image')->getClientOriginalName()
                    )->post("{$graphApiUrl}/{$pageId}/photos", [
                        'access_token' => $pageAccessToken,
                        'caption' => $postMessage,
                    ]);

                    $imageData = $imageResponse->json();

                    if (!empty($imageData['id']) OR !empty($imageData['post_id']) ) {
                        $response = response()->json([
                            'success' => true,
                            'message' => "Facebook Page Posted Successfully. Id: ".$imageData['post_id'],
                            'status'    => "200",
                        ]);
                    }elseif(!empty($imageData['error'])){
                        $response = response()->json([
                            'success' => false,
                            'message' => "Facebook Page Not Image Posted ".$imageData['error']['message'],
                            'status'    => $imageData['error']['code'],
                        ]);
                    }

                    if (!empty($imageData['id']) || !empty($imageData['post_id'])) {
                        $postId = $imageData['id'] ?? 'Unknown ID';
                        $response = response()->json([
                            'success' => true,
                            'message' => "Facebook Page Posted Successfully, Id: {$postId}",
                            'status'  => 200,
                        ]);
                    } elseif (!empty($imageData['error'])) {
                        $errorMessage = $imageData['error']['message'] ?? 'Unknown error message';
                        $errorCode = $imageData['error']['code'] ?? 'Unknown error code';
                        $response = response()->json([
                            'success' => false,
                            'message' => "Facebook Page Not Posted: {$errorMessage}",
                            'status'  => $errorCode,
                        ]);
                    } else {
                        $response = response()->json([
                            'success' => false,
                            'message' => 'Unknown error occurred',
                            'status'  => 500,
                        ]);
                    }
                    
                }

                try {
                    socialPostReport::create( array(
                        'uid'       => $userId,
                        'stId'       => $socialTemplateId,
                        'spmId'       => $socialPostManagerId,
                        'postDateTime'       => $postDateTime,
                        'socialMedia'       => $socialMediaItem,
                        'postMessage'       => $response,
                        'totalTryingNumber'       => 1,
                    ) );

                    // Start
                    // Notification Send Start Here
                    preg_match('/{([^{}]*)}$/', $response, $parts);
                    // Output the content
                    $jsonContent = null;
                    $notificationBody  =   'Facebook '.$facebookPageData->pageName.' Page Post Something Error Message';
                    if (!empty($parts[1])) {
                        $jsonContent = $parts[0]; // This will give the second bracket's content including braces
                    }

                    if ($jsonContent) {
                        $data = json_decode($jsonContent, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $notificationBody  =   $data['message'];
                        } 
                    }

                    $notificationTitle = "Facebook ".$facebookPageData->pageName." Page Post Notification Status";
                    if($postImages == 'imageNotSet'){
                        $notificationImage = public_path('notification/x.webp');
                        //$notificationImage = 'http://127.0.0.1:8000/assets/media/logos/default-small.svg';
                    }else{
                        $notificationImage = public_path($postImages);
                    }
                    $notificationLink = route('user.socialPostManageView');
                // $notificationLink = 'https://www.banglacyber.com/saudi-riyal-to-taka/';            
                    $this->pushNotificationSend($notificationTitle, $notificationBody, $notificationImage, $notificationLink, $userId);
                    // End
                    // Notification Send End Here

                } catch (\Exception  $th) {
                    //Log::error();
                    Log::channel('social')->error('Facebook page Data Not Insert'. $th->getMessage());
                }
            }
        }

    }



}