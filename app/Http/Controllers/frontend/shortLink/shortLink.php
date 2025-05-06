<?php

namespace App\Http\Controllers\frontend\shortLink;

use App\Http\Controllers\Controller;
use App\Models\hit_link;
use App\Models\shortLink as ModelsShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Exception;
// User Detector USE
use Browser;

use GuzzleHttp\Client;


class shortLink extends Controller
{
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = $this->userId();
        $allShortLink = ModelsShortLink::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
        //dd($allShortLink);

        return view('frontend.shortLink.list', compact('allShortLink'));
    }




    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
        
    // }

        /*
    Genarate Auto Short Code.
     */
    public function shortCodeM() {
        $shortCode = substr( str_shuffle( str_repeat( $x = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMONPQRSTUVWXYZ", ceil( 6 / strlen( $x ) ) ) ), 1, 6 );
        $codeCheck = DB::table( 'short_links' )->where( 'shortCode', $shortCode )->first();
        if ( $codeCheck ) {
            $codePass = $this->shortCodeM();
            return $codePass;
        } else {
            $codePass = $shortCode;
            return $codePass;
        }
    }


    public function checkShortCode($code){
        $codeCheck = DB::table( 'short_links' )->where( 'shortCode', $code )->first();
        if ( $codeCheck ) {
            return true;
        } else {
            return false;
        }
    }

    // Long Code Check

    public function longCodeCheck($longCode){
        $userId = $this->userId();
        $longCodeCheck = DB::table( 'short_links' )->where( 'longLink', $longCode )->where('uid', $userId )->first();
        if ($longCodeCheck) {
            return $longCodeCheck->title;
        }else{
            return false;
        }
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'longLink' => 'required|url:http,https',
            'shortCode' => 'nullable|string|min:6|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            if (empty($request->shortCode)) {
                $code = $this->shortCodeM();
            }else{
                $code = $request->shortCode;
                $code = str_replace(' ', '', $code);
                $codeCheck = $this->checkShortCode($code);
                if($codeCheck == true){
                    return response()->json(  ['errors' => 'Sorry, your short code is already in the database. Please choose another short code.'] );
                }                
            }
            
            $userId = $this->userId();
            $longCodeCheck = $this->longCodeCheck($request->longLink);
            if($longCodeCheck  != false){
                return response()->json(  ['errors' => 'Sorry, You already enter this long link, Long Link Title '. $longCodeCheck ] );
            }

            // Image File Code Start here
            $image    = $request->file('seoImage');

            if(!empty($image)){
                if ($image->isValid()) {
                    $file_name =  substr(md5(mt_rand()), 0, 7).'.'.$image->getClientOriginalExtension();
                    $request->seoImage->move(public_path('/uploads/SEOImage/'), $file_name);
                    //$image->storeAs('social', $file_name, ['disk' => 'public']);
                    $insertLink = '/uploads/SEOImage/'.$file_name;
                }else{
                    return response()->json(  ['errors' => 'Sorry, Image not valid.'] );
                }
                
            }elseif(empty($image)){
                $insertLink = 'imageNotSet';
            }
            // Image File Code End  Here
            
            try {
                ModelsShortLink::create( array(
                    'uid'       => $userId,
                    'title'     => $request->title,
                    'description'     => $request->description,
                    'longLink'       => $request->longLink,
                    'shortCode' => $code,
                    'linkSEO' => $request->linkSEO,
                    'seoTitle' => $request->seoTitle,
                    'seoDescription' => $request->seoDescription,
                    'seoUrl' => $request->seoUrl,
                    'seoImage' => $insertLink,
                ) );
                return response()->json( [ 'success' => 'Your Short Code Added Successfully' ] );
            } catch ( Exception $e ) {
                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
            }
           
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $singleLinkData = DB::table( 'short_links' )->where( 'id', $id )->get();
        $singleLinkDetailsdata = DB::table( 'hit_links' )->where( 'lid', $id )->get();
        return view( 'frontend.shortLink.view' )
        ->with( compact( 'singleLinkData' ) )
        ->with( compact( 'singleLinkDetailsdata' ) );
        // ->with( compact( 'browserFamily' ) )
        // ->with( compact( 'oparatingSystem' ) )
        // ->with( compact( 'uniqueUser' ) )
        // ->with( compact( 'hiturl' ) );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      //  $userId = $this->userId();
      //sleep(5);
        $singleShortLink = ModelsShortLink::find($id);
        return response()->json($singleShortLink);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $updateRequest, string $id)
    {
        // dd($updateRequest->all());
       //$upData = $updateRequest->title.'/'.$updateRequest->description.'/'. $updateRequest->longLink.'/'. $updateRequest->shortCode;

      // return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected  ID'.$id.'  | '.$upData.' ****'] );

        $validator = Validator::make($updateRequest->all(), [
            'title' => 'required',
            'longLink' => 'required|url:http,https',
            'shortCode' => 'nullable|string|min:6|max:50',
            'linkSEOUpdate' => 'nullable|string',
            'seoTitleUpdate' => 'required_with:linkSEOUpdate',
            'seoDescriptionUpdate' => 'required_with:linkSEOUpdate',
            'seoUrlUpdate' => 'required_with:linkSEOUpdate',
            //'seoImageUpdate' => 'required_with:linkSEOUpdate',
        ]);
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            // dd($updateRequest->all());
            $userId = $this->userId();
            // $longCodeCheck = $this->longCodeCheck($updateRequest->longLink);
            // if($longCodeCheck  != false){
            //     return response()->json(  ['errors' => 'Sorry, You have already entered this long link. Long Link Title '. $longCodeCheck ] );
           // }else{
                    // Handle image upload
                    $image = $updateRequest->file('seoImageUpdate');
                    $insertLink = 'imageNotSet';  // Default value if no image is uploaded
                    $shortLinkFind = ModelsShortLink::findOrFail($id);
                // dd($image);
                    if ($image) {
                        if ($image->isValid()) {
                            // Generate a unique filename for the image
                            $file_name = substr(md5(mt_rand()), 0, 7) . '.' . $image->getClientOriginalExtension();
                            // Move the image to the uploads folder
                            $image->move(public_path('/uploads/SEOImage/'), $file_name);
                            $insertLink = '/uploads/SEOImage/' . $file_name;
                        } else {
                            return response()->json(['errors' => ['Sorry, the image is not valid.']]);
                        }

                        if (!empty($shortLinkFind->seoImage)) {
                            $oldImagePath = public_path($shortLinkFind->seoImage);
                            if(file_exists($oldImagePath)){
                                unlink($oldImagePath);
                            }
                        }
                    }

                    $seoTitleUpdate = $updateRequest->seoTitleUpdate;
                    $seoDescriptionUpdate = $updateRequest->seoDescriptionUpdate;
                    $seoUrlUpdate = $updateRequest->seoUrlUpdate;
                    $linkSEOUpdate = $updateRequest->linkSEOUpdate;
                   // $seoImageUpdate = $updateRequest->seoImageUpdate;
                    if(empty($updateRequest->linkSEOUpdate)){
                        $seoTitleUpdate = null;
                        $seoDescriptionUpdate = null;
                        $seoUrlUpdate = null;
                        $linkSEOUpdate = 0;
                        
                        if (!empty($shortLinkFind->seoImage)) {
                            $oldImagePath = public_path($shortLinkFind->seoImage);
                            if(file_exists($oldImagePath)){
                                unlink($oldImagePath);
                            }
                        }
                       // $seoImageUpdate = null;
                    }

                   
                    try {
                        $shortLinkData = ModelsShortLink::find($id);
                        $shortLinkData->title = $updateRequest->title;
                        $shortLinkData->description = $updateRequest->description;
                        $shortLinkData->longLink = $updateRequest->longLink;
                        $shortLinkData->linkSEO = $linkSEOUpdate;
                        $shortLinkData->seoTitle = $seoTitleUpdate;
                        $shortLinkData->seoDescription = $seoDescriptionUpdate;
                        if (!empty($updateRequest->file('seoImageUpdate'))) {
                            $shortLinkData->seoImage = $insertLink;
                        }
                        $shortLinkData->seoUrl = $seoUrlUpdate;
                        $shortLinkData->save();
                        return response()->json( [ 'success' => 'Your Short Code Updated Successfully' ] );
                    } catch ( Exception $e ) {
                        return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
                    }
           // }  //Long Link Check
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id){
            $delete = ModelsShortLink::findOrFail( $id );
            $delete->delete();
            return response()->json( [ 'success' => 'Your data has been successfully deleted.'] );    
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }
        /**
     * Delete The Selected Item.
     */
    public function selectDelete(Request $deletedRequest){
        $validator = Validator::make($deletedRequest->all(), [
            'deletedIds' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            $jsonData = $deletedRequest->deletedIds;
            $deletedIds = json_decode($jsonData, true);
            $totalDeleted = count($deletedIds);
            $completed = 0;
            $unCompleted = 0;
            foreach($deletedIds  as $deletedId){
                if($deletedId){
                    $delete = ModelsShortLink::findOrFail( $deletedId );
                    $delete->delete();
                    $completed++;
                   // return response()->json( [ 'success' => 'Your data has been successfully deleted.'] );    
                }else{
                   // return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
                    $unCompleted++;
                }
                //var_dump($);
            }
            if($completed >= 1){
                return response()->json( [ 'success' => 'Your data has been successfully deleted. ('.$completed.'/'.$totalDeleted.')'] );  
            }else{
                return response()->json(  ['errors' => 'Something Wrong, Your Data Not Deleted, Please Try Again'] );
            }
            
        }
    }
    // Get Client Ip Address
    function get_client_ip() {
        $ipaddress = '';
        if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) ) {
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else if ( isset( $_SERVER['HTTP_X_FORWARDED'] ) ) {
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if ( isset( $_SERVER['HTTP_FORWARDED_FOR'] ) ) {
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if ( isset( $_SERVER['HTTP_FORWARDED'] ) ) {
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        } else if ( isset( $_SERVER['REMOTE_ADDR'] ) ) {
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }
    //  Short Link Details 
    public function linkDetail(Request $request, $id){

        $emailShortCode = $request->query('link');
        
        //$singleShortLink = ModelsShortLink::where('shortCode', $id)->firstOrFail();
        $singleShortLink = ModelsShortLink::where('shortCode', $id)->first();
       // $count = DB::table( 'short_link' )->where( 'shortcode', $ly )->count();
        $countHitUrl = DB::table( 'hit_links' )->count();

        $getHitUrl = "Direct Click";
        if ( isset( $_SERVER['HTTP_REFERER'] ) ) {
            $getHitUrl = $_SERVER['HTTP_REFERER'];
        }
        
        if (!empty($singleShortLink)) {
            $select = DB::table( 'short_links' )->where( 'shortCode', $id )->first();
            $link = $select->longLink;
            $lid = $select->id;
            $count = $select->count;
            $countUpdate = $count + 1;
            /*Link Count Update*/
            $update = ModelsShortLink::findOrFail( $lid );
            $update->count = $countUpdate;
            $update->save();
            /*Link Location etc Found*/
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, "http://ip-api.com/json" );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            $result = curl_exec( $ch );

            $result = json_decode( $result );
            //Client Location ETC Found
            $PublicIP = request()->ip();
            //dd($PublicIP);
            //$PublicIP = '103.200.37.215';
            //$json = file_get_contents( "http://ipinfo.io/$PublicIP/geo" );
            //$json = json_decode( $json, true );
            try {
                $client = new Client();
                //$response = $client->get("https://ipinfo.io/{$PublicIP}/json");
                //
                //$response = $client->get("https://ipinfo.io/{$PublicIP}?token=e4b48dd53cb0ed"); Email
                $response = $client->get("https://get.geojs.io/v1/ip/geo/{$PublicIP}.json");
                $json = json_decode($response->getBody(), true);
            }catch (RequestException $e) {
                // Log or handle the error
                Log::error('API request failed: ' . $e->getMessage());
                return response()->json(['error' => 'Failed to get IP info.'], 500);
            }
            
            
            if(!empty($json)){
                $countryCode = $json['country_code'];
                $region = $json['organization_name'];
                $city = $json['country'];
                $postCode = $json['country'];
                $timezone = $json['timezone'];
                /*Location Track*/
              // $location = $json['loc'];
               //$str_arr = explode( ",", $location );
              // $lat = $str_arr['0'];
               //$lon = $str_arr['1'];
               
               $lat = $json['latitude'];
               $lon = $json['longitude'];
            }else{
                $countryCode = null;
                $region = null;
                $city = null;
                $postCode = null;
                $timezone = null;
                /*Location Track*/
               $location = null;
               //$str_arr = explode( ",", $location );
               $lat = null;
               $lon = null;
            }


           /*Client Information*/

            //deviceFamily (Device's vendor like Samsung, Apple, Huawei.)
            if ( Browser::deviceFamily() == "Unknown" ) {
                $deviceFamily = 'Unknown Device Family';
            } elseif ( empty( Browser::deviceFamily() ) ) {
                $deviceFamily = 'Others';
            } else {
                $deviceFamily = Browser::deviceFamily();
            }

            //Device Model (Device's brand name like iPad, iPhone, Nexus.)
            if ( Browser::deviceModel() == "Unknown" ) {
                $deviceModel = 'Unknown Device Model';
            } elseif ( empty( Browser::deviceModel() ) ) {
                $deviceModel = 'Others';
            } else {
                $deviceModel = Browser::deviceModel();
            }
            //platformName (Operating system's human friendly name like Windows XP, Mac 10.)
            if ( Browser::platformName() == "Unknown" ) {
                $platformName = 'Unknown platform Name';
            } elseif ( empty( Browser::platformName() ) ) {
                $platformName = 'Others';
            } else {
                $platformName = Browser::platformName();
            }
            //Browser Name (Browser's human friendly name like Firefox 3.6, Chrome 42.)
            if ( Browser::browserName() == "Unknown" ) {
                $browserName = 'Unknown browser Name';
            } elseif ( empty( Browser::browserName() ) ) {
                $browserName = 'Others';
            } else {
                $browserName = Browser::browserName();
            }
            //Browser Name (Browser's human friendly name like Firefox 3.6, Chrome 42.)
            if ( Browser::browserFamily() == "Unknown" ) {
                $browserFamily = 'Unknown browser Family';
            } elseif ( empty( Browser::browserFamily() ) ) {
                $browserFamily = 'Others';
            } else {
                $browserFamily = Browser::browserFamily();
            }
            //Operating system extended functions
            if ( Browser::isWindows() ) {
                $Os = "Windows";
            } elseif ( Browser::isLinux() ) {
                $Os = "Linux";
            } elseif ( Browser::isMac() ) {
                $Os = "Mac";
            } elseif ( Browser::isAndroid() ) {
                $Os = "Android";
            } else {
                $Os = 'Others';
            }

             //Browser Name (Browser's human friendly name like Firefox 3.6, Chrome 42.)
             if ( Browser::deviceType() == "Unknown" ) {
                $deviceType = 'Unknown device Type';
            } elseif ( empty( Browser::deviceType() ) ) {
                $deviceType = 'Others';
            } else {
                $deviceType = Browser::deviceType();
            }

            //Browser Name (Browser's human friendly name like Firefox 3.6, Chrome 42.)
            if ( Browser::isBot() == true ) {
                $isBot = 'Yes';
            } else {
                $isBot = 'No';
            }

            /*Unique User Check*/
                $getUniqeIP = DB::table( 'hit_links' )->where( 'ip', $PublicIP )->where( 'lid', $lid )->first();
                if ( $getUniqeIP ) {
                    $unique = 0;
                } else {
                    $unique = 1;
                }


            // Check and email tracking 
            $campaignId = null;
            $emailCollectionsId  = null;
            $email  = null;

            if ($emailShortCode) {
                $emailTrackDataGet = DB::table( 'emailtrackings' )->where( 'shortcode', $emailShortCode )->first();
                if ($emailTrackDataGet) {
                    $campaignId = $emailTrackDataGet->cid;
                    $emailCollectionsId  = $emailTrackDataGet->emailid;
                    $email  = $emailTrackDataGet->semail;
                }
            }
           // dd($campaignId);
            //dd($emailCollectionsId);
            //dd($email);

            try {
                hit_link::create( array(
                    'lid'             => $lid,
                    'campaignId'             => $campaignId,
                    'emailCollectionsId'             => $emailCollectionsId,
                    'countryCode'     => $countryCode,
                    'region'          => $region,
                    'city'            => $city,
                    'zip'             => $postCode,
                    'lat'             => $lat,
                    'lon'             => $lon,
                    'timezone'        =>  $timezone,
                    'deviceFamily'    => $deviceFamily,
                    'deviceModel'     => $deviceModel,
                    'platformName'    => $platformName,
                    'BrowserName'     => $browserName,
                    'browserFamily'   => $browserFamily,
                    'oparatingSystem' => $Os,
                    'deviceType' => $deviceType,
                    'isBot' => $isBot,
                    'hiturl'          => $getHitUrl,
                    'ip'              => $PublicIP,
                    'email'              => $email,
                    'uniqueUser'      => $unique,
                ) );

                if ($singleShortLink->linkSEO == 1) {
                    return view('frontend.shortLink.redirect', compact('link', 'singleShortLink'));
                }else{
                    return Redirect::to( $link );
                }
                 
                 
        } catch ( Exception $e ) {
            //echo "Data Not Get ". $e;
            return view('errors.notFound');
        }

        }else{
            //echo "Data Not Found";
            return view('errors.notFound');
        }


    }
}