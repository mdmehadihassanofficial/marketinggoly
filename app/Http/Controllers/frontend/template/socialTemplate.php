<?php

namespace App\Http\Controllers\frontend\template;

use App\Http\Controllers\Controller;
use App\Models\socialTemplate as ModelsSocialTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;

class socialTemplate extends Controller
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
        $allSocialTemplate = ModelsSocialTemplate::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
        return view('frontend.template.socialList', compact('allSocialTemplate'));
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
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'postMessage' => 'required|string|min:10|max:2150',
            'postMessageShort' => 'required|string|min:10|max:250',
        ]);
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            // Start Image Upload
            // Image File Code Start here
                $image    = $request->file('postImage');

                if(!empty($image)){
                    if ($image->isValid()) {
                        $file_name =  substr(md5(mt_rand()), 0, 7).'.'.$image->getClientOriginalExtension();
                        $request->postImage->move(public_path('/uploads/social/'), $file_name);
                        //$image->storeAs('social', $file_name, ['disk' => 'public']);
                        $insertLink = '/uploads/social/'.$file_name;
                    }else{
                        return response()->json(  ['errors' => 'Sorry, Image not valid.'] );
                    }
                    
                }elseif(empty($image)){
                    $insertLink = 'imageNotSet';
                }
             // Image File Code End  Here
            // End Image Upload
            try {
                ModelsSocialTemplate::create( array(
                    'uid'       => $userId,
                    'title'     => $request->title,
                    'postMessage'     => $request->postMessage,
                    'postMessageShort'     => $request->postMessageShort,
                    'postImage'     => $insertLink,
                ) );
                return response()->json( [ 'success' => 'Your Social Template Added Successfully' ] );
            } catch ( Exception $e ) {
                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
            }
            //return response()->json( [ 'success' => 'Your Email Template Added Successfully'.$request->postMessage.' '.$request->title ] );
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
        $single = ModelsSocialTemplate::find($id);
        return response()->json($single);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        //return response()->json(['errors' => 'Your Social Template Updated Successfully'. $request->titleUpdate.'I am End']);
        // Validate the request input
        $validator = Validator::make($request->all(), [
            'titleUpdate' => 'required|string|max:255',
            'postMessageUpdate' => 'required|string|min:10|max:2150',
            'postMessageShortUpdate' => 'required|string|min:10|max:250',
            //'postImageUpdate' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  // Optional image validation
        ]);
    
        if ($validator->fails()) {
            // Return validation errors as a JSON array
            return response()->json(['errors' => $validator->errors()->all()]);
        }
    
        // Handle image upload
        $image = $request->file('postImageUpdate');
        $insertLink = 'imageNotSet';  // Default value if no image is uploaded
    
        if ($image) {
            if ($image->isValid()) {
                // Generate a unique filename for the image
                $file_name = substr(md5(mt_rand()), 0, 7) . '.' . $image->getClientOriginalExtension();
                // Move the image to the uploads folder
                $image->move(public_path('/uploads/social/'), $file_name);
                $insertLink = '/uploads/social/' . $file_name;
            } else {
                return response()->json(['errors' => ['Sorry, the image is not valid.']]);
            }

            $postFind = ModelsSocialTemplate::findOrFail($id);
            if (!empty($postFind->postImage)) {
                $oldImagePath = public_path($postFind->postImage);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
        }
    
        try {
            // Fetch the social template data by ID
            $data = ModelsSocialTemplate::findOrFail($id);  // Use findOrFail to handle missing records
            $data->title = $request->titleUpdate;
            $data->postMessage = $request->postMessageUpdate;
            $data->postMessageShort = $request->postMessageShortUpdate;
    
            // Only update postImage if a new one is uploaded
            if ($image) {
                $data->postImage = $insertLink;  
            }
    
            $data->save();
    
            // Return success response
            return response()->json(['success' => 'Your Social Template Updated Successfully']);
        } catch (Exception $e) {
            // Handle exception and return error response
            return response()->json(['errors' => ['Sorry, an error occurred. Please try again.']]);
        }
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if($id){
            $delete = ModelsSocialTemplate::findOrFail( $id );
            if (!empty($delete->postImage)) {
                $oldImagePath = public_path($delete->postImage);
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
            $delete->delete();
            return response()->json( [ 'success' => 'Your data has been successfully deleted.'] );    
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }

    public function deactive($id){
        if($id){
            $data = ModelsSocialTemplate::find($id);
            $data->status = 0;
            $data->save();
            return response()->json( [ 'success' => 'Your Email Template Deactivated Successfully' ] );
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }

    public function active($id){
        if($id){
            $data = ModelsSocialTemplate::find($id);
            $data->status = 1;
            $data->save();
            return response()->json( [ 'success' => 'Your Email Template Activated Successfully' ] );
        }else{
            return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
        }
    }

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
                    $delete = ModelsSocialTemplate::findOrFail( $deletedId );
                    if (!empty($delete->postImage)) {
                        $oldImagePath = public_path($delete->postImage);
                        if(file_exists($oldImagePath)){
                            unlink($oldImagePath);
                        }
                    }
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
}