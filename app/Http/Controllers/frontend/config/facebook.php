<?php

namespace App\Http\Controllers\frontend\config;

use App\Http\Controllers\Controller;
use App\Models\configFacebook;
use App\Models\configFacebookpage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\DB;

class facebook extends Controller
{
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }

    public function facebookConfigView(){
        return view('frontend.config.facebook');
    }

    public function facebookLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'appID' => 'required',
            'appSecret' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            $appID = $request->appID;
            $appSecret = $request->appSecret;
            $redirectUrl = route('user.facebookCallBack');
            $scope = 'email,public_profile,pages_show_list,pages_read_engagement,pages_manage_posts,pages_manage_engagement,pages_read_user_content,pages_manage_ads,user_photos';
            $facebookOAuthUrl = "https://www.facebook.com/v21.0/dialog/oauth?client_id={$appID}&redirect_uri={$redirectUrl}&scope={$scope}";
            
            Session::put('fbAppID', $appID);
            Session::put('fbAppSecret', $appSecret);
            //return redirect($facebookOAuthUrl);
            return response()->json(  ['success' => $facebookOAuthUrl ] );
            

        }
    }
    
    public function facebookCallBack(Request $request){
        $code = $request->input('code');
        $appID = Session::get('fbAppID');
        $appSecret = Session::get('fbAppSecret');
        $redirectUrl = route('user.facebookCallBack');
        
        if (!$code) {
            //return redirect('/')->with('error', '');
            session()->flash('fail', 'Failed to get authorization code from Facebook.');
            return redirect()->route('user.facebookConfigView');
        }

        // Exchange authorization code for access token
        $response = Http::asForm()->post('https://graph.facebook.com/v17.0/oauth/access_token', [
            'client_id' => $appID,
            'client_secret' => $appSecret,
            'redirect_uri' => $redirectUrl,
            'code' => $code,
        ]);

        if ($response->successful()) {
            $accessToken = $response->json()['access_token'];
            // Now you have the access token, you can save it, use it, etc.
           // return redirect('/')->with('success', 'Facebook login successful. Access Token: ' . $accessToken);
            //dd($response->body());
           session()->flash('success', 'Facebook login successful. Access Token: '.$accessToken);
           $getResult = $this->insertOrUpdateConfigData($appID,  $appSecret, $accessToken);
           if ($getResult == true) {
                session()->flash('success', 'Facebook Configuration Setup Successfully');
                return redirect()->route('user.facebookConfigView');
            }else {
                session()->flash('fail', 'Something Wrong, Please Try Again');
                return redirect()->route('user.facebookConfigView');
            }
           //return redirect()->route('user.facebookConfigView');
        }
        Session::pull('fbAppID');
        Session::pull('fbAppSecret');
        //return redirect('/')->with('error', '');
        // dd($response->body());
        session()->flash('fail', 'Failed to obtain access token from Facebook.');
        return redirect()->route('user.facebookConfigView');
         //dd($appID.' // '.$appSecret.' // '.$code.' // '.$redirectUrl);
        //dd($response->body());
    }

    public function insertOrUpdateConfigData($appID, $appSecret, $accessToken ){
        $userId = $this->userId();
        // Start Get Facebook Name
        $url = "https://graph.facebook.com/v17.0/me?access_token={$accessToken}";

        // Fetch data from Facebook API
        $response = Http::get($url);
        
        $facebookId = null ;
        $facebookName = null;

        if ($response->successful()) {
            $data = $response->json();

            // Extract ID and Name
            $facebookId = $data['id'] ;
            $facebookName = $data['name'];
            
        }
       // dd($facebookId );
        //End get facebook name
        try {
            configFacebook::updateOrCreate(
                ['fdId' => $facebookId],
                [
                    'uid' => $userId,
                    'appId' => $appID,
                    'appSecret' => $appSecret,
                    'facebook_access_token' => $accessToken,
                    'fbName' => $facebookName,

                ]
            );
           // $emailTemplate = configLinkedIn::where( 'uid', $userId )->first();
           // Start Old Facebook Page Delete
            $selectFbPages = configFacebookpage::where('facebookId', $facebookId)->get();
            if (!empty($selectFbPage)) {
                foreach($selectFbPages as $selectFbPage){
                    $delete = configFacebookpage::findOrFail( $selectFbPage->id );
                    $delete->delete();
                }
            }
             // End Old Facebook Page Delete
            // Start Get Facebook Page get
            $selectConfigFb = configFacebook::where('fdId', $facebookId)->first();

            try{
                $url = "https://graph.facebook.com/v17.0/me/accounts?access_token={$accessToken}";

                // Fetch data from Facebook API
                $response = Http::get($url);
        
                if ($response->successful()) {
                    $data = $response->json();
                    if (isset($data['data'])) {
                        foreach ($data['data'] as $page) {
                            // Insert or update page data in the database
                            configFacebookpage::updateOrCreate(
                                ['pageId' => $page['id']], // Unique identifier for the page
                                [
                                    'uid' => $userId,
                                    'ufbconfigid' => $selectConfigFb->id,
                                    'appId' => $appID,
                                    'facebookId' => $facebookId,
                                    'pageName' => $page['name'],
                                    'pageAccessToken' => $page['access_token'],
                                ]
                            );
                        }
                        return true;
                        //return response()->json(['message' => 'Pages data stored successfully.'], 200);
                    }
                }
        
                //return response()->json(['message' => 'Failed to fetch pages data.'], 400);
                return false;
            }catch ( Exception $e ) {
                return false;
            }
            // End Get Facebook Page get
        }catch ( Exception $e ) {
            return false;
        }

    }



}