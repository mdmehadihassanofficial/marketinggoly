<?php

namespace App\Http\Controllers\frontend\email;

use App\Http\Controllers\Controller;
use App\Models\emailCampaign as ModelsEmailCampaign;
use App\Models\emailCampaignCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;

class emailCampaign extends Controller
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
        $emailCampaignCat = emailCampaignCat::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
        //$emailCampaign = ModelsEmailCampaign::join('email_campaigns', 'email_campaign_cats.id', '=', 'email_campaigns.campaignCategoryId')->where( 'email_campaigns.uid', $userId )->orderBy('email_campaigns.id', 'DESC')->get();
        $emailCampaign = DB::table('email_campaigns')
                    ->join('email_campaign_cats', 'email_campaign_cats.id', '=', 'email_campaigns.campaignCategoryId')
                    //->join('orders', 'users.id', '=', 'orders.user_id')
                    ->select('email_campaigns.*', 'email_campaign_cats.campaignCategory')
                    ->where('email_campaigns.uid', $userId)
                    ->orderBy('email_campaigns.id', 'DESC')
                    ->get();
        return view('frontend.email.campaign.list')->with(compact('emailCampaignCat'))->with(compact('emailCampaign'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'campaignCategoryId' => 'required',
        ]);
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            try {
                ModelsEmailCampaign::create( array(
                    'uid'       => $userId,
                    'title'       => $request->title,
                    'description'       => $request->description,
                    'campaignCategoryId'     => $request->campaignCategoryId,
                ) );
                return response()->json( [ 'success' => 'Your Campaign Added Successfully' ] );
            } catch ( Exception $e ) {
                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
            }
        }
        //return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$request->title] );
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
    public function edit(string $id)
    {
        $single = ModelsEmailCampaign::find($id);
        return response()->json($single);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'campaignCategoryId' => 'required',
        ]);
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            try {
                $data = ModelsEmailCampaign::find($id);
                $data->title = $request->title;
                $data->description = $request->description;
                $data->campaignCategoryId = $request->campaignCategoryId;
                $data->save();
                return response()->json( [ 'success' => 'Your Campaign Updated Successfully' ] );
            } catch ( Exception $e ) {
                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
            }
        }
       // return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$request->campaignCategoryId] );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id){
            $delete = ModelsEmailCampaign::findOrFail( $id );
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
                    $delete = ModelsEmailCampaign::findOrFail( $deletedId );
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
            $data = ModelsEmailCampaign::find($id);
            $data->status = 0;
            $data->save();
            return response()->json( [ 'success' => 'Your Data Deactivated Successfully' ] );
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }

    public function active($id){
        if($id){
            $data = ModelsEmailCampaign::find($id);
            $data->status = 1;
            $data->save();
            return response()->json( [ 'success' => 'Your Data Activated Successfully' ] );
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }
}