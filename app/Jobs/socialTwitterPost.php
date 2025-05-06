<?php

namespace App\Jobs;

use App\Models\configTwitterData;
use App\Models\socialTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\socialPostReport;
use App\trait\userPushNotificationSend;
use Illuminate\Support\Facades\Log;

class socialTwitterPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use userPushNotificationSend;

    /**
     * Create a new job instance.
     */

     public $socialMediaItem;
     public $socialTemplateId;
     public $socialPostManagerId;
     public $postDateTime;
     public $userId;


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
        $twitterGetResult = $this->twitterOrXPost($this->userId, $this->socialMediaItem, $this->socialPostManagerId, $this->socialTemplateId, $this->postDateTime);
    }

    public function twitterOrXPost($userId, $socialMediaItem , $socialPostManagerId, $socialTemplate, $postDateTime){
        //$userId = $this->userId();
        $twitterdata = configTwitterData::where('uid', '=', $userId)->first();
        $tweetTemplateID = $socialTemplate;
    
        $tweetData = socialTemplate::where('id', '=', $tweetTemplateID)->first();
        
        $access_token        = $twitterdata->twitter_oauth_token;
        $access_token_secret = $twitterdata->twitter_oauth_token_secrete;
        $CONSUMER_KEY        = $twitterdata->CONSUMER_KEY;
        $CONSUMER_SECRET     = $twitterdata->CONSUMER_SECRET;
    
        // Create Twitter connection
        $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token, $access_token_secret);

        $images    = $tweetData->postImage;
        $tweetText = $tweetData->postMessageShort;
       // dd($connection);
        if ($images == 'imageNotSet') {
            $connection->setTimeouts(10, 15);
            $connection->setApiVersion('2');
            // Post text-only tweet
            $post = $connection->post("tweets", ["text" => $tweetText]);
            //dd($post);
            //Log::channel('social')->error('Post Id : '. $post->data->id);
            //var_dump($post );
            
            if (!empty($post->data->id) || !empty($post->data->edit_history_tweet_ids)) {
                $response = response()->json([
                    'success' => true,
                    'message' => "Tweet posted successfully",
                    'status'    => "200",
                ]);
            } elseif (!empty($post->detail) && !empty($post->status)) {
                $response = response()->json([
                    'success' => false,
                    'message' => "Error: " . $post->detail,
                    'status'    => $post->status,
                ]);
            } else {
                $id = $post->data->id ?? 'N/A';
                $history = $post->data->edit_history_tweet_ids ?? 'N/A';
                $response = response()->json([
                    'success' => false,
                    'message' => "Others Problem: ID " . $id . ' Sts: ' . $history,
                    'status'    => "500",
                ]);
            }

           // Log::channel('social')->info($post);
        } else {
            $file = public_path($images);
            $connection->setApiVersion(1.1);
            $connection->setTimeouts(10, 15);
            // Upload image
            $media = $connection->upload('media/upload', ['media' => $file]);
            $connection->setApiVersion(2);
            //dd($media);  // Inspect response here
    
            if (isset($media->media_id_string)) {  // Use media_id_string
                $parameters = [
                    'text'    => $tweetText,  // Note: 'status' is used in v1.1 for tweeting
                    //'media' => $media->media_id_string
                    'media' => ['media_ids' => [$media->media_id_string]]
                ];
    
                // Post tweet with image
                $post = $connection->post("tweets", $parameters, ['jsonPayload' => true]);

                //Log::channel('social')->error('Post Id : '. $post->data->id);

                

                if (!empty($post->data->id) || !empty($post->data->edit_history_tweet_ids)) {
                    $response = response()->json([
                        'success' => true,
                        'message' => "Tweet posted successfully",
                        'status'    => "200",
                    ]);
                } elseif (!empty($post->detail) && !empty($post->status)) {
                    $response = response()->json([
                        'success' => false,
                        'message' => "Error: " . $post->detail,
                        'status'    => $post->status,
                    ]);
                } else {
                    $id = $post->data->id ?? 'N/A';
                    $history = $post->data->edit_history_tweet_ids ?? 'N/A';
                    $response = response()->json([
                        'success' => false,
                        'message' => "Others Problem: ID " . $id . ' Sts: ' . $history,
                        'status'    => "500",
                    ]);
                }


                //Log::channel('social')->info($post);
            } else {
                // Handle media upload failure
                //dd('Media upload failed', $media);
                //Log::channel('social')->error('Post Not Send');
                $response = response()->json([
                    'success' => false,
                    'message' => "Tweet Media Upload Failed",
                    'status'    => "500",
                ]);
            }
        }

        try {
            socialPostReport::create( array(
                'uid'       => $userId,
                'stId'       => $tweetTemplateID,
                'spmId'       => $socialPostManagerId,
                'postDateTime'       => $postDateTime,
                'socialMedia'       => $socialMediaItem,
                'postMessage'       => $response ,
                'totalTryingNumber'       => 1,
            ) );

                            // Start
            // Notification Send Start Here
            preg_match('/{([^{}]*)}$/', $response, $parts);
            // Output the content
            $jsonContent = null;
            $notificationBody  =   'Twitter Profile Post Something Error Message';
            if (!empty($parts[1])) {
                $jsonContent = $parts[0]; // This will give the second bracket's content including braces
            }

            if ($jsonContent) {
                $data = json_decode($jsonContent, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $notificationBody  =   $data['message'];
                } 
            }

            $notificationTitle = "Twitter Profile Notification Status";
            if($images == 'imageNotSet'){
                $notificationImage = public_path('notification/x.webp');
                //$notificationImage = 'http://127.0.0.1:8000/assets/media/logos/default-small.svg';
            }else{
                $notificationImage = public_path($images);
            }
            $notificationLink = route('user.socialPostManageView');
           // $notificationLink = 'https://www.banglacyber.com/saudi-riyal-to-taka/';            
            $this->pushNotificationSend($notificationTitle, $notificationBody, $notificationImage, $notificationLink, $userId);
            // End
            // Notification Send End Here
            
        } catch (\Throwable $th) {
            Log::channel('social')->error('Data Not Insert');
        }



    }
}