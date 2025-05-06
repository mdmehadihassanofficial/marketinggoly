<?php

namespace App\Console\Commands;

use App\Jobs\socialFacebookPagePost;
use App\Jobs\socialLinkedinPagePost;
use App\Jobs\socialLinkedinProfilePost;
use App\Jobs\socialTwitterPost;
use App\Models\socialPostManager as ModelsSocialPostManager;
use App\Models\socialTemplate;
//use App\trait\userPushNotificationSend;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Exception;

class socialPostManager extends Command
{
    //use userPushNotificationSend;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social:post-manager';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatic And Instant Social Post Manager';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $date = Carbon::parse($now)->toDateString();
        $time = Carbon::parse($now)->toTimeString();

        $socialMediaPostGetsTimeUpArray = ModelsSocialPostManager::whereDate('postDateTime', '<=', $date)->whereTime('postDateTime', '<=', $time)->where('status' , 1)->get();
        if(!empty($socialMediaPostGetsTimeUpArray)){
            foreach($socialMediaPostGetsTimeUpArray as $socialMediaPostGetTimeUp){

                try {
                    // Start Work Status Proccing update
                    $data = ModelsSocialPostManager::findOrFail($socialMediaPostGetTimeUp->id);  // Use findOrFail to handle missing records
                    $data->postStatus = 3;
                    $data->save();
                    // End Work Status Proccing update
                    $socialMediaPostGet = ModelsSocialPostManager::whereDate('postDateTime', '<=', $date)->whereTime('postDateTime', '<=', $time)->where('postStatus', 3)->first();
                    if (!empty($socialMediaPostGet)) {
                        $userId = $socialMediaPostGet->uid;
                        $socialTemplateIdArray = $socialMediaPostGet->socialTemplateId;
                        $socialMedia = $socialMediaPostGet->socialMedia;
                        $postDateTime = $socialMediaPostGet->postDateTime;
                        $socialPostManagerId = $socialMediaPostGet->id;
                        $arraySocialMedia = json_decode($socialMedia);
                        
                        foreach($arraySocialMedia as $socialMediaItem){
                            $getPages = substr($socialMediaItem, 0, 6);

                            $arraySocialTemplateId= json_decode($socialTemplateIdArray);
                            $socialTemplateIdRand = array_rand($arraySocialTemplateId, 1);
                            $socialTemplateId = $arraySocialTemplateId[$socialTemplateIdRand];

                            $getTemplateSocial = socialTemplate::select('title')->where('id', $socialTemplateId)->first();

                            if(!empty($getTemplateSocial)){
                                if ($socialMediaItem == 'Twitter') {
                                    socialTwitterPost::dispatch($userId,  $socialMediaItem, $socialPostManagerId,$socialTemplateId, $postDateTime,)->onQueue('medium');
                                    //Log::channel('social')->info('Twitter Post Found');
                                }elseif($socialMediaItem  == 'Linkedin'){
                                    socialLinkedinProfilePost::dispatch($userId, $socialMediaItem, $socialPostManagerId, $socialTemplateId, $postDateTime,)->onQueue('medium');
                                    //Log::channel('social')->info('Linkedin Post Found');
                                }elseif($getPages  == 'fbPage'){
                                    //Log::channel('social')->info('FB Page Found '.$socialMediaItem );
                                    socialFacebookPagePost::dispatch($userId, $socialMediaItem, $socialPostManagerId, $socialTemplateId, $postDateTime,)->onQueue('medium');
                                }elseif($getPages  == 'ldPage'){
                                    socialLinkedinPagePost::dispatch($userId, $socialMediaItem, $socialPostManagerId, $socialTemplateId, $postDateTime,)->onQueue('medium');
                                // Log::channel('social')->info('LinkedIn Page Found '.$socialMediaItem );
                                }
                            }else{
                                Log::channel('social')->info('Social Template Not Found ');
                            }
                        
                        }
                        $postDateTime = null;
                        $nextPostDateTime = null;
                        $totalRepeatPost = $socialMediaPostGetTimeUp->totalRepeatPost;
                        $totalRepeatPost  = $totalRepeatPost + 1;
                        $postStatus = 2;
                        if ($socialMediaPostGetTimeUp->postRepeatStatus == 1) {
                            $postStatus = 0;
                            $postDateTime = $socialMediaPostGetTimeUp->nextPostDateTime;

                            //  Start Next Post Date TIme set
                            $postRepeatType = $socialMediaPostGetTimeUp->postRepeatType;

                            if($postRepeatType == "daily"){
                                $plusRepeat = 1;
                            }elseif($postRepeatType == "weekly"){
                                $plusRepeat = 7;
                            }elseif($postRepeatType == "monthly"){
                                $plusRepeat = 30;
                            }else{
                                $plusRepeat = 0;
                            }



                            //  End Next Post Date TIme set
                            $endPostDateTime = $socialMediaPostGetTimeUp->endPostDateTime;

                            if (!empty($endPostDateTime)) {
                                $postDateTime = Carbon::parse($socialMediaPostGetTimeUp->nextPostDateTime);
                                $endPostDateTime = Carbon::parse($socialMediaPostGetTimeUp->endPostDateTime);
                                // Check if $postDateTime is earlier than $endPostDateTime
                                if ($postDateTime->lt($endPostDateTime)) {
                                    // $postDateTime is before $endPostDateTime
                                    $nextPostDateTime =  Carbon::parse($postDateTime);
                                    if($plusRepeat == 30){
                                        $nextPostDateTime->addMonth(); 
                                    }else{
                                        $nextPostDateTime->addDays($plusRepeat);  // Adds 7 days to the current date
                                    }
                                } else {
                                    // $postDateTime is the same as or later than $endPostDateTime
                                    $nextPostDateTime =  null;
                                    $postStatus = 2;
                                    $postDateTime = null;
                                }
                                
                            }else{
                                $nextPostDateTime =  Carbon::parse($postDateTime);
                                if($plusRepeat == 30){
                                    $nextPostDateTime->addMonth(); 
                                }else{
                                    $nextPostDateTime->addDays($plusRepeat);  // Adds 7 days to the current date
                                }
                            }
                        }



            
                        try {
                            // Fetch the social template data by ID
                            $data = ModelsSocialPostManager::findOrFail($socialMediaPostGet->id);  // Use findOrFail to handle missing records
                            $data->postStatus = $postStatus;
                            $data->postDateTime = $postDateTime;
                            $data->nextPostDateTime = $nextPostDateTime;
                            $data->totalRepeatPost = $totalRepeatPost;
                            $data->notificationStatus = 0;
                            $data->save();
                    
                            
                            Log::channel('social')->info('Post manager Post Status Update Successfully');
                        } catch (Exception $e) {
                            // Handle exception and return error response
                            Log::channel('social')->error('Post manager Post Status Not Update Successfully');
                            //return response()->json(['errors' => ['Sorry, an error occurred. Please try again.']]);
                        }
            
                    }// Post Manager Get Check
                } catch (Exception $e) {
                }
            } //End Foreach
        }


       
    }
}

// Log::channel('social')->error('Post Successfully');