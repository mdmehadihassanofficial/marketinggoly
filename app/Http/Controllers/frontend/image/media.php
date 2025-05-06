<?php

namespace App\Http\Controllers\frontend\image;

use App\Http\Controllers\Controller;
use App\Models\mediaImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Encoders\GifEncoder;
use Intervention\Image\Encoders\PngEncoder;
use Illuminate\Support\Facades\Validator;
use Exception;

use Illuminate\Support\Facades\Session;

class media extends Controller
{

    public function userId(){
        return Session::get( 'userSuccessLogined74264' );
    }
    
    public function view(){
            $userId = $this->userId();
            $mediaImage = mediaImage::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
            $totalMedia = $mediaImage->count();
            return view('frontend.media.list', compact('mediaImage', 'totalMedia'));
    }
    
    public function viewLoad(){
            $userId = $this->userId();
            $mediaImage = mediaImage::where( 'uid', $userId )->orderBy('id', 'DESC')->get();
            //dd($mediaImage);
            return view('frontend.media.load', compact('mediaImage'));
    }

    public function viewSingleLoad($id){
        $mediaImage = mediaImage::find($id);
        return response()->json($mediaImage);
    }

    public function updateSingleLoad(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        $userId = $this->userId();
        if ($validator->fails()) {
            return response()->json( [ 'errors' => 'Sorry, looks like there are some validator error detected '.$validator->errors() ] );
        } else {
            try {
                $data = mediaImage::find($id);
                $data->title = $request->title;
                $data->description = $request->description;
                $data->save();
                return response()->json( [ 'success' => 'Your Image Data Updated Successfully' ] );

            } catch ( Exception $e ) {
                return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
            }
        }
    }

//     use Illuminate\Http\Request;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;

        public function upload(Request $request){
            $userId = $this->userId();
            // Validate the request
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $uploadedImages = [];
            $image = $request->file('file');

            if ($image->isValid()) {
                // Create image manager with GD driver
                $manager = new ImageManager(new Driver());
                $compImage = $manager->read($image);
                $imageExtention = $image->getClientOriginalExtension();

                 // Compress the image with 70% quality
                 if ($imageExtention == 'png') {
                    //$encoded = $compImage->encode(new PngEncoder(10));
                    $encoded = $compImage->encode(new AutoEncoder(quality: 10));
                 }elseif ($imageExtention == 'jpg' || $imageExtention == 'jpeg') {
                    $encoded = $compImage->encode(new AutoEncoder(quality: 65));
                 }elseif($imageExtention == 'webp'){
                    $encoded = $compImage->encode(new WebpEncoder(quality: 70)); // Intervention\Image\EncodedImage
                 }elseif ($imageExtention == 'gif') {
                        $encoded = $compImage->encode(new GifEncoder()); // Intervention\Image\EncodedImage
                 }else{
                    $encoded = $compImage->encode(new AutoEncoder(quality: 65));
                 }
                
                // Generate a unique filename
                $file_name = substr(md5(mt_rand()), 0, 7) ;

                $imageFullName = $file_name. '.' . $imageExtention;
                // Save the compressed image
                file_put_contents(public_path('/uploads/media/' . $imageFullName), $encoded);
                $insertPath = "/uploads/media/" . $imageFullName;

                // Image Resize
                //$imageResize = ImageManager::imagick()->read('images/example.jpg');
                // resize to 300 x 300 pixel
                //$resizeImg = $compImage->resize(300, 300);
                $resizeImg = $compImage->crop(500, 500, 0 , 0, position: 'center-center');

                $imageThumName = $file_name. '-thum.' . $imageExtention;

                file_put_contents(public_path('/uploads/media/' . $imageThumName), $resizeImg->encode());


                try {
                    mediaImage::create( array(
                        'uid'       => $userId,
                        'imagePath'     => $insertPath,
                    ) );
                    return response()->json(['success' => true, 'images' => 'Image Upload Success']);
                } catch ( Exception $e ) {
                    return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'] );
                }

                // Save file path in response
                $uploadedImages[] = '/uploads/media/' . $imageFullName;

            } else {
                return response()->json(['errors' => ['Sorry, the image is not valid.']]);
            }

            
        }

        public function destroy($id){
            if($id){
                $delete = mediaImage::findOrFail( $id );
                if (!empty($delete->imagePath)) {
                    $imagePath = $delete->imagePath;
                    $oldImagePath = public_path($imagePath);
                    if(file_exists($oldImagePath)){
                        unlink($oldImagePath);
                    }
                    // Split the string by "."
                    $parts = explode(".", $imagePath);
                   // $firstArray = explode("/", $parts[0]);
                    $fileName =  $parts[0];
                    // Second array (after the dot)
                    $extention = $parts[1];
                    $imageThumName = $fileName. '-thum.' . $extention;
                    $imageThumNamePublicPath = public_path($imageThumName);
                    if(file_exists($imageThumNamePublicPath)){
                        unlink($imageThumNamePublicPath);
                    }
                }
                $delete->delete();
                return response()->json( [ 'success' => 'Your image has been successfully deleted.'] );    
            }else{
                return response()->json(  ['errors' => 'Something Wrong, Please Try Again'] );
            }
        }

}