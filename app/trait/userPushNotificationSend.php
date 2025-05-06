<?php

namespace App\trait;

use App\Models\pushnotification;
use Exception;
use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\Facades\Http;

trait userPushNotificationSend
{
        // Send Push Notification
        public function pushNotificationSend($title, $body, $image, $link, $userId){
            $bearerAccessToken = $this->generateFirebaseAccessToken();

            $projectId = 'goly-final-project';
            $firebaseApiUrl = 'https://fcm.googleapis.com/v1/projects/'.$projectId .'/messages:send';

            $userDevicetoken = pushnotification::where('uid', $userId)->get();
            foreach ($userDevicetoken as $deviceToken) {
                $userToken = $deviceToken->device_token;
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $bearerAccessToken['access_token'],
                    'Content-Type' => 'application/json',
                ])->post($firebaseApiUrl, [
                    'message' => [
                        // 'token' => 'cWpJXY3VYbnmMtUBPev2DP:APA91bH8Zti-vc0JBt_milU5GhadzGoYRIsjsRicg80B0w0w3U38um0o9EFGm6zQficfRTnBvELZojVUCoA8II2d2aef0USwnxDoABWk4GRcuk68phMXJWo',
                        'token' => $userToken,
                        'notification' => [
                            'title' => $title,
                            'body' => $body, 
                            'image' => $image, // Add image URL
                        ],
                        'webpush' => [  // For web browsers
                            'fcmOptions' => [
                                'link' => $link,  // Link to open when clicked
                            ],
                        ],
                    ],
                ]);
            }

    

    
            // if ($response->successful()) {
            //    // echo "Notification sent successfully!";
            // } else {
            //    // echo "Failed to send notification: " . $response->body();
            // }
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
                //throw new Exception('Failed to fetch access token.');
            }
        }
}