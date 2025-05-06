<?php

namespace App\Http\Controllers\frontend\loginRegister;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class login extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.login.sign-in');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|min:2|max:255',
            'password' => 'required|min:2|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json( [ 'errors' => $validator->errors() ] );
            // return view('view_name');
        } else {
            //$alreadyAccountCheck = User::where('email', $request->email)->first;
            $userData = User::where('email', $request->email)->first();

           // return response()->json( [ 'success' => $alreadyAccountCheck ] );
            
            //dd($alreadyAccountCheck );
           if (!empty( $userData )) {        
            
                if ( Hash::check( $request->password, $userData->password ) ) {
                    $request->session()->put( 'userSuccessLogined74264', $userData->id );
                    //return redirect()->route('user.dashboard');
                    return response()->json( [ 'success' => 'Login successful! Welcome back!' ] );
                } else {
                   // return back()->with( 'fail', 'Passwoard Not Match' );
                    return response()->json(  ['errors' => 'Passwoard Not Match'] );
                }

            }else{
                
                return response()->json(  ['errors' => 'Sorry, User not found. Please check your details and try again.'] );
            }
            
        }
    }


    /**
     * Display User Logout
     */
    public function logout()
    {       
        if(Session::has('userSuccessLogined74264')){
            Session::pull('userSuccessLogined74264');
            return to_route('login');
        }
    }

    
}