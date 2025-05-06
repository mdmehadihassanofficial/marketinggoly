<?php

namespace App\Http\Controllers\frontend\email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\emailCampaign;
use App\Models\emailCollection;
use App\Models\emailManager as ModelsEmailManager;
use App\Models\emailTemplate;
use App\Models\emailTemplateDesign;
use App\Models\emailtrackings;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;

use Exception;

class emailManager extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }
    public function index()
    {
        $userId = $this->userId();
        //$emailTemplate = emailTemplate::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
        $emailTemplate = DB::table('email_template_designs')
                                        ->join('email_templates', 'email_templates.id', '=', 'email_template_designs.etid')
                                        //->join('orders', 'users.id', '=', 'orders.user_id')
                                        ->select('email_template_designs.etid', 'email_templates.*')
                                        ->where('email_template_designs.uid', $userId)
                                        ->orderBy('email_template_designs.etid', 'DESC')
                                        ->get();
        $emailCampaign = emailCampaign::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
        $allEmailManager = ModelsEmailManager::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
        return view('frontend.email.emailManager.manager', compact('emailTemplate', 'emailCampaign', 'allEmailManager'));
    }

    public function emailManagerReport($id){
        $userId = $this->userId();
        $groupByDateEmailReport = emailtrackings::select('postDateTime', DB::raw('COUNT(id) as report_count'))
                                                    ->where('emailmanagerid', $id)
                                                    ->groupBy('postDateTime')
                                                    ->get();
        
        
        $emailManager = ModelsEmailManager::where('id', $id)->first();

        $emailManagerReport = emailtrackings::where('emailmanagerid', $id)->get();
        //dd($emailManagerReport);
        return view('frontend.email.emailManager.emailManagerReport', compact('groupByDateEmailReport', 'emailManager', 'emailManagerReport'));
    }

    public static function emailReportByDate($date){
        $groupByDatePostReport = emailtrackings::where('postDateTime', $date)->get();
        return $groupByDatePostReport;
    }

    public static function emailReportFound($id){
        $getEmailReportFound = emailtrackings::select('id')->where('emailmanagerid', $id)->first();
        if ($getEmailReportFound) {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function formatDate($dateString, $format = 'Y-m-d H:i:s')
    {
        $date = DateTime::createFromFormat('d, M Y, H:i', $dateString);
        return $date ? $date->format($format) : null;
    }

    public function shortCodeM() {
        do {
            $shortCode = substr(str_shuffle(str_repeat($x = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMONPQRSTUVWXYZ", ceil(100 / strlen($x)))), 1, 100);
            $codeCheck = DB::table('short_links')->where('shortCode', $shortCode)->first();
        } while ($codeCheck);
        return $shortCode;
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'emailSubject' => 'required',
            'emailCampaignId' => 'required',
            'emailTemplateId' => 'required',
            'postRepeat' => 'nullable|string',
            'postRepeatType' => 'required_with:postRepeat',
            'postStartDate' => 'required_with:postRepeat',
        ]);

        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json(['errors' => 'Sorry, looks like there are some validator error detected ' . $validator->errors()]);
        }

        $emailSubject = $request->emailSubject;
        $emailCampaignId = $request->emailCampaignId;
        $emailTemplateIds = $request->emailTemplateId;
        $JSONEmailTemplate = json_encode($emailTemplateIds);

        if (!empty($request->postRepeat)) {
            $postEndDate = $this->formatDate($request->postEndDate);
            $postStartDate = $this->formatDate($request->postStartDate);

            switch ($request->postRepeatType) {
                case 'daily':
                    $plusRepeat = 1;
                    break;
                case 'weekly':
                    $plusRepeat = 7;
                    break;
                case 'monthly':
                    $plusRepeat = 30;
                    break;
                default:
                    $plusRepeat = 0;
            }

            $nextPostDateTime = $postStartDate ? Carbon::createFromFormat('d, M Y, H:i', $request->postStartDate)->addDays($plusRepeat)->toDateTimeString() : null;

            try {
                ModelsEmailManager::create([
                    'uid' => $userId,
                    'emailTemplateId' => $JSONEmailTemplate,
                    'emailSubject' => $emailSubject,
                    'emailCampaignId' => $emailCampaignId,
                    'postDateTime' => $postStartDate,
                    'nextPostDateTime' => $nextPostDateTime,
                    'endPostDateTime' => $postEndDate,
                    'postRepeatType' => $request->postRepeatType,
                    'postRepeatStatus' => 1,
                    'postStatus' => 0,
                ]);
                return response()->json(['success' => 'Your Email Campaign Added Successfully']);
            } catch (Exception $e) {
                return response()->json(['errors' => 'Sorry, looks like there are some errors detected, please try again Repeat. ' . $e]);
            }
        } else {
            try {
                ModelsEmailManager::create([
                    'uid' => $userId,
                    'emailTemplateId' => $JSONEmailTemplate,
                    'emailSubject' => $emailSubject,
                    'emailCampaignId' => $emailCampaignId,
                    'postDateTime' => now(),
                    'postStatus' => 1,
                ]);
                return response()->json(['success' => 'Your Email Campaign Under Processing']);
            } catch (Exception $e) {
                return response()->json(['errors' => 'Sorry, looks like there are some errors detected, please try again.']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function emailManagerUpdate(string $id)
    {
        $emailManagerItem = ModelsEmailManager::find($id);
        return response()->json($emailManagerItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function emailManagerUp(Request $request, string $id)
    {
                //dd($request->all());
                $validator = Validator::make($request->all(), [
                    'emailSubjectUpdate' => 'required',
                    'emailCampaignIdUpdate' => 'required',
                    'emailTemplateIdUpdate' => 'required',
                    'postRepeatUpdate' => 'nullable|string',
                    'postRepeatTypeUpdate' => 'required_with:postRepeatUpdate',
                    'postStartDateUpdate' => 'required_with:postRepeatUpdate',
                ]);
        
                $userId = $this->userId();
                if ($validator->fails()) {
                    return response()->json(['errors' => 'Sorry, looks like there are some validator error detected ' . $validator->errors()]);
                }
        
                $emailSubject = $request->emailSubjectUpdate;
                $emailCampaignId = $request->emailCampaignIdUpdate;
                $emailTemplateIds = $request->emailTemplateIdUpdate;
                $JSONEmailTemplate = json_encode($emailTemplateIds);
        
                if (!empty($request->postRepeatUpdate)) {
                    $postEndDate = $this->formatDate($request->postEndDateUpdate);
                    $postStartDate = $this->formatDate($request->postStartDateUpdate);
        
                    switch ($request->postRepeatTypeUpdate) {
                        case 'daily':
                            $plusRepeat = 1;
                            break;
                        case 'weekly':
                            $plusRepeat = 7;
                            break;
                        case 'monthly':
                            $plusRepeat = 30;
                            break;
                        default:
                            $plusRepeat = 0;
                    }
        
                    $nextPostDateTime = $postStartDate ? Carbon::createFromFormat('d, M Y, H:i', $request->postStartDateUpdate)->addDays($plusRepeat)->toDateTimeString() : null;
        
                    try {
                        $data = ModelsEmailManager::find($id);
                        $data->uid = $userId;
                        $data->emailTemplateId = $JSONEmailTemplate;
                        $data->emailSubject = $emailSubject;
                        $data->emailCampaignId = $emailCampaignId;
                        $data->postDateTime = $postStartDate;
                        $data->nextPostDateTime = $nextPostDateTime;
                        $data->endPostDateTime = $postEndDate;
                        $data->postRepeatType = $request->postRepeatTypeUpdate;
                        $data->postRepeatStatus = 1;
                        $data->postStatus = 0;
                        //$data->postDateTime = $request->title;
                        //$data->postStatus = $request->title;
                        $data->save();
                        return response()->json( [ 'success' => 'Your Email Manager Updated Successfully' ] );


                        // ModelsEmailManager::create([
                        //     'uid' => $userId,
                        //     'emailTemplateId' => $JSONEmailTemplate,
                        //     'emailSubject' => $emailSubject,
                        //     'emailCampaignId' => $emailCampaignId,
                        //     'postDateTime' => $postStartDate,
                        //     'nextPostDateTime' => $nextPostDateTime,
                        //     'endPostDateTime' => $postEndDate,
                        //     'postRepeatType' => $request->postRepeatType,
                        //     'postRepeatStatus' => 1,
                        //     'postStatus' => 0,
                        // ]);
                        // return response()->json(['success' => 'Your Email Campaign Added Successfully']);


                    } catch (Exception $e) {
                        return response()->json(['errors' => 'Sorry, looks like there are some errors detected, please try again Repeat. ' . $e]);
                    }
                } else {
                    try {

                        $data = ModelsEmailManager::find($id);
                        $data->uid = $userId;
                        $data->emailTemplateId = $JSONEmailTemplate;
                        $data->emailSubject = $emailSubject;
                        $data->emailCampaignId = $emailCampaignId;
                        $data->postDateTime = now();
                        $data->nextPostDateTime = null;
                        $data->endPostDateTime = null;
                        $data->postRepeatType = null;
                        $data->postRepeatStatus = 0;
                        $data->postStatus = 1;
                        //$data->postStatus = $request->title;
                        $data->save();
                        return response()->json( [ 'success' => 'Your Email Under Processing Updated Successfully' ] );


                        // ModelsEmailManager::create([
                        //     'uid' => $userId,
                        //     'emailTemplateId' => $JSONEmailTemplate,
                        //     'emailSubject' => $emailSubject,
                        //     'emailCampaignId' => $emailCampaignId,
                        //     'postDateTime' => now(),
                        //     'postStatus' => 1,
                        // ]);
                        // return response()->json(['success' => 'Your Email Campaign Under Processing']);

                    } catch (Exception $e) {
                        return response()->json(['errors' => 'Sorry, looks like there are some errors detected, please try again.']);
                    }
                }
    }



    public static function emailTemplateTitleGet($emailTemId){
        $getSocialTemplateTitle = emailTemplate::select('title')->where('id', $emailTemId)->first();
        return $getSocialTemplateTitle;
    }

    public static function emailCampaignTitleGet($emailCampId){
        $getSocialTemplateTitle = emailCampaign::select('title')->where('id', $emailCampId)->first();
        return $getSocialTemplateTitle;
    }

    public function emailTemplateViewById($id){
        $userId = $this->userId();
        $emailTemplate = emailTemplateDesign::where( 'uid', $userId )->where('etid', $id)->first();
        return response()->json($emailTemplate);
        //return view('frontend.email.emailManager.emailTemplateView', compact('emailTemplate'));
    }

    public function emailCampaignListViewById($id){
        $userId = $this->userId();
        $campaignEmailList = emailCollection::where( 'uid', $userId )->where('emailCampaignsId', $id)->get();
        return response()->json($campaignEmailList);
        //return view('frontend.email.emailManager.emailTemplateView', compact('emailTemplate'));
    }

        // Social Post Manage Delect
        public function destroy(string $id)
        {
            if($id){
                $delete = ModelsEmailManager::findOrFail( $id );
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
                        $delete = ModelsEmailManager::findOrFail( $deletedId );
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
                $data = ModelsEmailManager::find($id);
                $data->status = 0;
                $data->save();
                return response()->json( [ 'success' => 'Your Data Deactivated Successfully' ] );
            }else{
                return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
            }
        }
    
        public function active($id){
            if($id){
                $data = ModelsEmailManager::find($id);
                $data->status = 1;
                $data->save();
                return response()->json( [ 'success' => 'Your Data Activated Successfully' ] );
            }else{
                return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
            }
        }
}