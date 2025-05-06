<?php

namespace App\Http\Controllers\frontend\socialPostManager;

use App\Http\Controllers\Controller;
use App\Models\configFacebookpage;
use App\Models\configLinkedIn;
use App\Models\configLinkedinPage;
use App\Models\socialPostManager;
use App\Models\socialPostReport;
use App\Models\socialTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class socialPostManage extends Controller
{
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }
    
    public function socialPostManageView(){
        $userId = $this->userId();
        //$allSocialPostManage = socialPostManager::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
        // $allSocialPostManage = DB::table('social_post_managers')
        // ->join('social_templates', 'social_templates.id', '=', 'social_post_managers.socialTemplateId')
        // //->join('orders', 'users.id', '=', 'orders.user_id')
        // ->select('social_post_managers.*', 'social_templates.title as sttitle', 'social_templates.id as stid')
        // ->where('social_post_managers.uid', $userId)
        // ->orderBy('social_post_managers.id', 'DESC')
        // ->get();
        //dd($allSocialPostManage);
        $allSocialPostManage = socialPostManager::where('uid', $userId)->orderBy('id', 'DESC')->get();

        $socialTemplate = socialTemplate::where( 'uid', $userId )->where( 'status', 1 )->orderBy('id', 'DESC')->get();
        $configLinkedin = configLinkedIn::where('uid', $userId)->first();
        $configFbPages = configFacebookpage::where('uid', $userId)->get();
        $configLdPages = configLinkedinPage::where('uid', $userId)->get();
        $socialPostReport = socialPostReport::where('uid', $userId)->orderBy('id', 'DESC')->first();

        return view('frontend.socialPost.postManage', compact('allSocialPostManage', 'socialTemplate', 'configLinkedin', 'configFbPages', 'configLdPages', 'socialPostReport'));
    }

    public function templateViewById( $id)
    {
        $singleSocialTemplate = socialTemplate::where('id', $id)->first();
        return response()->json($singleSocialTemplate);
    }

    public function socialPostReport($id){
        $singlePostReport = socialPostReport::where('spmId', $id)->get();
        return response()->json($singlePostReport);
    }

    public function socialPostReportView($id){
        $groupByDatePostReport = socialPostReport::select('postDateTime', DB::raw('COUNT(id) as report_count'))
                                                    ->where('spmId', $id)
                                                    ->groupBy('postDateTime')
                                                    ->get();
        
        $socialPostManager = socialPostManager::where('id', $id)->first();

        $singlePostReport = socialPostReport::where('spmId', $id)->get();

      //  return response()->json($singlePostReport);
      return view('frontend.socialPost.postReport', compact('singlePostReport', 'socialPostManager', 'groupByDatePostReport'));
    }

    public static function socialPostReportByDate($date){
        $groupByDatePostReport = socialPostReport::where('postDateTime', $date)->get();
        return $groupByDatePostReport;
    }

    public static function fbPageName($pageId){
        $parts = explode('-',  $pageId);
        $getPageId = end($parts);
        $getPageName = configFacebookpage::select('pageName')->where('pageId', $getPageId)->first();
        return $getPageName;
    }


    public static function socialTemplateTitleGet($socialTemId){
        $getSocialTemplateTitle = socialTemplate::select('title')->where('id', $socialTemId)->first();
        return $getSocialTemplateTitle;
    }

    public static function socialTemplateReportFound($spmId){
        $getSocialTemplateTitle = socialPostReport::select('id')->where('spmId', $spmId)->first();
        if ($getSocialTemplateTitle) {
            return true;
        }else{
            return false;
        }
    }

    public static function fbPagePermission($pageId, $pageAccessToken){
        $response = Http::get("https://graph.facebook.com/{$pageId}/permissions", [
            'access_token' => $pageAccessToken,
        ]);



    $resData = $response->json();
        var_dump($response);
    // dd($resData );
    // if(isset($resData['data'])){
    //     return $resData['data'];;
    // }else{
    //     return "Error";
    // }
    

        // if ($response->successful()) {
        //     $permissions = $response->json();
        //     // Handle the permissions response as needed
        //     return  $permissions;
        // } else {
        //     // Handle error
           
        // }
    }

    public static function linkedInPageName($pageId){
        $parts = explode('-',  $pageId);
        $getPageURN = end($parts);
        $getPageName = configLinkedinPage::select('pageName')->where('pageURN', $getPageURN)->first();
        return $getPageName;
    }


    // Social Post Manage Delect
    public function destroy(string $id)
    {
        if($id){
            $delete = socialPostManager::findOrFail( $id );
            $delete->delete();
            return response()->json( [ 'success' => 'Your data has been successfully deleted.'] );    
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }

    // Multipe Delete
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
                    $delete = socialPostManager::findOrFail( $deletedId );
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

    public function deactive($id){
        if($id){
            $data = socialPostManager::find($id);
            $data->status = 0;
            $data->save();
            return response()->json( [ 'success' => 'Your Data Deactivated Successfully' ] );
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }

    public function active($id){
        if($id){
            $data = socialPostManager::find($id);
            $data->status = 1;
            $data->save();
            return response()->json( [ 'success' => 'Your Data Activated Successfully' ] );
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }


    public function socialPostManageUpdate(string $id)
    {
        $socialPostManagerItem = socialPostManager::find($id);
        return response()->json($socialPostManagerItem);
    }

    







}