<?php

namespace App\Http\Controllers\frontend\config;

use App\Http\Controllers\Controller;
use App\Models\configLinkedIn;
use App\Models\configLinkedinPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
//use League\OAuth2\Client\Provider\LinkedIn as LinkedInPackage;
///use GuzzleHttp\Client;

class linkedin extends Controller
{
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }
    
    public function linkedinConfigView(){
        return view('frontend.config.linkedin');
    }

    public function linkedinLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'clientID' => 'required',
            'clientSecret' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            $clientID = $request->clientID;
            $clientSecret = $request->clientSecret;
            $callbackRoute = route('user.linkedInCallBack');
            $scope = 'r_liteprofile r_emailaddress w_member_social w_organization_social rw_organization_admin'; // Permissions needed
            $state = 'random_string_to_protect_from_csrf'; // CSRF protection
    
            $authUrl = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=$clientID&redirect_uri=$callbackRoute&scope=$scope&state=$state";

            // $authUrl = 'https://www.linkedin.com/oauth/v2/authorization?' . http_build_query([
            //     'response_type' => 'code',
            //     'client_id' => $clientID,
            //     'redirect_uri' => $callbackRoute,
            //     'scope' => 'r_liteprofile r_emailaddress w_member_social w_organization_social'
            // ]);
            Session::put('clientID', $clientID);
            Session::put('clientSecret', $clientSecret);
            return response()->json(  ['success' => $authUrl ] );
        }
    }

    public function linkedInCallBack(Request $request){
        $code = $request->get('code');
        $client_id = Session::get('clientID');
        $client_secret = Session::get('clientSecret');;
        $redirect_uri = route('user.linkedInCallBack');

        // Exchange the authorization code for an access token
        $response = Http::asForm()->post('https://www.linkedin.com/oauth/v2/accessToken', [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $redirect_uri,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
        ]);
       // dd( $response->json() );
         $access_token = $response->json()['access_token'];
         $expires_in = $response->json()['expires_in'];
         $refresh_token = $response->json()['refresh_token'];
         $refresh_token_expires_in = $response->json()['refresh_token_expires_in'];

         $getResult = $this->insertOrUpdateConfigData($client_id,  $client_secret, $access_token, $expires_in, $refresh_token, $refresh_token_expires_in);
        if ($getResult == true) {
            session()->flash('success', 'LinkedIn Configuration Setup Successfully');
           return redirect()->route('user.linkedinConfigView');
        }else {
            session()->flash('fail', 'Something Wrong, Please Try Again');
            return redirect()->route('user.linkedinConfigView');
        }
        
        Session::pull('clientID');
        Session::pull('clientSecret');
        // dd($access_token);
        // Store the access token or use it directly to make API calls
        //return redirect()->route('linkedin.post', ['token' => $access_token]);

        
        
    }

    public function insertOrUpdateConfigData($client_id, $client_secret, $access_token, $expires_in, $refresh_token,  $refresh_token_expires_in){
        $userId = $this->userId();
        $accessTokenExpiresAt = Carbon::now()->addSeconds($expires_in);
        $refreshTokenExpiresAt = Carbon::now()->addSeconds($refresh_token_expires_in);
        $accessTokenExpiresAt = $accessTokenExpiresAt->toDateTimeString();
        $refreshTokenExpiresAt = $refreshTokenExpiresAt->toDateTimeString();

        // Start  Linkedin Profile name id get
        $url = 'https://api.linkedin.com/v2/me';

        // Make the API request
        $response = Http::withToken($access_token)->get($url);
    
        $profileFirstName = null;
        $profileLastName = null;
        $profileId = null;

        if ($response->successful()) {
            $data = $response->json(); // Decode the response
    
            // Extract name and ID
            $profileFirstName = $data['localizedFirstName'];
            $profileLastName = $data['localizedLastName'];
            $profileId = $data['id'];
        }

        $name = $profileFirstName .' '.$profileLastName;
        try {
            configLinkedIn::updateOrCreate(
                ['linkedin_profile_id' => $profileId],
                [
                    'uid' => $userId,
                    'clientID' => $client_id,
                    'clientSecret' => $client_secret,
                    'linkedin_access_token' => $access_token,
                    'expires_in' => $accessTokenExpiresAt,
                    'refresh_token' => $refresh_token,
                    'refresh_token_expires_in' => $refreshTokenExpiresAt,
                    'linkedin_profile_name' => $name,
                    
                ]
            );

            $selectConfigLI = configLinkedIn::where('linkedin_profile_id',  $profileId)->first();
            //dd($selectConfigLI);
            try{
               // $token = session('linkedin_token');

                $response = Http::withToken($access_token)
                    ->get('https://api.linkedin.com/v2/organizationAcls', [
                        'q' => 'roleAssignee',
                        'role' => 'ADMINISTRATOR',
                    ]);
                    //dd($response->status()  );
                if ($response->status() === 401) {
                    return false;
                }

                if ($response->successful()) {
                    $data = $response->json();
                   
                    // Check if elements exist
                    if (isset($data['elements'])) {
                        foreach ($data['elements'] as $page) {
                            // Extract the organization URN (LinkedIn Page URN)
                            $organizationURN = $page['organization'] ?? null;
                            //dd($organizationURN);
                            if ($organizationURN) {
                                $organizationId = str_replace('urn:li:organization:', '', $organizationURN);
                                // LinkedIn Page name get
                                $url = "https://api.linkedin.com/v2/organizations/{$organizationId}";
                                $responseName = Http::withToken($access_token)
                                ->get($url);

                                //dd($responseName->status());

                                if ($responseName->successful()) {
                                    $dataName = $responseName->json();
                                    //dd($dataName);
                                    $LdPageName =  $dataName['localizedName'];
                                    
                                }else{
                                    $LdPageName = 'Name not found';
                                }


                                // Insert into MySQL database
                                configLinkedinPage::updateOrCreate(
                                    ['pageURN' => $organizationURN], // Unique identifier for the page
                                    [
                                        'uid' => $userId,
                                        'uldconfigid' => $selectConfigLI->id,
                                        'clientID' => $client_id,
                                        'linkedinProfileId' => $profileId,
                                        'pageName' => $LdPageName,
                                        'pageId' => $organizationId,
                                        'userRole' => 'ADMINISTRATOR',
                                        //'pageId' => $organizationURN,
                                    ]
                                );
                            }
                        }
                    }
            
                    return true;
                }



                //return false;
            }catch ( Exception $e ) {
                return false;
            }
           // return true;
        }catch ( Exception $e ) {
            return false;
        }

        // End  Linkedin Profile name id get


        // $emailTemplate = configLinkedIn::where( 'uid', $userId )->first();
        // if (empty($emailTemplate)) {
        //     try {
        //         configLinkedIn::create( array(
        //             'uid'       => $userId,
        //             'clientID'       => $client_id,
        //             'clientSecret'       => $client_secret,
        //             'linkedin_access_token'       => $access_token,
        //         ) );
        //         return true;
        //     } catch ( Exception $e ) {
        //         return false;
                
        //     }
        // }else{
        //     try {
        //         DB::table('config_linkedins')
        //         ->where('uid', $userId)
        //         ->update([
        //             'clientID'     => $client_id,
        //             'clientSecret'       => $client_secret,
        //             'linkedin_access_token'       => $access_token,
        //         ]);
        //         return true;
        //     } catch ( Exception $e ) {
        //         return false;
        //     }
        // }
    }


}