<?php

namespace App\Http\Controllers\frontend\loginRegister;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class register extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.login.sign-up');
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
            'email' => 'required|min:2|max:255',
            'password' => 'required|min:2|max:255',
            'confirm-password' => 'required|min:2|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json( [ 'errors' => $validator->errors() ] );
            // return view('view_name');
        } else {
            //$alreadyAccountCheck = User::where('email', $request->email)->first;
            $alreadyAccountCheck = User::where('email', $request->email)->first();

           // return response()->json( [ 'success' => $alreadyAccountCheck ] );
            
            //dd($alreadyAccountCheck );
           if (empty( $alreadyAccountCheck )) {              
                try {
                    $dataInsert = new User();
                    $dataInsert->email                 = $request->email;
                    $dataInsert->password          = Hash::make( $request->password );
                    $insertData                             = $dataInsert->save();
                    if ( $insertData ) {
                        return response()->json( [ 'success' => 'Customer registered successfully!' ] );
                        //return redirect()->route('login')->with( 'success', 'You are Registered Successfully' );
                    }
                } catch ( Exception $e ) {
                    //return back()->with( 'fail', 'Something wrong please try again.' );
                    return response()->json(  ['errors' => 'Sorry, looks like there are some errors detected, please try again.'.$e] );
                }
            }else{
                
                return response()->json(  ['errors' => 'Sorry, we detected you already have an account.'] );
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
        //
    }
}