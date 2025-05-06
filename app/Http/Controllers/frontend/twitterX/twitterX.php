<?php

namespace App\Http\Controllers\frontend\twitterX;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\configTwitterData;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class twitterX extends Controller
{
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }
    // Twitter X  Configaration View
    public function twitterConfigView(){
        return view('frontend.config.twitter');
    }

    public function twitterLogin(Request $request){
       // return response()->json(  ['errors' => 'Sorry, twitter.'] );
        //@var Callback URL $callback
        $validator = Validator::make($request->all(), [
            'CONSUMER_KEY' => 'required',
            'CONSUMER_SECRET' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {

                $callback = route('user.twitterCallBack');
                // Consumer Key and Secret
                $CONSUMER_KEY = $request->CONSUMER_KEY ;
                $CONSUMER_SECRET = $request->CONSUMER_SECRET;
            //dd($CONSUMER_KEY);
                try {
                    $twitter_connect = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
                    //get Access Token
                    $_access_token = $twitter_connect->oauth('oauth/request_token',['oauth_callback'=>$callback]);
                   // var_dump($_access_token['errors']);
                    // Save the temporary token and secret to the session
                    Session::put('CONSUMER_KEY', $CONSUMER_KEY);
                    Session::put('CONSUMER_SECRET', $CONSUMER_SECRET);
                    //ganerate a new url for client $_route
                    $_route = $twitter_connect->url('oauth/authorize',['oauth_token'=>$_access_token['oauth_token']]);
                    //return redirect($_route);
                    return response()->json(  ['success' => $_route ] );
                } catch (Exception $e) {
                    return response()->json(  ['errors' => 'Please Check Your CONSUMER_KEY And SECRET'] );
                }
                
                //CONSUMER_KEY And CONSUMER_SECRET is Define

                

        }
    }

    public function twitterCallBack(Request $request){
        $response = $request->all();
    	$oauth_token = $response['oauth_token'];
    	$oauth_verifier = $response['oauth_verifier'];
        $CONSUMER_KEY = Session::get('CONSUMER_KEY');
        $CONSUMER_SECRET = Session::get('CONSUMER_SECRET');
    	//establishign twitter connection $twitter_connect
    	$twitter_connect = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $oauth_token, $oauth_verifier);
        $twitter_connect->setTimeouts(10, 15);

    	//Verify User Token
    	$token = $twitter_connect->oauth('oauth/access_token',['oauth_verifier'=>$oauth_verifier]);
    	
    	$access_token = $token['oauth_token']; //access token
    	$access_token_secret = $token['oauth_token_secret']; //access token secret
    	$twitter_user_id = $token['user_id']; //Twitter UserID
    	$twitter_screen_name = $token['screen_name']; //Twitter UserID

        $getResult = $this->insertOrUpdateConfigData($CONSUMER_KEY,  $CONSUMER_SECRET, $access_token, $access_token_secret, $twitter_user_id, $twitter_screen_name);
        if ($getResult == true) {
            session()->flash('success', 'Twitter Configuration Setup Successfully');
            return redirect()->route('user.twitterConfigView');
        }else {
            session()->flash('fail', 'Something Wrong, Please Try Again');
            return redirect()->route('user.twitterConfigView');
        }
        
        Session::pull('CONSUMER_KEY');
        Session::pull('CONSUMER_SECRET');
    }

    public function insertOrUpdateConfigData($CONSUMER_KEY, $CONSUMER_SECRET, $access_token, $access_token_secret, $twitter_user_id, $twitter_screen_name ){
        $userId = $this->userId();
        $emailTemplate = configTwitterData::where( 'uid', $userId )->first();
        if (empty($emailTemplate)) {
            try {
                configTwitterData::create( array(
                    'uid'       => $userId,
                    'twitter_user_id'       => $twitter_user_id,
                    'CONSUMER_KEY'       => $CONSUMER_KEY,
                    'CONSUMER_SECRET'       => $CONSUMER_SECRET,
                    'twitter_screen_name'       => $twitter_screen_name,
                    'twitter_oauth_token'       => $access_token,
                    'twitter_oauth_token_secrete'       => $access_token_secret,

                ) );
                return true;
            } catch ( Exception $e ) {
                return false;
                
            }
        }else{
            try {
                DB::table('config_twitter_data')
                ->where('uid', $userId)
                ->update([
                    'twitter_user_id'     => $twitter_user_id,
                    'CONSUMER_KEY'       => $CONSUMER_KEY,
                    'CONSUMER_SECRET'       => $CONSUMER_SECRET,
                    'twitter_screen_name'     =>  $twitter_screen_name,
                    'twitter_oauth_token'     => $access_token,
                    'twitter_oauth_token_secrete'     => $access_token_secret,
                ]);
                return true;
            } catch ( Exception $e ) {
                return false;
            }
        }
    }
}