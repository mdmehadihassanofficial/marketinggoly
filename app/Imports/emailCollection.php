<?php

namespace App\Imports;

use App\Models\emailCollection as ModelsEmailCollection;
use App\Models\failedMailCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class emailCollection implements ToCollection, WithHeadingRow
{
    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $userId = $this->userId();
        // Start Code Here
        foreach ($rows as $row) 
            {
                $Semail = $row['email'];
                //$count = ModelsEmailCollection::where('cid','=',Session::get( 'campaignID' ))->count();
                //if($count < 300){
                    if(!empty($Semail)){
                        if(!filter_var($Semail, FILTER_VALIDATE_EMAIL)){
                            /*Nathing In-valid Email Address*/

                        }else{
                                $emailValidator = Validator::make(
                                    ['email' => $Semail],
                                    ['email' => 'email:rfc,dns,strict,spoof,filter,filter_unicode']
                                );
                                if ($emailValidator->fails()) {
                                    
                                }else{
                                        $data = ModelsEmailCollection::where('emailCampaignsId', Session::get( 'campaignID' ))->where('email', $Semail)->first();
                                        if(empty($data)){
                                            $failedMailCollection = failedMailCollection::where( 'uid', $userId )->where('email', $Semail)->first();
                                            if(empty($failedMailCollection)){
                                                ModelsEmailCollection::create([
                                                    'uid'       => $userId,
                                                    'emailCampaignsId'     => Session::get( 'campaignID' ),
                                                    'name' => $row['name'],
                                                    'email'    => $Semail,
                                                    'note' => $row['note'],
                                                ]);
                                            }else{
                                                /*Failde Email List Already Have*/
                                            }
                                        }else{

                                        }/*Same Campaign Email Not Insert*/
                                }
                            }
                    }else{
                        
                    }
                // }else{
                //     return redirect()->back()->with('fail', '300 Email LIMIT OUT');
                // }

            }
       
        // End Code Here
        
    }




        // $userId = $this->userId();
        // foreach ($rows as $row) 
        // {
        //     ModelsEmailCollection::create([
        //         'uid'       => $userId,
        //         'emailCampaignsId'     => Session::get( 'campaignID' ),
        //         'name' => $row['name'],
        //         'email' => $row['email'],
        //         'note' => $row['note'],
        //     ]);
        // }
    
}