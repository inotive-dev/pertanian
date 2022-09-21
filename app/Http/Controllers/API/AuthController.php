<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use App\Mail\EmailResetPassword;
use Mail;

class AuthController extends Controller
{
    public function notAuthenticated(Type $var = null)
    {
        return response()->json([
            'statusCode' => 401,
            'message' => 'unauthorized'
        ], 401);
    }

    public function checkEmailAvailableUser($email)
    {
        $dataUser = User::where('email', $email)->first();
        if ($dataUser) {
            return response()->json([
                'statusCode' => 400,
                'message' => 'email already used'
            ], 400);
        } else {
            return response()->json([
                'statusCode' => 200,
                'message' => 'email can be used'
            ], 200);
        }
    }

    public function loginValidate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'email|required',
                'password' => 'string|required',
            ]
        );

        if ($validator->fails()) {
            // dd($allError[0]);
            foreach ($validator->errors()->all() as $key => $value) {
                $errors[] = $value;
            }

            return response()->json([
                'statusCode' => 400,
                'message' => 'Bad request',
                'error' => $errors
            ], 400);
        }

        $checkEmail = $this->checkEmailAvailableUser($request->email);
        if ($checkEmail->getData()->statusCode == 200) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Akun anda tidak terdaftar'
            ], 404);
        }

        $validate = $request->only('email', 'password');

        if (Auth::attempt($validate)) {
            $user = User::where('id', Auth::user()->id)->first();
            $token = $user->createToken('token-name')->plainTextToken;

            return response()->json([
                'statusCode' => 200,
                'message' => 'Login berhasil',
                'data' => $user,
                'accessToken' => $token,
                'tokenType' => 'Bearer'
            ], 200);
        } else {
            return response()->json([
                'statusCode' => 4001,
                'data' => $validate,
                'message' => 'Salah password'
            ], 400);
        }
    }

    public function forgetPassword(Request $request)
    {
        $checkUser = User::where('email',$request->email)->first();
        if (!$checkUser) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Akun anda tidak terdaftar'
            ], 404);
        }
        $checkUser->update([
            'otp' => $this->createOTP()
        ]);

        $data['user'] = $checkUser;
        $data['otp'] = $checkUser->otp;
        // dd($checkUser->email);
        Mail::to($checkUser->email)->send(new EmailResetPassword($data));
        return response()->json([
            'statusCode' => 201,
            'message' => 'Silahkan cek email anda!'
        ], 201);
    }

    public function createOTP(){
        $resetToken = rand(11111,99999);
        $checkData = User::where('otp',$resetToken)->first();
        if($checkData){
           $this->createOTP();
        } else {
            return $resetToken;
        }
    }
    
    public function checkOTP(Request $request) {
        $checkData = User::where('otp',$request->otp)->first();
        if(!$checkData){
            return response()->json([
                'statusCode' => 404,
                'message' => 'OTP tidak terdaftar!'
            ], 404);
        } else {
            return response()->json([
                'statusCode' => 200,
                'message' => 'OTP dapat digunakan'
            ], 200);
        }
    }
    
    public function resetPassword(Request $request) {
        $user = User::where('otp',$request->otp)->first();
        if(!$user){
            return response()->json([
                'statusCode' => 404,
                'message' => 'OTP tidak terdaftar!'
            ], 404);
        }
        $user->update([
            'password' => bcrypt($request->password),
            'otp' => null
        ]);
    
        return response()->json([
            'statusCode' => 201,
            'message' => 'Password berhasil diupdate'
        ], 201);
        
    }
}
