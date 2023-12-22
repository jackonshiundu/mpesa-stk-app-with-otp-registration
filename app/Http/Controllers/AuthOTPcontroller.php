<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Helpers\TwilioHelper;

class AuthOTPcontroller extends Controller
{
   public function login(){
        return view('auth.otp-login');
    }
    //generate otp
   public function generate(Request $request){
        $request->validate([
            'mobile_no'=>'required|exists:users,phonenumber'
        ]);


        $verificationCode = $this->generateOTP($request->mobile_no);


        $message='Your OTP To Login is - '.$verificationCode->otp;

        sendSms($request->mobile_no, $message);

        return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success', 'OTP Has been sent to your phone please enter to login');
    }

    public function generateOTP($mobile_no){
        $user=User::where('phonenumber',$mobile_no)->first();

        $verificationCode=VerificationCode::where('user_id',$user->id)->latest()->first();
         $now = Carbon::now();

         if($verificationCode &&  $now->isBefore($verificationCode->expires_at )){
            return $verificationCode;
         }

        return verificationcode::create([
            'user_id'=>$user->id,
            'otp'=> rand(123456,999999),
            'expires_at'=>Carbon::now()->addMinutes(10)
        ]);
    }
    public function verification($user_id)
        {
            return view('auth.otp-verification')->with(['user_id'=>$user_id]);
        }
    public function otplogin(Request $request)
        {
            $request->validate(['user_id'=>'required|exists:users,id','otp'=>'required']); 

            $verificationCode=VerificationCode::where('user_id',$request->user_id)->where('otp',$request->otp)->first();

            $now = Carbon::now();

            if (!$verificationCode) {
                 return redirect()->back()->with('error', 'Your OTP Number is not correct');
            } elseif ($verificationCode && $now->isAfter($verificationCode->expires_at)) {
                return redirect()->route('otp.login')->with('error', 'Your OTP has Expired');
            }
                $user=User::whereId($request->user_id)->first();
            if($user){
                //expire the OTP
                $verificationCode->update([
                    'expires_at'=>Carbon::now()
                ]);
                Auth::login($user);
                return redirect('/home');
            }
            return $redirect()->route('otp.login')->with('error','Your OTP is not correct');
        }
}
