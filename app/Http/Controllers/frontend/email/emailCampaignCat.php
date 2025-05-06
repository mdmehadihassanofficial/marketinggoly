<?php

namespace App\Http\Controllers\frontend\email;

use App\Http\Controllers\Controller;
use App\Models\emailCampaignCat as ModelsEmailCampaignCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;

class emailCampaignCat extends Controller
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
        $emailCampaignCat = ModelsEmailCampaignCat::where( 'uid', $userId )->orderBy('id', 'DESC')->get();

        return view('frontend.email.campaignCat.list', compact('emailCampaignCat'));
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
            'campaignCategory' => 'required',
        ]);
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            try {
                ModelsEmailCampaignCat::create( array(
                    'uid'       => $userId,
                    'campaignCategory'     => $request->campaignCategory,
                ) );
                return response()->json( [ 'success' => 'Your Campaign Category Added Successfully' ] );
            } catch ( Exception $e ) {
                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
            }
        }
       // return response()->json( [ 'success' => 'Your Email Category  Added Successfully' ] );
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
        $single = ModelsEmailCampaignCat::find($id);
        return response()->json($single);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'campaignCategory' => 'required',
        ]);
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            try {
                $data = ModelsEmailCampaignCat::find($id);
                $data->campaignCategory = $request->campaignCategory;
                $data->save();
                return response()->json( [ 'success' => 'Your Campaign Category Updated Successfully' ] );
            } catch ( Exception $e ) {
                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id){
            $delete = ModelsEmailCampaignCat::findOrFail( $id );
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
                        $delete = ModelsEmailCampaignCat::findOrFail( $deletedId );
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
                $data = ModelsEmailCampaignCat::find($id);
                $data->status = 0;
                $data->save();
                return response()->json( [ 'success' => 'Your Data Deactivated Successfully' ] );
            }else{
                return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
            }
        }
    
        public function active($id){
            if($id){
                $data = ModelsEmailCampaignCat::find($id);
                $data->status = 1;
                $data->save();
                return response()->json( [ 'success' => 'Your Data Activated Successfully' ] );
            }else{
                return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
            }
        }
}