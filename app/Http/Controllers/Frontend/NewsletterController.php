<?php

namespace App\Http\Controllers\Frontend;

use App\Helper\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionVerification;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function newsLetterRequset(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $existSubscriber = NewsletterSubscriber::where('email', $request->email)->first();

        if(!empty($existSubscriber)){
            if($existSubscriber->is_verified == 0){
                $existSubscriber->verified_token = \Str::random(25);
                $existSubscriber->save();
                // set mail config
                MailHelper::setMailConfig();
                // send mail
                Mail::to($existSubscriber->email)->send(new SubscriptionVerification($existSubscriber));

                return response(['status' => 'success', 'message' => 'Liên kết xác minh đã được gửi đến email của bạn, vui lòng kiểm tra']);

            }elseif($existSubscriber->is_verified == 1){
                return response(['status' => 'error', 'message' => 'Bạn đã đăng ký với email này!']);
            }
        }else {
            $subscriber = new NewsletterSubscriber();
            $subscriber->email = $request->email;
            $subscriber->verified_token = \Str::random(25);
            $subscriber->is_verified = 0;
            $subscriber->save();

            // set mail config
            MailHelper::setMailConfig();

            // send mail
            Mail::to($subscriber->email)->send(new SubscriptionVerification($subscriber));

            return response(['status' => 'success', 'message' => 'Liên kết xác minh đã được gửi đến email của bạn, vui lòng kiểm tra']);
        }



    }

    public function newsLetterEmailVarify($token)
    {
       $verify = NewsletterSubscriber::where('verified_token', $token)->first();
       if($verify){
            $verify->verified_token = 'verified';
            $verify->is_verified = 1;
            $verify->save();
            toastr('Xác minh email thành công', 'success', 'success');
            return redirect()->route('home');
       }else {
            toastr('Mã không hợp lệ', 'error', 'Error');
            return redirect()->route('home');
       }
    }
}
