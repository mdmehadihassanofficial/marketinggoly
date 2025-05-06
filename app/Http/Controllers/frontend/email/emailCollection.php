<?php

namespace App\Http\Controllers\frontend\email;

use App\Http\Controllers\Controller;
use App\Imports\emailCollection as ImportsEmailCollection;
use App\Models\emailCampaign;
use App\Models\emailCollection as ModelsEmailCollection;
use App\Models\emailTemplateDesign;
use App\Models\failedMailCollection;
use Illuminate\Http\Request;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class emailCollection extends Controller
{
    private $client;
    
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $userId = $this->userId();
        $CampaignData= emailCampaign::where( 'id', $id )->first();
        $emailCollection= ModelsEmailCollection::where( 'emailCampaignsId', $id )->where('uid', $userId)->get();
        return view('frontend.email.emailCollection.list')->with(compact('CampaignData'))->with(compact('emailCollection'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeWithCampaignID(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'emailOrExcel' => 'required',
            'emailSingle' => 'required_if:emailOrExcel,emailInput',
            'excelFile' => 'required_if:emailOrExcel,emailExcel',
        ]);
        $userId = $this->userId();
        if ($id) {
            $emailCampaignCheck = emailCampaign::where( 'uid', $userId )->where('id', $id)->first();
            if (empty($emailCampaignCheck)) {
                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'] );
            }
        }
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry,'.$validator->errors() ] );
        } else {
            $emailOrExcel = $request->emailOrExcel;
            
            if ($emailOrExcel === "emailInput") {
                $emailSingle = $request->emailSingle;
                if (!empty($emailSingle )) {
                    $emailSingle = json_decode($emailSingle);
                    $compleate = 0;
                    $uncomplete = 0;
                    $alreadyHave = 0;
                    foreach ($emailSingle as $emailGet) {
                        $emailGet = $emailGet->value; 
                        if(filter_var($emailGet, FILTER_VALIDATE_EMAIL)){
                            $emailValidator = Validator::make(
                                ['email' => $emailGet],
                                ['email' => 'email:rfc,dns,strict,filter,filter_unicode']
                            );

                            if ($emailValidator->fails()) {
                                $uncomplete++;
                            }else{
                                
                                $emailAlreadyHaveCheck = ModelsEmailCollection::where( 'uid', $userId )->where('emailCampaignsId', $id)->where('email', $emailGet)->first();
                                if (empty($emailAlreadyHaveCheck )) {
                                    $failedMailCollection = failedMailCollection::where( 'uid', $userId )->where('email', $emailGet)->first();
                                    //$failedMailCollection = failedMailCollection::where( 'uid', 1 )->where('email', 'contact@sasuit.com')->first();
                                    //dd($failedMailCollection );
                                    if(empty($failedMailCollection)){
                                        $compleate++;
                                        ModelsEmailCollection::create( array(
                                            'uid'       => $userId,
                                            'emailCampaignsId'     => $id,
                                            'email'     => $emailGet,
                                        ) );
                                    }else{
                                        $uncomplete++;
                                    }
                                }else{
                                    $alreadyHave++;
                                }
                            }

                        }else{
                            $uncomplete++;
                        }
                    }
                    return response()->json( [ 'success' => 'Your Email Added Successfully ( Added: '.$compleate.') / (Not Added: '. $uncomplete.') / ( Already Added: '.$alreadyHave.')'] );
                }else{
                    return response()->json(  ['errors' => 'Sorry, Email Input Field Not Empty'] );
                }
                
            }elseif($emailOrExcel === "emailExcel"){ //emailOrExcel == emailInput Check 
                if ( $request->hasFile( 'excelFile' ) ) {
                    session()->put( 'campaignID', $id );
                    $result = Excel::import( new ImportsEmailCollection(), $request->file( 'excelFile' ) );
                    if ( Session::has( 'campaignID' ) ) {
                        Session::pull( 'campaignID' );
                    }
                    //var_dump($result);
                    //return redirect()->back()->with( 'success', 'All Email Insert Successfully!' );
                    return response()->json( [ 'success' => 'Your Email Added Successfully'] );
                }else{
                    return response()->json(  ['errors' => 'Sorry, Please Select A Excel File'] );
                }
            } 

            // Excel File undefined Check



        } // Validiti Check
       // return response()->json(  ['errors' => ' please try again .( '.$request->excelFile] );
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id){
            $delete = ModelsEmailCollection::findOrFail( $id );
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
                            $delete = ModelsEmailCollection::findOrFail( $deletedId );
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
            $data = ModelsEmailCollection::find($id);
            $data->status = 0;
            $data->save();
            return response()->json( [ 'success' => 'Your Data Deactivated Successfully' ] );
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }

    public function active($id){
        if($id){
            $data = ModelsEmailCollection::find($id);
            $data->status = 1;
            $data->save();
            return response()->json( [ 'success' => 'Your Data Activated Successfully' ] );
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }


    public function CheckCode(){


                        // Gmail IMAP server details
                        $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
                        $username = 'coexactemail@gmail.com';
                        $password = 'sqorkslwysosnkhl';
                        
                        // Server IMAP server details
                        // $hostname = '{mail.goly.link:993/imap/ssl}INBOX.spam';
                        // $username = 'check@goly.link';
                        // $password = 'check@goly.link';
                
                        // Try to connect to the Gmail IMAP server
                        $inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());

                        $mailboxes = imap_list(imap_open('{imap.gmail.com:993/imap/ssl}', $username, $password), '{imap.gmail.com:993/imap/ssl}', '*');
                        dd($mailboxes);
                
                        // Get the number of emails in the inbox
                       // $emails = imap_search($inbox, 'UNSEEN');
                        $emails = imap_search($inbox, 'ALL');
                    
                        if ($emails) {
                            // Sort emails in descending order
                            rsort($emails);
                
                            // Loop through each email
                            foreach ($emails as $email_number) {
                                // Fetch the email overview
                                $overview = imap_fetch_overview($inbox, $email_number, 0);
                                //dd($overview);
                                // Fetch the email body
                                $message = imap_fetchbody($inbox, $email_number, 1);
                
                                // Print out the email details
                                echo 'Subject: ' . $overview[0]->subject . '<br />';
                                echo 'From: ' . $overview[0]->from . '<br />';
                                echo 'Date: ' . $overview[0]->date . '<br />';
                                echo 'Message: ' . $message . '<br /><br />';
                            }
                        }
                
                        // Close the IMAP connection
                        imap_close($inbox);

    }
}