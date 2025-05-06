<?php

namespace App\Http\Controllers\frontend\config;

use App\Http\Controllers\Controller;
use App\Models\pushnotification as ModelsPushnotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Exception;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Http;



class pushNotification extends Controller
{
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }

    // Store User Device Access Token
    public function deviceTokenStore(Request $request){
        $userID = $this->userID();
        if (!empty($request->token)) {
            $checkAlreadyInsert =  ModelsPushnotification::where( 'uid', '=', $userID)
                                    ->where( 'device_token', '=', $request->token)
                                    ->first();
            if (empty($checkAlreadyInsert)) {        
                try {
                    $dataInsert = new ModelsPushnotification();
                    $dataInsert->uid         = $userID;
                    $dataInsert->device_token    = $request->token;
                    $insertData                  = $dataInsert->save();
                    if ( $insertData ) {
                        return response()->json(['msg' => ['message' => 'success', 'completed' => 'Notification Setup successfully.']]);
                    }
                } catch ( Exception $e ) {
                    return response()->json(['msg' => ['message' => 'fail', 'error' => 'Sorry, looks like there are some errors detected, please try again.']]);
                }
            }else{
                return response()->json(['msg' => ['message' => 'fail', 'error' => 'Notification already set up on your device.']]);
            }
        }else{
            return response()->json(['msg' => ['message' => 'fail', 'error' => 'Device token not generated']]);
        }
    }

    // Send Push Notification

    public function pushNotificationSend(){
        $bearerAccessToken = $this->generateFirebaseAccessToken();
        $projectId = 'goly-final-project';
        $firebaseApiUrl = 'https://fcm.googleapis.com/v1/projects/'.$projectId .'/messages:send';

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $bearerAccessToken['access_token'],
            'Content-Type' => 'application/json',
        ])->post($firebaseApiUrl, [
            'message' => [
                // 'token' => 'cWpJXY3VYbnmMtUBPev2DP:APA91bH8Zti-vc0JBt_milU5GhadzGoYRIsjsRicg80B0w0w3U38um0o9EFGm6zQficfRTnBvELZojVUCoA8II2d2aef0USwnxDoABWk4GRcuk68phMXJWo',
                'token' => 'dyuDn02IvNAKEF0RMnXQ3h:APA91bFEKt6DJn0eEA1riL86tCBHugT1SJ0sH7o6lkmORtcMJiVrDvE86ot0f8iD3w4JX0_LN7JYieT4SMX79neAZ_Gu2BLMUpIWrq8qHiKzEJW847mMa_8',
                'notification' => [
                    'title' => 'Link And Image Last',
                    'body' => 'This Lorm Last', 
                    'image' => 'https://img.freepik.com/free-vector/gradient-logo-with-abstract-shape_23-2148217448.jpg', // Add image URL
                ],
                'webpush' => [  // For web browsers
                    'fcmOptions' => [
                        'link' => 'https://www.banglacyber.com/saudi-riyal-to-taka/',  // Link to open when clicked
                    ],
                ],
            ],
        ]);

        if ($response->successful()) {
            echo "Notification sent successfully!";
        } else {
            echo "Failed to send notification: " . $response->body();
        }
       // dd($bearerAccessToken);
    }

    //Generate Firebase Access Token (Bearer Access Token)
    function generateFirebaseAccessToken() {
        $keyFilePath = public_path('firebase/firebase-service-account.json');// Adjust path if needed
    
        // Define the required scopes for Firebase Cloud Messaging
        $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
    
        // Create Service Account Credentials
        $credentials = new ServiceAccountCredentials($scopes, $keyFilePath);
    
        // Get the Access Token
        if ($credentials->fetchAuthToken()) {
            return $credentials->getLastReceivedToken();
        } else {
            throw new Exception('Failed to fetch access token.');
        }
    }

    
}