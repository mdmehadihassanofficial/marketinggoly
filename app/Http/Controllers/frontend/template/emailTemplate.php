<?php

namespace App\Http\Controllers\frontend\template;

use App\Http\Controllers\Controller;
use App\Models\emailTemplate as ModelsEmailTemplate;
use App\Models\emailTemplateDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;

class emailTemplate extends Controller
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
        $allEmailTemplate = ModelsEmailTemplate::where( 'uid', $userId )->orderBy('id', 'DESC')->get();

        return view('frontend.email.template.emailTemplateList', compact('allEmailTemplate'));
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
            'emailSubject' => 'required',
        ]);
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            try {
                ModelsEmailTemplate::create( array(
                    'uid'       => $userId,
                    'title'     => $request->title,
                    'emailSubject'     => $request->emailSubject,
                    'description'     => $request->description,
                ) );
                return response()->json( [ 'success' => 'Your Email Template Added Successfully' ] );
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $single = ModelsEmailTemplate::find($id);
        return response()->json($single);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'emailSubject' => 'required',
        ]);
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            try {

                $data = ModelsEmailTemplate::find($id);
                $data->title = $request->title;
                $data->emailSubject = $request->emailSubject;
                $data->description = $request->description;
                $data->save();
                return response()->json( [ 'success' => 'Your Email Template Updated Successfully' ] );

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
            $delete = ModelsEmailTemplate::findOrFail( $id );
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
                    $delete = ModelsEmailTemplate::findOrFail( $deletedId );
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
            $data = ModelsEmailTemplate::find($id);
            $data->status = 0;
            $data->save();
            return response()->json( [ 'success' => 'Your Email Template Deactivated Successfully' ] );
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }

    public function active($id){
        if($id){
            $data = ModelsEmailTemplate::find($id);
            $data->status = 1;
            $data->save();
            return response()->json( [ 'success' => 'Your Email Template Activated Successfully' ] );
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }

    public function designView($id){
	$userId = $this->userId();
	$emailTemplateDesign = emailTemplateDesign::where( 'uid', $userId )->where( 'etid', $id )->first();
	$emailTemplate = ModelsEmailTemplate::where( 'uid', $userId )->where( 'id', $id )->first();
    if (!empty($emailTemplate)) {
        return view('frontend.email.template.design')->with( compact( 'id' ) )
        ->with( compact( 'emailTemplateDesign' ) );
    }else{
        return view('errors.404');
    }

    }

    public function designSave(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'html' => 'required',
            'css' => 'required',
        ]);
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            $emailTemplate = emailTemplateDesign::where( 'uid', $userId )->where( 'etid', $id )->first();
            if (empty($emailTemplate )) {
                    try {
                        emailTemplateDesign::create( array(
                            'uid'       => $userId,
                            'etid'       => $id,
                            'html'     => $request->html,
                            'css'     => $request->css,
                        ) );
                        return response()->json( [ 'success' => 'Your Template Design Successfully Saved' ] );
                    } catch ( Exception $e ) {
                        return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
                    }
            }else{
		try {
			DB::table('email_template_designs')
			->where('etid', $id)
			->update([
				'html' => $request->html,
				'css' => $request->css,
			]);
                        return response()->json( [ 'success' => 'Your Design Successfully Updated' ] );
                } catch ( Exception $e ) {
                        return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
                }
	    }

        }
    }



}