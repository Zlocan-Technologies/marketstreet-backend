<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;
use App\Services\FCMService;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminUserNotification;
use App\Models\Admin;
use App\Models\User;
// use App\Notifications\sendAdminPushNotification;


class NotificationService
{

    public $message;
    public $notify_type;
    public $subject;
    public $recipient;

    public function __construct($message, $notify_type, $subject = '', $recipient = ''){
        $this->notify_type = $notify_type;
        $this->message = $message;
        $this->subject = $subject;
        $this->recipient = $recipient;
    }


  public function sendNotification(){
    if($this->notify_type == 'email'){
        $this->unBlockedUsersMailNotify($this->subject, $this->recipient);
        $admins = Admin::all();
        //send notfication
         Notification::send($admins, new AdminUserNotification('Mail Sent','your mail has been sent successfully!'));

    }

    if($this->notify_type == 'notification'){
        $this->unBlockedUsersFcmNotification($this->recipient);
        Notification::send($admins, new AdminUserNotification('Notification Sent','your notification has been sent successfully!'));
    }

    return 'sent';
  }
  
  public function unBlockedUsersMailNotify($subject, $recipient){
     //send email notifications
    if(empty($recipient)){
        $emails = User::where('isBlocked', false)->pluck('email')->toArray();
        Mail::to($emails)->send(new NewsletterMail($subject, $this->message));
    }else{
        $emails = User::where('email', $recipient)->pluck('email')->toArray();
        Mail::to($emails)->send(new NewsletterMail($subject, $this->message));
    } 
  }

  public function blockedUsersMailNotify($subject, $recipient){
        //send email notifications
     if($this->notify_type == 'email'){
        if(empty($recipient)){
            $emails = User::where('isBlocked', true)->pluck('email')->toArray();
            Mail::to($emails)->send(new NewsletterMail($subject, $this->message));
        }else{
            $emails = User::where('email', $recipient)->pluck('email')->toArray();
            Mail::to($emails)->send(new NewsletterMail($subject, $this->message));
        } 
    }
  }


  public function unBlockedUsersFcmNotification($recipient){
    if(empty($recipient)){
        $users = User::where('isBlocked', false)->get();
        foreach ($users as $user) {
            $fcm = new FCMService();
            $fcm->send($user->getFcmToken(), $this->message);
        }
    }else{
        $user = User::where('email', $recipient)->first();
        $fcm = new FCMService();
        $fcm->send($user->getFcmToken(), $this->message);
    }
    return $fcm;
  }

  public function blockedUsersFcmNotification($recipient){
    if(empty($recipient)){
        $users = User::where('isBlocked', true)->get();
        foreach ($users as $user) {
            $fcm = new FCMService();
            $fcm->send($user->fcm_token, $this->message);
        }
    }else{
        $user = User::where('email', $recipient)->get();
        $fcm = new FCMService();
        $fcm->send($user->fcm_token, $this->message);
    }
    return $fcm;
  }


//   public static function sendAdminNotification($title, $message){
//    try {
//         $fcmTokens = Admin::whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
//         //Notification::send(null,new SendPushNotification($request->title,$request->message,$fcmTokens));

//         /* or */

//         auth()->guard('admin')->user()->notify(new SendPushNotification($title,$message,$fcmTokens));

//         /* or */

//         // Larafirebase::withTitle($request->title)
//         //     ->withBody($request->message)
//         //     ->sendMessage($fcmTokens);

//         return response()->json([
//             'message' => 'Notification Sent Successfully!!'
//         ]);
//     } catch (\Throwable $th) {
//         throw $th;
//     }
// }

}