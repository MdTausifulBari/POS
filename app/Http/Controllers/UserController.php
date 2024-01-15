<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\OTPMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function userRegistration(Request $request){

        try{
            $request->validate([
                'firstName' => 'required|string|max:50',
                'lastName' => 'required|string|max:50',
                'email' => 'required|string|email|max:50|unique:users,email',
                'mobile' => 'required|string|max:50',
                'password' => 'required|string|min:3',
            ]);

            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => Hash::make($request->input('password')),
            ]);

            return response()->JSON([
                'status' => "success",
                'message' => "User Registration Successful."
            ]);
        }catch(Exception $exception){
            return response()->JSON([
                'status' => "fail",
                "message" => $exception->getMessage()
            ]);    // Status code 419 -> CSRF validation failed. Comment out in the kernel in dev mode
        }
    }


    function userLogin(Request $request){

        try{

            $request->validate([
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|min:3'
            ]);

            $user = User::where('email', $request->input('email'))->first();

            if($user && Hash::check($request->input('password'), $user->password)){

                $token = $user->createToken('authToken')->plainTextToken;
/**
 * createToken() is a build-in feature (method) of Sanctum.
 * As we already configured sanctum in the User Model, we can call sanctum features/methods using User object.
 */

                return response()->JSON([
                    'status' => "success",
                    'message' => "User Login Successful.",
                    'token' => $token
                ]);

            }else{
                return response()->JSON([
                    'status' => "fail",
                    'message' => "Invalid User."
                ]);
            }

        }catch(Exception $exception){
            return response()->JSON([
                'status' => "fail",
                'message' => $exception->getMessage()
            ]);
        }

    }


    function userProfile(Request $request){
/**
        $result = Auth::id();

        $result = Auth::user();

        $result = Auth::user()['email'];

        return $result;
*/
        // return "success";

        return Auth::user();
    }


    function userLogout(Request $request){

       $request->user()->tokens()->delete();
        // return redirect('/userLogin')->with("success",'200');  // This is for postman
    }


    function profileUpdate(Request $request){

        try{
            $request->validate([
                'firstName' => 'required|string|max:50',
                'lastName'=> 'required|string|max:50',
                'mobile'=> 'required|string|min:11'
            ]);

            $user = User::where('id','=',Auth::id())->update([
                'firstName'=> $request->input('firstName'),
                'lastName'=> $request->input('lastName'),
                'mobile'=> $request->input('mobile')
            ]);

            return response()->json([
                'status'=> 'success',
                'message'=> 'Updated successfully.'
            ]);

        }catch(Exception $exception){
            return response()->json([
                'status'=> 'fail',
                'message'=> $exception->getMessage()
            ]);
        }
    }


    function sendOTP(Request $request){

        try{

            $request->validate([
                'email'=> 'required|string|email|max:50'
            ]);

            $count = User::where('email','=', $request->input('email'))->count();

            if($count == 1){
                $email = $request->input('email');
                $otp = rand(1000, 9999);
/**Laravel build-in function Mail */
                Mail::to($email)->send(new OTPMail($otp));

                User::where('email','=', $email)->update(['otp'=>$otp]);

                return response()->json([
                    'status'=> 'success',
                    'message'=> 'an otp has been sent to this email.',
                    'otp' => $otp
                ]);

            }else{
                return response()->json(['status'=>"fail", "message"=> "No user with this email registered."]);
            }
        }catch(Exception $exception){
            return response()->json([
                "status"=> "fail",
                "message"=> $exception->getMessage()
            ]);
        }
    }


    function verifyOTP(Request $request){

        try{

            $request->validate([
                "email"=> 'required|string|email|max:50',
                'otp'=> 'required|string|min:4|max:4'
            ]);

            $email = $request->input('email');
            $otp = $request->input('otp');

            $user = User::where('email','=', $email)
                        ->where('otp','=', $otp)
                        ->first();

            if($user){
                User::where('email','=', $email)
                        ->where('otp','=', $otp)
                        ->update(['otp'=>"0"]);

                $token = $user->createToken('authToken')->plainTextToken;

                return response()->json([
                    'status'=> 'success',
                    'message'=> 'user email verified.',
                    'token' => $token
                ]);
            }else{
                return response()->json([
                    'status'=> 'fail',
                    'message'=> 'user do not exist.'
                ]);
            }
        }catch(Exception $exception){
            return response()->json([
                'status'=> 'failed',
                'message'=> $exception->getMessage()
            ]);
        }
    }


    function resetPassword(Request $request){

        try{
            $request->validate([
                'password'=> 'required|string|min:3'
            ]);
/**Bearer token must be added in the request header. */
            $id = Auth::id();
            $password = $request->input('password');

            $user = User::where('id','=', $id)->update(['password'=> Hash::make($password)]);

            return response()->json([
                'status'=> 'success',
                'message'=> 'Password is updated Successfully.'
            ]);
        }catch(Exception $exception){
            return response()->json([
                'status'=> 'failed',
                'message'=> $exception->getMessage()
            ]);
        }
    }
}
