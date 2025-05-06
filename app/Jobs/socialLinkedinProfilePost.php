<?php

namespace App\Jobs;

use App\Models\configLinkedIn;
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

class socialLinkedinProfilePost implements ShouldQueue
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
        $linkedInGetResult = $this->linkedInPost($this->userId, $this->socialMediaItem, $this->socialPostManagerId, $this->socialTemplateId, $this->postDateTime);
    }

    public function linkedInPost($userId, $socialMediaItem, $socialPostManagerId, $socialTemplateId, $postDateTime)
    {
        $linkedInData = configLinkedIn::where('uid', '=', $userId)->first();
        $accessToken = $linkedInData->linkedin_access_token;
        $response = Http::withToken($accessToken)->get('https://api.linkedin.com/v2/me');
        //var_dump($accessToken);
        //die;
        //dd($response );
        $linkedin_id = $response->json()['id']; // This is your LinkedIn ID

        //dd($response );
        $TemplateID = $socialTemplateId;
        $linkedInPostData = socialTemplate::where('id', '=', $TemplateID)->first();

        $author = 'urn:li:person:' . $linkedin_id; // Use your LinkedIn Person ID
        $message = $linkedInPostData->postMessage;
        $messageImage = $linkedInPostData->postImage;

        $response = null;
        if ($messageImage == 'imageNotSet') {
            // Make the API call to post to LinkedIn
            $textPostResponse = Http::withToken($accessToken)->post('https://api.linkedin.com/v2/ugcPosts', [
                'author' => $author,
                'lifecycleState' => 'PUBLISHED',
                'specificContent' => [
                    'com.linkedin.ugc.ShareContent' => [
                        'shareCommentary' => [
                            'text' => $message,
                        ],
                        'shareMediaCategory' => 'NONE',
                    ],
                ],
                'visibility' => [
                    'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
                ],
            ]);

            $textPostResult = $textPostResponse->json();

            if(!empty($textPostResult['id'])){
                $response = response()->json([
                    'success' => true,
                    'message' => "Linkedin Profile posted successfully Id: ".$textPostResult['id'],
                    'status'    => "200",
                ]);
                //dd('Text Post Send Successfully Id: ' .$textPostResult['id']);
            }elseif(!empty($textPostResult['message']) OR !empty($textPostResult['status'])){
                $response = response()->json([
                    'success' => false,
                    'message' => "Error Message: " . $textPostResult['message'],
                    'status'    => "Code: ".$textPostResult['status'],
                ]);
            }else{
                $response = response()->json([
                    'success' => false,
                    'message' => "Others Problem",
                    'status'    => "500",
                ]);
            }
            // else{

            //     //dd('Text Post Not  Send Message: ' .$textPostResult['message'].' Status Code: '. $textPostResult['status']);
            // }

           // dd($response->json()) ; // Output the response
        } else {
            $image_path = public_path($messageImage); // Local image path
            $response = $this->postToLinkedInWithImage($accessToken, $image_path, $message, $linkedin_id);
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
            $notificationBody  =   'LinkedIn Profile Post Something Error Message';
            if (!empty($parts[1])) {
                $jsonContent = $parts[0]; // This will give the second bracket's content including braces
            }

            if ($jsonContent) {
                $data = json_decode($jsonContent, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $notificationBody  =   $data['message'];
                } 
            }

            $notificationTitle = "LinkedIn Post Notification Status";
            if($messageImage == 'imageNotSet'){
                $notificationImage = public_path('notification/x.webp');
                //$notificationImage = 'http://127.0.0.1:8000/assets/media/logos/default-small.svg';
            }else{
                $notificationImage = public_path($messageImage);
            }
            $notificationLink = route('user.socialPostManageView');
           // $notificationLink = 'https://www.banglacyber.com/saudi-riyal-to-taka/';            
            $this->pushNotificationSend($notificationTitle, $notificationBody, $notificationImage, $notificationLink, $userId);
            // End
            // Notification Send End Here
        } catch (\Exception  $th) {
            Log::channel('social')->error('Data Not Insert'. $th->getMessage());
        }



    }

    public function postToLinkedInWithImage($access_token, $image_path, $message, $linkedin_id)
    {
        // Step 1: Register the image upload
        $registerUploadResponse = Http::withToken($access_token)->post('https://api.linkedin.com/v2/assets?action=registerUpload', [
            'registerUploadRequest' => [
                'owner' => 'urn:li:person:' . $linkedin_id, // Your LinkedIn ID
                'recipes' => ['urn:li:digitalmediaRecipe:feedshare-image'], // Media type
                'serviceRelationships' => [
                    [
                        'identifier' => 'urn:li:userGeneratedContent',
                        'relationshipType' => 'OWNER',
                    ],
                ],
                'supportedUploadMechanism' => ['SYNCHRONOUS_UPLOAD'],
            ],
        ]);

        // Check if image registration failed
        if ($registerUploadResponse->failed()) {
            $imageResponse = response()->json([
                'success' => false,
                'message' => "Failed to register image upload",
                'status'    => 500,
            ]);
            return $imageResponse;
        }

        $uploadResponseData = $registerUploadResponse->json();
        $uploadUrl = $uploadResponseData['value']['uploadMechanism']['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest']['uploadUrl'];
        $asset = $uploadResponseData['value']['asset'];

        // Step 2: Upload the image to LinkedIn's server
        $imageFile = fopen($image_path, 'r');
        $imageData = fread($imageFile, filesize($image_path));
        fclose($imageFile);

        $uploadImageResponse = Http::withBody($imageData, mime_content_type($image_path))->put($uploadUrl, [
            'headers' => [
                'Content-Type' => mime_content_type($image_path),
            ],
        ]);

        // Check if image upload failed
        if ($uploadImageResponse->failed()) {
           // dd($uploadImageResponse->json());
            $imageResponse = response()->json([
                'success' => false,
                'message' => "Failed to upload image to LinkedIn ",
                'status'    => 500,
            ]);
            return $imageResponse;
        }

        // Step 3: Create a post referencing the uploaded image
        $imagePostResponse = Http::withToken($access_token)->post('https://api.linkedin.com/v2/ugcPosts', [
            'author' => 'urn:li:person:' . $linkedin_id, // Your LinkedIn ID
            'lifecycleState' => 'PUBLISHED',
            'specificContent' => [
                'com.linkedin.ugc.ShareContent' => [
                    'shareCommentary' => [
                        'text' => $message,
                    ],
                    'shareMediaCategory' => 'IMAGE',
                    'media' => [
                        [
                            'status' => 'READY',
                            'description' => [
                                'text' => 'Image description',
                            ],
                            'media' => $asset,
                            'title' => [
                                'text' => 'Image Title',
                            ],
                        ],
                    ],
                ],
            ],
            'visibility' => [
                'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
            ],
        ]);


        $imagePostResult = $imagePostResponse->json();

        if(!empty($imagePostResult['id'])){
            $imageResponse = response()->json([
                'success' => true,
                'message' => "Linkedin Profile posted successfully Id: ".$imagePostResult['id'],
                'status'    => "200",
            ]);
            return $imageResponse;
            //dd('Text Post Send Successfully Id: ' .$textPostResult['id']);
        }elseif(!empty($imagePostResult['message']) OR !empty($imagePostResult['status'])){
            $imageResponse = response()->json([
                'success' => false,
                'message' => "Error Message: " . $imagePostResult['message'],
                'status'    => "Code: ".$imagePostResult['status'],
            ]);
            return $imageResponse;
        }else{
            $imageResponse = response()->json([
                'success' => false,
                'message' => "Others Problem",
                'status'    => "500",
            ]);
            return $imageResponse;
        }

        // // Check if post creation failed
        // if ($postResponse->failed()) {
        //     dd($postResponse->json());
        //     return response()->json(
        //         [
        //             'error' => 'Failed to create post',
        //             'details' => $postResponse->json(),
        //         ],
        //         500
        //     );
        // }

        // // Success response
        // // dd('get success');
        // return response()->json(
        //     [
        //         'message' => 'Post created successfully',
        //         'post_details' => $postResponse->json(),
        //     ],
        //     200
        // );
    }
}