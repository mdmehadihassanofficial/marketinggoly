<?php

namespace App\Http\Controllers\frontend\socialPostManager;


use App\Http\Controllers\Controller;
use App\Models\configTwitterData;
use App\Models\socialTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\configFacebook;
use App\Models\configFacebookpage;
use App\Models\configLinkedIn;
use App\Models\configLinkedinPage;
use App\Models\socialPostManager;
use App\Models\socialPostReport;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Http;

use Exception;

class socialPost extends Controller
{
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }

    public function socialPostView(){
        $userId = $this->userId();
        $socialTemplate = socialTemplate::where( 'uid', $userId )->where( 'status', 1 )->orderBy('id', 'DESC')->get();
        $configLinkedin = configLinkedIn::where('uid', $userId)->first();
        $configFbPages = configFacebookpage::where('uid', $userId)->get();
        $configLdPages = configLinkedinPage::where('uid', $userId)->get();
        $socialPostReport = socialPostReport::where('uid', $userId)->orderBy('id', 'DESC')->first();

        //dd($socialPostReport);
        return view('frontend.socialPost.postInstant')
        ->with(compact('socialTemplate'))
        ->with(compact('configFbPages'))
        ->with(compact('configLdPages'))
        ->with(compact('socialPostReport'));
    }

    public function autoSocialPostView(){
        $userId = $this->userId();
        $socialTemplate = socialTemplate::where( 'uid', $userId )->where( 'status', 1 )->orderBy('id', 'DESC')->get();
        $configLinkedin = configLinkedIn::where('uid', $userId)->first();
        $configFbPages = configFacebookpage::where('uid', $userId)->get();
        $configLdPages = configLinkedinPage::where('uid', $userId)->get();
        $socialPostReport = socialPostReport::where('uid', $userId)->orderBy('id', 'DESC')->first();

        //dd($socialPostReport);
        return view('frontend.socialPost.autoPostSetup')
        ->with(compact('socialTemplate'))
        ->with(compact('configFbPages'))
        ->with(compact('configLdPages'))
        ->with(compact('socialPostReport'));
    }





    public function socialPostSend(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'socialMedia' => 'required',
            'socialTemplate' => 'required',
            'postRepeat' => 'nullable|string',
            'postRepeatType' => 'required_with:postRepeat',
            'postStartDate' => 'required_with:postRepeat',
        ]);
        
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            $title = $request->title;
            $socialMedia = $request->socialMedia;
            
            
            $socialTemplateIds = $request->socialTemplate;
            $JSONSocialMedia = json_encode($socialMedia);
            $JSONSocialTemplate = json_encode($socialTemplateIds);



            if (!empty($request->postRepeat)) {
                            //Start Formate Post End Date
                        if(!empty($request->postEndDate)){
                            $postEndDate = $request->postEndDate;
                            $postEndDate = DateTime::createFromFormat('d, M Y, H:i', $postEndDate);
                            if($postEndDate){
                                $postEndDate = $postEndDate->format('Y-m-d H:i:s'); 
                            }else{
                                $postEndDate = null;
                            }
                        }else{
                            $postEndDate = null;
                        }
                        //End Formate Post End Date

                        

                        //Start Formate Post Start Date
                        if(!empty($request->postStartDate)){
                            $postStartDateString = $request->postStartDate;
                            //$postStartDate = DateTime::createFromFormat('Y-m-d H:i:s', $postStartDate);
                            $postStartDate = DateTime::createFromFormat('d, M Y, H:i', $postStartDateString);

                            if ($postStartDate) {
                                $postStartDate = $postStartDate->format('Y-m-d H:i:s');  // Outputs: 2025-01-10 12:00:00
                            } else {
                                $postStartDate = null;
                            }

                        }else{
                            $postStartDate = null;
                        }
                        //End Formate Post Start Date

                        //  Start Next Post Date TIme set
                        $postRepeatType = $request->postRepeatType;

                        if($postRepeatType == "daily"){
                            $plusRepeat = 1;
                        }elseif($postRepeatType == "weekly"){
                            $plusRepeat = 7;
                        }elseif($postRepeatType == "monthly"){
                            $plusRepeat = 30;
                        }else{
                            $plusRepeat = 0;
                        }
                        if($postStartDateString){
                            $dateTime = Carbon::createFromFormat('d, M Y, H:i', $postStartDateString);
                            if($plusRepeat == 30){
                                $dateTime->addMonth(); 
                            }else{
                                $dateTime->addDays($plusRepeat);  // Adds 7 days to the current date
                            }
                            $nextPostDateTime =  $dateTime->toDateTimeString();  // Outputs: 2025-01-17 12:00:00
                        }else{
                            $nextPostDateTime = null;
                        }
                        //  End Next Post Date TIme set

                       // dd($postEndDate );
                try {
                    socialPostManager::create( array(
                        'uid'                => $userId,
                        'socialTemplateId'   => $JSONSocialTemplate,
                        'title'                         => $title,
                        'socialMedia'       => $JSONSocialMedia,
                        'postDateTime'       => $postStartDate,
                        'nextPostDateTime'       => $nextPostDateTime,
                        'endPostDateTime'       => $postEndDate,
                        'postRepeatType'       => $postRepeatType,
                        'postRepeatStatus'       => 1,
                        'postStatus'    => 0,
                    ) );
                    return response()->json( [ 'success' => 'Your Social Post Added Successfully' ] );
                } catch ( Exception $e ) {
                    //return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
                    return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again Repeat. '.$e] );
                }
            }else{
                try {
                    socialPostManager::create( array(
                        'uid'                => $userId,
                        'socialTemplateId'   => $JSONSocialTemplate,
                        'title'                         => $title,
                        'socialMedia'       => $JSONSocialMedia,
                        'postDateTime'       => now(),
                        'postStatus'    => 1,
                    ) );
                    return response()->json( [ 'success' => 'Your Social Post Under Processing Added Successfully' ] );
                } catch ( Exception $e ) {
                    //return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
                    return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'] );
                }
            }




            //Start Local Work
            // foreach($request->socialMedia as $socialMedia){
            //     $getPages = substr($socialMedia, 0, 6);
            //     //dd($getPages);
            //     if ($socialMedia == 'Twitter') {
                   
            //         $twitterGetResult = $this->twitterOrXPost($title, $socialMedia , $socialTemplateId);
                
            //        // return redirect()->back();
            //     }elseif($socialMedia == 'Linkedin'){
            //         $linkedInGetResult = $this->linkedInPost($title, $socialMedia , $socialTemplateId);
            //     }elseif($getPages == 'fbPage'){
            //         $facebookGetResult = $this->postToPage($title, $socialMedia , $socialTemplateId);
            //     }elseif($getPages == 'ldPage'){
            //         $facebookGetResult = $this->linkedInpostToPage($title, $socialMedia , $socialTemplateId);
            //     }
                
            // }
              //End Local Work
        }
    }

    
    public function socialPostManageUp(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'titleUpdate' => 'required',
            'socialMediaUpdate' => 'required',
            'socialTemplateUpdate' => 'required',
            'postRepeatUpdate' => 'nullable|string',
            'postRepeatTypeUpdate' => 'required_with:postRepeat',
            'postStartDateUpdate' => 'required_with:postRepeat',
        ]);
        
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            $title = $request->titleUpdate;
            $socialMedia = $request->socialMediaUpdate;
            
            
            $socialTemplateIds = $request->socialTemplateUpdate;
            $JSONSocialMedia = json_encode($socialMedia);
            $JSONSocialTemplate = json_encode($socialTemplateIds);



            if (!empty($request->postRepeatUpdate)) {
                            //Start Formate Post End Date
                        if(!empty($request->postEndDateUpdate)){
                            $postEndDate = $request->postEndDateUpdate;
                            $postEndDate = DateTime::createFromFormat('d, M Y, H:i', $postEndDate);
                            if($postEndDate){
                                $postEndDate = $postEndDate->format('Y-m-d H:i:s'); 
                            }else{
                                $postEndDate = null;
                            }
                        }else{
                            $postEndDate = null;
                        }
                        //End Formate Post End Date

                        

                        //Start Formate Post Start Date
                        if(!empty($request->postStartDateUpdate)){
                            $postStartDateString = $request->postStartDateUpdate;
                            //$postStartDate = DateTime::createFromFormat('Y-m-d H:i:s', $postStartDate);
                            $postStartDate = DateTime::createFromFormat('d, M Y, H:i', $postStartDateString);

                            if ($postStartDate) {
                                $postStartDate = $postStartDate->format('Y-m-d H:i:s');  // Outputs: 2025-01-10 12:00:00
                            } else {
                                $postStartDate = null;
                            }

                        }else{
                            $postStartDate = null;
                        }
                        //End Formate Post Start Date

                        //  Start Next Post Date TIme set
                        $postRepeatType = $request->postRepeatTypeUpdate;

                        if($postRepeatType == "daily"){
                            $plusRepeat = 1;
                        }elseif($postRepeatType == "weekly"){
                            $plusRepeat = 7;
                        }elseif($postRepeatType == "monthly"){
                            $plusRepeat = 30;
                        }else{
                            $plusRepeat = 0;
                        }
                        if($postStartDateString){
                            $dateTime = Carbon::createFromFormat('d, M Y, H:i', $postStartDateString);
                            if($plusRepeat == 30){
                                $dateTime->addMonth(); 
                            }else{
                                $dateTime->addDays($plusRepeat);  // Adds 7 days to the current date
                            }
                            $nextPostDateTime =  $dateTime->toDateTimeString();  // Outputs: 2025-01-17 12:00:00
                        }else{
                            $nextPostDateTime = null;
                        }
                        //  End Next Post Date TIme set

                       // dd($postEndDate );
                try {

                    $data = socialPostManager::find($id);
                    $data->uid = $userId;
                    $data->socialTemplateId = $JSONSocialTemplate;
                    $data->title = $title;
                    $data->socialMedia = $JSONSocialMedia;
                    $data->postDateTime = $postStartDate;
                    $data->nextPostDateTime = $nextPostDateTime;
                    $data->endPostDateTime = $postEndDate;
                    $data->postRepeatType = $postRepeatType;
                    $data->postRepeatStatus = 1;
                    $data->postStatus = 0;
                    //$data->postDateTime = $request->title;
                    //$data->postStatus = $request->title;
                    $data->save();
                    return response()->json( [ 'success' => 'Your Social Post  Updated Successfully' ] );




                    // socialPostManager::create( array(
                    //     'uid'                => $userId,
                    //     'socialTemplateId'   => $JSONSocialTemplate,
                    //     'title'                         => $title,
                    //     'socialMedia'       => $JSONSocialMedia,
                    //     'postDateTime'       => $postStartDate,
                    //     'nextPostDateTime'       => $nextPostDateTime,
                    //     'endPostDateTime'       => $postEndDate,
                    //     'postRepeatType'       => $postRepeatType,
                    //     'postRepeatStatus'       => 1,
                    //     'postStatus'    => 0,
                    // ) );
                    // return response()->json( [ 'success' => 'Your Social Post  Added Successfully' ] );
                } catch ( Exception $e ) {
                    //return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
                    return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again Repeat. '.$e] );
                }
            }else{
                try {
                    $data = socialPostManager::find($id);
                    $data->uid = $userId;
                    $data->socialTemplateId = $JSONSocialTemplate;
                    $data->title = $title;
                    $data->socialMedia = $JSONSocialMedia;
                    $data->postDateTime = now();
                    $data->nextPostDateTime = null;
                    $data->endPostDateTime = null;
                    $data->postRepeatType = null;
                    $data->postRepeatStatus = 0;
                    $data->postStatus = 1;
                    //$data->postStatus = $request->title;
                    $data->save();
                    return response()->json( [ 'success' => 'Your Social Post Under Processing Updated Successfully' ] );


                    // socialPostManager::create( array(
                    //     'uid'                => $userId,
                    //     'socialTemplateId'   => $JSONSocialTemplate,
                    //     'title'                         => $title,
                    //     'socialMedia'       => $JSONSocialMedia,
                    //     'postDateTime'       => now(),
                    //     'postStatus'    => 1,
                    // ) );
                    // return response()->json( [ 'success' => 'Your Social Post Under Processing Added Successfully' ] );
                } catch ( Exception $e ) {
                    //return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
                    return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'] );
                }
            }




            //Start Local Work
            // foreach($request->socialMedia as $socialMedia){
            //     $getPages = substr($socialMedia, 0, 6);
            //     //dd($getPages);
            //     if ($socialMedia == 'Twitter') {
                   
            //         $twitterGetResult = $this->twitterOrXPost($title, $socialMedia , $socialTemplateId);
                
            //        // return redirect()->back();
            //     }elseif($socialMedia == 'Linkedin'){
            //         $linkedInGetResult = $this->linkedInPost($title, $socialMedia , $socialTemplateId);
            //     }elseif($getPages == 'fbPage'){
            //         $facebookGetResult = $this->postToPage($title, $socialMedia , $socialTemplateId);
            //     }elseif($getPages == 'ldPage'){
            //         $facebookGetResult = $this->linkedInpostToPage($title, $socialMedia , $socialTemplateId);
            //     }
                
            // }
              //End Local Work
        }
    }





    public function twitterOrXPost($title, $socialMedia , $socialTemplate){
        $userId = $this->userId();
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
        $tweetText = $tweetData->postMessage;
       // dd($connection);
        if ($images == 'imageNotSet') {
            $connection->setTimeouts(10, 15);
            $connection->setApiVersion('2');
            // Post text-only tweet
            $post = $connection->post("tweets", ["text" => $tweetText]);
            dd($post );
            if (!empty($post->data->id) AND !empty($post->data->edit_history_tweet_ids)) {
                // try {
                //     socialPostReport::create( array(
                //         'uid'       => $userId,
                //         'spmId'       => $userId,

                //     ) );
                //    // return response()->json( [ 'success' => 'Your Campaign Added Successfully' ] );
                // } catch (\Throwable $th) {
                //     //throw $th;
                // }
                var_dump('Success');
            }elseif(!empty($post->detail) AND !empty($post->status)){
                var_dump('Error'. $post->detail);
            }else{
                var_dump('others');
            }

            // $detail = $post->detail;
            // $status = $post->status;
            // dd($detail);
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
                if (!empty($post->data->id) AND !empty($post->data->edit_history_tweet_ids)) {
                    var_dump('Success');
                }elseif(!empty($post->detail) AND !empty($post->status)){
                    var_dump('Error'. $post->detail);
                }else{
                    //var_dump('others');

                    var_dump($post);
                }
            } else {
                // Handle media upload failure
                //dd('Media upload failed', $media);
            }
        }
    }

    public function linkedInPost($title, $socialMedia , $socialTemplate){
        $userId = $this->userId();
        $linkedInData = configLinkedIn::where('uid', '=', $userId)->first();
        $accessToken =  $linkedInData->linkedin_access_token;
        $response = Http::withToken($accessToken)->get('https://api.linkedin.com/v2/me');
        //var_dump($accessToken);
        //die;
        //dd($response );
        $linkedin_id = $response->json()['id']; // This is your LinkedIn ID
        
        //dd($response );
       $TemplateID = $socialTemplate;
       $linkedInPostData = socialTemplate::where('id', '=', $TemplateID)->first();


       $author = 'urn:li:person:'.$linkedin_id; // Use your LinkedIn Person ID
       $message = $linkedInPostData->postMessage;
       $messageImage = $linkedInPostData->postImage;
        if($messageImage == 'imageNotSet'){
                   // Make the API call to post to LinkedIn
                $textPostResponse = Http::withToken($accessToken)
                ->post('https://api.linkedin.com/v2/ugcPosts', [
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
                    dd('Text Post Send Successfully Id: ' .$textPostResult['id']);
                }else{
                    dd('Text Post Not  Send Message: ' .$textPostResult['message'].' Status Code: '. $textPostResult['status']);
                }

           // dd('Only Text') ; // Output the response
        }else{
            $image_path = public_path($messageImage); // Local image path
           $linkedInImagePostResult =  $this->postToLinkedInWithImage($accessToken, $image_path, $message, $linkedin_id );
           dd('Our Message');
        //    if ($linkedInImagePostResult == true) {
        //      dd('seccess');
        //    }elseif($linkedInImagePostResult == false){
        //     dd('error');
        //    }else{
        //     dd('others');
        //    }
        }

    }

    public function postToLinkedInWithImage($access_token, $image_path, $message, $linkedin_id )
    {
                                // Step 1: Register the image upload
                                $registerUploadResponse = Http::withToken($access_token)
                                    ->post('https://api.linkedin.com/v2/assets?action=registerUpload', [
                                        'registerUploadRequest' => [
                                            'owner' => 'urn:li:person:'.$linkedin_id, // Your LinkedIn ID
                                            'recipes' => ['urn:li:digitalmediaRecipe:feedshare-image'], // Media type
                                            'serviceRelationships' => [
                                                [
                                                    'identifier' => 'urn:li:userGeneratedContent',
                                                    'relationshipType' => 'OWNER',
                                                ]
                                            ],
                                            'supportedUploadMechanism' => ['SYNCHRONOUS_UPLOAD']
                                        ]
                                    ]);

                                // Check if image registration failed
                                if ($registerUploadResponse->failed()) {
                                    dd($registerUploadResponse->json());
                                    return response()->json([
                                        'error' => 'Failed to register image upload',
                                        'details' => $registerUploadResponse->json()
                                    ], 500);

                                    
                                }

                                $uploadResponseData = $registerUploadResponse->json();
                                $uploadUrl = $uploadResponseData['value']['uploadMechanism']['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest']['uploadUrl'];
                                $asset = $uploadResponseData['value']['asset'];

                                // Step 2: Upload the image to LinkedIn's server
                                $imageFile = fopen($image_path, 'r');
                                $imageData = fread($imageFile, filesize($image_path));
                                fclose($imageFile);

                                $uploadImageResponse = Http::withBody($imageData, mime_content_type($image_path))
                                    ->put($uploadUrl, [
                                        'headers' => [
                                            'Content-Type' => mime_content_type($image_path),
                                        ]
                                    ]);

                                // Check if image upload failed
                                if ($uploadImageResponse->failed()) {
                                    dd( $uploadImageResponse->json());
                                    return response()->json([
                                        'error' => 'Failed to upload image to LinkedIn',
                                        'details' => $uploadImageResponse->json()
                                    ], 500);
                                }

                                // Step 3: Create a post referencing the uploaded image
                                $imagePostResponse = Http::withToken($access_token)
                                    ->post('https://api.linkedin.com/v2/ugcPosts', [
                                        'author' => 'urn:li:person:'.$linkedin_id, // Your LinkedIn ID
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
                                                        ]
                                                    ]
                                                ],
                                            ]
                                        ],
                                        'visibility' => [
                                            'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
                                        ]
                                    ]);

                                    //dd($imagePostResponse->json()) ; 
                                    $imagePostResult = $imagePostResponse->json();

                                    if(!empty($imagePostResult['id'])){
                                        dd('Text Post Send Successfully Id: ' .$imagePostResult['id']);
                                    }else{
                                        dd('Text Post Not  Send Message: ' .$imagePostResult['message'].' Status Code: '. $imagePostResult['status']);
                                    }

                                // // Check if post creation failed
                                // if ($imagePostResponse->failed()) {
                                //      //dd($imagePostResponse->json());
                                //      dd('Failed');
                                //     // return response()->json([
                                //     //     'error' => 'Failed to create post',
                                //     //     'details' => $postResponse->json()
                                //     // ], 500);
                                // }

                                // Success response
                               // dd('get success');
                                return response()->json([
                                    'message' => 'Post created successfully',
                                    'post_details' => $imagePostResponse->json()
                                ], 200);
    }

    //Start  LinkedIn Page Post
    public function linkedInpostToPage($title, $socialMedia , $socialTemplate){
        $userId = $this->userId();
        $linkedInData = configLinkedIn::where('uid', '=', $userId)->first();
        //dd($linkedInData);
        $accessToken =  $linkedInData->linkedin_access_token;
        
       
       $linkedInPostData = socialTemplate::where('id', '=',  $socialTemplate)->first();
       $message = $linkedInPostData->postMessage;
       $messageImage = $linkedInPostData->postImage;

       $parts = explode('-',  $socialMedia);
       $getPageURN = end($parts);

       $linkedInPageData = configLinkedinPage::where('pageURN', '=',  $getPageURN)->first();
       


       $author = $linkedInPageData->pageURN; // Use your LinkedIn Person ID

        if($messageImage == 'imageNotSet'){
                   // Make the API call to post to LinkedIn
                $response = Http::withToken($accessToken)
                ->post('https://api.linkedin.com/v2/ugcPosts', [
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

            //dd($response->json()) ; // Output the response
        }else{
            $image_path = public_path($messageImage); // Local image path
           $linkedInPageImagePostResult =  $this->postToLinkedInPageWithImage($accessToken, $image_path, $message, $author );
           if ($linkedInPageImagePostResult == true) {
             dd('seccess');
           }elseif($linkedInPageImagePostResult == false){
            dd('error');
           }else{
            dd('others');
           }
        }
    }
    //End LinkedIn Page Post

    //Start LinkedIn Page Post With Image
    public function postToLinkedInPageWithImage($access_token, $image_path, $message, $author){
                                // Step 1: Register the image upload
                                $registerUploadResponse = Http::withToken($access_token)
                                    ->post('https://api.linkedin.com/v2/assets?action=registerUpload', [
                                        'registerUploadRequest' => [
                                            'owner' => $author, // Your LinkedIn ID
                                            'recipes' => ['urn:li:digitalmediaRecipe:feedshare-image'], // Media type
                                            'serviceRelationships' => [
                                                [
                                                    'identifier' => 'urn:li:userGeneratedContent',
                                                    'relationshipType' => 'OWNER',
                                                ]
                                            ],
                                            'supportedUploadMechanism' => ['SYNCHRONOUS_UPLOAD']
                                        ]
                                    ]);

                                // Check if image registration failed
                                if ($registerUploadResponse->failed()) {
                                    dd($registerUploadResponse->json());
                                    return response()->json([
                                        'error' => 'Failed to register image upload',
                                        'details' => $registerUploadResponse->json()
                                    ], 500);

                                    
                                }

                                $uploadResponseData = $registerUploadResponse->json();
                                $uploadUrl = $uploadResponseData['value']['uploadMechanism']['com.linkedin.digitalmedia.uploading.MediaUploadHttpRequest']['uploadUrl'];
                                $asset = $uploadResponseData['value']['asset'];

                                // Step 2: Upload the image to LinkedIn's server
                                $imageFile = fopen($image_path, 'r');
                                $imageData = fread($imageFile, filesize($image_path));
                                fclose($imageFile);

                                $uploadImageResponse = Http::withBody($imageData, mime_content_type($image_path))
                                    ->put($uploadUrl, [
                                        'headers' => [
                                            'Content-Type' => mime_content_type($image_path),
                                        ]
                                    ]);

                                // Check if image upload failed
                                if ($uploadImageResponse->failed()) {
                                    dd( $uploadImageResponse->json());
                                    return response()->json([
                                        'error' => 'Failed to upload image to LinkedIn',
                                        'details' => $uploadImageResponse->json()
                                    ], 500);
                                }

                                // Step 3: Create a post referencing the uploaded image
                                $postResponse = Http::withToken($access_token)
                                    ->post('https://api.linkedin.com/v2/ugcPosts', [
                                        'author' => $author, // Your LinkedIn ID
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
                                                        ]
                                                    ]
                                                ],
                                            ]
                                        ],
                                        'visibility' => [
                                            'com.linkedin.ugc.MemberNetworkVisibility' => 'PUBLIC',
                                        ]
                                    ]);

                                // Check if post creation failed
                                if ($postResponse->failed()) {
                                    dd($postResponse->json());
                                    return response()->json([
                                        'error' => 'Failed to create post',
                                        'details' => $postResponse->json()
                                    ], 500);
                                }

                                // Success response
                               // dd('get success');
                                return response()->json([
                                    'message' => 'Post created successfully',
                                    'post_details' => $postResponse->json()
                                ], 200);
    }
    //End LinkedIn Page Post With Image


    public function postToPage($title, $socialMedia , $socialTemplate)
    {

        $facebookPostData = socialTemplate::where('id', '=', $socialTemplate)->first();
        if ($facebookPostData) {
            $postImages    = $facebookPostData->postImage;
            $postMessage    = $facebookPostData->postMessage;

            // Split the string by the delimiter '-'
            $parts = explode('-',  $socialMedia);
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
                        // Check for errors
                        // if (isset($postData['error'])) {
                        //     return false;
                        //     //return response()->json(['error' => $postData['error']['message']], 400);
                        // }else{
                        //    // return true;
                        // }


                        if (!empty($postData['id']) OR !empty($postData['post_id']) ) {
                            $response = response()->json([
                                'success' => true,
                                'message' => "Facebook Page Posted Successfully. Id: ".$postData['post_id'],
                                'status'    => "200",
                            ]);
                            dd($response);
                        }elseif(!empty($postData['error'])){
                            $response = response()->json([
                                'success' => false,
                                'message' => "Facebook Page Not Image Posted ".$postData['error']['message'],
                                'status'    => $postData['error']['code'].' error_subcode '.$postData['error']['error_subcode'],
                            ]);
                            dd($response);
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
                    // Check for errors
                    // dd($imageData);
                    // if (isset($imageData['error'])) {
                    //    // return response()->json(['error' => $imageData['error']['message']], 400);
                    //    return false;
                    // }else{
                    //     return true;
                    // }
                    //dd($imageFile);

                    if (!empty($imageData['id']) OR !empty($imageData['post_id']) ) {
                        $response = response()->json([
                            'success' => true,
                            'message' => "Facebook Page Posted Successfully. Id: ".$imageData['post_id'],
                            'status'    => "200",
                        ]);
                        dd($response);
                    }elseif(!empty($imageData['error'])){
                        $response = response()->json([
                            'success' => false,
                            'message' => "Facebook Page Not Image Posted ".$imageData['error']['message'],
                            'status'    => $imageData['error']['code'].' error_subcode '.$imageData['error']['error_subcode'],
                        ]);
                        dd($response);
                    }
                }
            }
        }


        // die();

        // try {
        //     // Retrieve access token and API URL from env
        //     $pageAccessToken = env('FACEBOOK_ACCESS_TOKEN');
        //     $graphApiUrl = env('FACEBOOK_GRAPH_API_URL');
        //     $pageId = 'your_page_id'; // Replace with your Page ID
            
        //     // Upload the image to Facebook
        //     $imageResponse = Http::attach(
        //         'source',
        //         fopen($request->file('image')->getPathname(), 'r'),
        //         $request->file('image')->getClientOriginalName()
        //     )->post("{$graphApiUrl}/{$pageId}/photos", [
        //         'access_token' => $pageAccessToken,
        //         'caption' => $request->input('message'),
        //     ]);

        //     $imageData = $imageResponse->json();

        //     // Check for errors
        //     if (isset($imageData['error'])) {
        //         return response()->json(['error' => $imageData['error']['message']], 400);
        //     }

        //     return response()->json([
        //         'success' => true,
        //         'post_id' => $imageData['id'],
        //         'message' => 'Post created successfully!',
        //     ]);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'error' => $e->getMessage(),
        //     ], 500);
        // }
    }





    public function facebookPost($title, $socialMedia , $socialTemplate){
        $userId = $this->userId();
        $facebookdata = configFacebook::where('uid', '=', $userId)->first();
        $templateID = $socialTemplate;
    
        $templateData = socialTemplate::where('id', '=', $templateID)->first();
        
        $accessToken        = $facebookdata->facebook_access_token;
        $appSecret = $facebookdata->appSecret;
        $appId        = $facebookdata->appId;

        if ($templateData->postImage == "imageNotSet") {
              //dd('check');
                $message = $templateData->postMessage;

                try {
                    // Make an HTTP POST request to Facebook Graph API
                    $response = Http::post('https://graph.facebook.com/v21.0/me/feed', [
                        'message' => $message,
                        'access_token' => $accessToken,
                    ]);

                    if ($response->successful()) {
                        //return true;
                        dd('seccess');

                        //$data = $response->json();
                        
                        // return response()->json([
                        //     'success' => true,
                        //     'post_id' => $data['id'] ?? null,
                        // ]);
                    } else {
                        //return false;
                        dd($response->json()['error']['message']);
                        // return response()->json([
                        //     'success' => false,
                        //     'error' => $response->json()['error']['message'] ?? 'Unknown error',
                        // ], $response->status());
                    }
                } catch (\Exception $e) {
                    //return false;
                    dd('fail'.$e);
                    // return response()->json([
                    //     'success' => false,
                    //     'error' => $e->getMessage(),
                    // ], 500);
                }
        }else{
            dd('Not check');
        }
    }
}