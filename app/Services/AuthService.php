<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Util\CustomResponse;
use App\Http\Requests\{
    LoginRequest,
    VerifyAccount, 
    ResetPassword, 
    CreateUser, 
    PasswordReset as PassReset
};
use App\Mail\{
    VerifyAccountMail, 
    ResetPasswordMail
};
use Illuminate\Support\Facades\{
    DB, 
    Mail, 
    Hash, 
    Http
};
use App\Actions\Fortify\{
    CreateNewUser, 
    ResetUserPassword
};
use App\Models\{
    User, 
    PasswordReset
};

class AuthService
{
    public function login(LoginRequest $request)
    {
        try{
            $user = User::where("email", $request->email)->first();
            if(!$user || !password_verify($request->password, $user->password)):
                $message = "Wrong credentials";
                return CustomResponse::error($message, 400);
            elseif(!$user->email_verified_at):
                $message = "Email address not verified, please verify your email before you can login";
                return CustomResponse::error($message, 401);
            endif;
            
            $token = $user->createToken("Peddle")->plainTextToken;
            $user->token = $token;
            $message = 'Login successfully';
            return CustomResponse::success($message, $user);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
    }

    public function register(CreateUser $request)
    {
        try{
            $createUser = new CreateNewUser;
            $user = $createUser->create($request->input());

            /*$token = $user->createToken("MarketStreet")->plainTextToken;
            $user->token = $token;*/
            
            $verification_code = mt_rand(1000, 9999);
            
            $check = DB::table('user_verification')->where(
                'email',$user->email)->first();
            
            if($check):
                DB::table('user_verification')->where(
                'email',$user->email)
                ->update([
                    'email' => $user->email, 
                    'code' => $verification_code, 
                    'expiry_time' => Carbon::now()->addMinutes(6)
                ]);
            else:
                DB::table('user_verification')
                ->insert([
                    'email' => $user->email, 
                    'code' => $verification_code, 
                    'expiry_time' => Carbon::now()->addMinutes(6)
                ]);
            endif;
            
            
            Mail::to($user->email)
                ->send(new VerifyAccountMail($user, $verification_code));
                
        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }

        $message = 'Thanks for signing up! Please check your email to complete your registration.';
        return CustomResponse::success($message, $user, 201);
    }
    
    public function sendverificationcode(Request $request)
    {
     
        try{
     
            $user = User::where(['email' => $request['email']])->first();
            $code = mt_rand(1000, 9999);
            
            //return $code;

            DB::table('user_verification')->where('email',$request->email)
            ->update([
                    'code' => $code, 
                    'expiry_time' => Carbon::now()->addMinutes(6)
                ]);

            Mail::to($user->email)
                ->send(new VerifyAccountMail($user, $code));
                
        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
        
        return CustomResponse::success("A new verification code has been sent to your email.", null);
    }
    
    
    public function verifyUser(VerifyAccount $request)
    {
        $check = DB::table('user_verification')
        ->where([
            'email' => $request['email'], 
            'code' => $request['code']
        ])->first();
        $current_time = Carbon::now();
        try{
            switch(is_null($check)):
                case(false):
                    if($check->expiry_time < $current_time):
                        $message = 'Verification code is expired';
                    else:
                        $user = User::where(['email' => $check->email])->first();
                        $user->email_verified_at = $current_time;
                        $user->save();

                        DB::table('user_verification')
                        ->where('code', $request['code'])->delete();

                        $message = 'Your email address is verified successfully.';
                        return CustomResponse::success($message, null);
                    endif;
                break;
                default:
                    $message = "The code you entered is incorrect. Please enter the correct code and retry";
            endswitch;
        }catch(\Exception $e){
            $error_message = $e->getMessage();
            return CustomResponse::error($error_message);
        }
    }
    
    

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return CustomResponse::success("User has been logged out", null);
    }

    public function refresh()
    {
        $user = auth()->user();

        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });

        $token = $user->createToken("Peddle")->plainTextToken;
        return CustomResponse::success("token refreshed successfully", $token);
    }

    public function verifyEmail(VerifyAccount $request)
    {
        $check = DB::table('user_verification')
        ->where([
            'email' => $request['email'], 
            'code' => $request['code']
        ])->first();
        
        if(!is_null($check)):
            $user = User::where(['email' => $check->email])->first();
            $user->email_verified_at = Carbon::now();
            $user->save();

            DB::table('user_verification')
            ->where(['email' => $request['email']])
            ->delete();

            $message = 'Your email address is verified successfully.';
            return view('auth.email-verification-success', ['user' => $user ]);
        endif;
    }

    public function resetPassword(ResetPassword $request)
    {
        $user = User::where(['email' => $request['email']])->first();
        $token = mt_rand(1000, 9999);
        $expiry_time = Carbon::now()->addMinutes(6);

        try{
            PasswordReset::updateOrCreate([
                'email' => $user->email
            ],[
                'token' => $token,
                'expiry_time' => $expiry_time
            ]);
            $message = 'A password reset email has been sent! Please check your email.';    

            Mail::to($user->email)
                ->send(new ResetPasswordMail($user, $token));
        }catch(\Exception $e){
            $error_message = $e->getMessage();
            return CustomResponse::error($error_message);
        }

        return CustomResponse::success($message, null);
    }

    public function verifyResetToken(Request $request)
    {
        $validator = Validator::make($request, [
            'email' => 'required|email',
            'token' => 'required|numeric|exists:password_resets'
        ]);

        $tokenedUser = DB::table('password_resets')
        ->where([
            'token' => $request['token'], 
            'email' => $request['email']
        ])->first();

        if(!is_null($tokenedUser)):
            if($tokenedUser->expiry_time > Carbon::now()):
                return view('auth.password-reset', [
                    'email' => $request['email'],
                    'token' => $request['token']
                ]);
            endif;
        endif;
    }

    public function passwordReset(PassReset $request)
    {   
        try{
            $user = User::where(['email' => $request->email])->first();
            $resetUser = new ResetUserPassword;
            $reset = $resetUser->reset($user, $request->input());

            $message = 'Your password has been changed!';
        }catch(\Exception $e){
            $error_message = $e->getMessage();
            return CustomResponse::error($error_message);
        }

        return CustomResponse::success($message, null);
    }
    
    public function saveFCMToken(Request $request)
    {
        $user = auth()->user();
        try{
            DB::table('users')->where(['id'=> $user->id])
            ->update([
                'fcm_token' => $request->token
            ]);
            $message = 'FCM token updated successfully';
        }catch(\Exception $e){
            $error_message = $e->getMessage();
            return CustomResponse::error($error_message);
        }
        return CustomResponse::success($message, null);
    }

}
