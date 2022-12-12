<?php 

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\FCMService;
use App\Http\Requests\{
    ResolveAccount,
};
use App\Http\Resources\BankResource;
use App\Util\{
    CustomResponse,
    Paystack, 
    Flutterwave
};
use Illuminate\Support\Facades\{
    DB, 
    Http, 
    Crypt, 
    Hash, 
    Mail,
    Validator
};
use App\Models\{
    User, 
    BankAccount,
    EmailNotification,
    PushNotification,
    State
};

class UserService
{
    public function updateBankDetail(ResolveAccount $request)
    {
        $user = auth()->user();
        try{
            $paystack = new Paystack;
            $response = $paystack->resolve(
                [
                    'account_number' => $request['account_number'],
                    'bank_code' => $request['bank_code']
                ]
            );
            
            if($response['status'] == true):
                $bank = $paystack->getBank($request['bank_code']);
                
                $account = $user->bankDetail()->updateOrCreate([
                    'user_id' => $user->id
                ],[
                    'bank_code' => $request['bank_code'],
                    'bank_name' => $bank,
                    'account_number' => $response['data']["account_number"],
                    'account_name' => $response['data']["account_name"]
                ]);
                
                return CustomResponse::success($response['message'], $account);
            else:
                return CustomResponse::error($response['message'], 422);
            endif;

        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
    }

    public function fetchBanks()
    {
        try{
            $paystack = new Paystack;
            $response = $paystack->getBankList();
            
            $data = BankResource::collection($response["data"]);
            return CustomResponse::success('successful', $data);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
    }

    public function updateProfilePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|mimes:jpeg,jpg,png,svg|max:2048'
        ]);
        if($validator->fails()):
            return response([
                'message' => $validator->errors()->first(),
                'error' => $validator->getMessageBag()->toArray()
            ], 422);
        endif;

        $user = auth()->user();
        $photo = $user->photo;
        if($photo):
            $parts = explode('/', $photo);
            $count = count($parts);
            $publicId = explode('.', $parts[$count - 1]);
            $response = \Cloudinary\Uploader::destroy($publicId[0]);
        endif;
        try{
            if($request->hasFile('photo')):
                $photo = $request->file('photo');
                $response = \Cloudinary\Uploader::upload($photo);
                $url = $response["url"];
                $user->photo = $url;
                $user->save();
            endif;
            
            return CustomResponse::success("Profile photo path:", $url);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
    }

    public function updateProfileData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user.firstname' => 'required|string',
            'user.lastname' => 'required|string',
            'user.phone' => ['required', 'numeric', 'min:11'],
            'profile.address' => ['string'],
            'profile.state' => ['string']
        ]);
        if($validator->fails()):
            return response([
                'message' => $validator->errors()->first(),
                'error' => $validator->getMessageBag()->toArray()
            ], 422);
        endif;

        $user = auth()->user();
        $check = User::where('phone', $request['user']['phone'])->first();
        if($check):
            if($user->id !== $check->id):
                $message = "phone number has been used";
                return CustomResponse::error($message, 400);
            endif;
        endif;

        $user->firstname = $request["user"]["firstname"];
        $user->lastname = $request["user"]["lastname"];
        $user->phone = $request["user"]["phone"];
        $user->save();

        $user->profile()->update([
            'address' => $request["profile"]["address"],
            'state' => $request["profile"]["state"]
        ]);
        
        $message = "Profile updated Successfully";
        return CustomResponse::success($message, $user->fresh());
    }

    public function getBankDetails()
    {
        $bank = auth()->user()->bankDetail;
        
        try{
            if(!$bank):
                $message = "Account Details not found";
                return CustomResponse::success($message, null, 404);
            endif;
            return CustomResponse::success('Bank Account Details:', $bank);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
    }

    public function deleteBankDetail($id)
    {
        $validator = Validator::make([
            'id' => $id,
        ], [
            'id' => 'required|integer',
        ]);
        if($validator->fails()):
            return response([
                'message' => $validator->errors()->first(),
                'error' => $validator->getMessageBag()->toArray()
            ], 422);
        endif;

        $account = BankAccount::where(['id' => $id])->first();
        if(!$account) return CustomResponse::error('Account not found', 404);

        $account->delete();
        return CustomResponse::success("Bank Details Deleted", null);
    }

    public function emailNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notify' => 'required|integer',
        ]);
        if($validator->fails()):
            return response([
                'message' => $validator->errors()->first(),
                'error' => $validator->getMessageBag()->toArray()
            ], 422);
        endif;
        
        $user = auth()->user();
        $notify = EmailNotification::find($user->email);
        $notify->is_subscribed = $request['notify'];
        $notify->save();

        if((int)$request['notify'] === 0):
            $message = 'You have unsubscribed from our email notifications';
        elseif((int)$request['notify'] === 1):
            $message = 'You have subscribed for our email notifications';
        endif;
        return CustomResponse::success($message, null);
    } 

    public function pushNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notify' => 'required|integer',
        ]);
        if($validator->fails()):
            return response([
                'message' => $validator->errors()->first(),
                'error' => $validator->getMessageBag()->toArray()
            ], 422);
        endif;

        $user = auth()->user();
        $notify = PushNotification::find($user->id);
        $notify->is_subscribed = $request['notify'];
        $notify->save();

        if((int)$request['notify'] === 0):
            $message = 'You have unsubscribed from our push notifications';
        elseif((int)$request['notify'] === 1):
            $message = 'You have subscribed for our push notifications';
        endif;
        return CustomResponse::success($message, null);
    } 

    public function getUserData($userId)
    {
        $validator = Validator::make([
            'userId' => $userId,
        ], [
            'userId' => 'required|integer',
        ]);
        if($validator->fails()):
            return response([
                'message' => $validator->errors()->first(),
                'error' => $validator->getMessageBag()->toArray()
            ], 422);
        endif;

        try{
            $user = User::find($userId);
            //$user = new UserResource($user);
            return CustomResponse::success("successful", $user);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
    }

    public function storeFcmToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);
        if($validator->fails()):
            return response([
                'message' => $validator->errors()->first(),
                'error' => $validator->getMessageBag()->toArray()
            ], 422);
        endif;

        $user = auth()->user();
        try{
            $user->fcm_token = $request['token'];
            $user->save();

            $message = 'FCM token updated successfully';
        }catch(\Exception $e){
            $error_message = $e->getMessage();
            return CustomResponse::error($error_message);
        }
        return CustomResponse::success($message, null);
    }

    public function sendPushNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiver' => 'required|integer',
            'title' => 'required|string',
            'body' => 'required|string',
            'route' => 'required|string'
        ]);
        if($validator->fails()):
            return response([
                'message' => $validator->errors()->first(),
                'error' => $validator->getMessageBag()->toArray()
            ], 422);
        endif;

        $receiver = User::find($request['receiver']);
        $notify = PushNotification::find($receiver->id);
        if($notify):
            FCMService::send(
                $receiver->fcm_token,
                [
                    'title' => $request['title'],
                    'body' => $request['body'],
                    'route' => $request['route']
                ]
            );
            return CustomResponse::success('notification has been sent', null);
        endif;
    }

    public function fetchReports($userId)
    {
        $validator = Validator::make([
            'userId' => $userId,
        ], [
            'userId' => 'required|integer',
        ]);
        if($validator->fails()):
            return response([
                'message' => $validator->errors()->first(),
                'error' => $validator->getMessageBag()->toArray()
            ], 422);
        endif;

        //$user = auth()->user();
        $user = User::find($userId);
        $profile = $user->profile->makeVisible([
            'orders',
            'sales',
            'customers',
            'reviews',
            'customers_count'
        ]);
        $report = [
            'orders' => $profile->orders,
            'sales' => $profile->sales,
            "customers" => $profile->customers_count,
            "reviews" => $profile->reviews
        ];
        return CustomResponse::success("Report:", $report);
    }

    public function fetchStates()
    {
        $states = State::all();
        return CustomResponse::success("States:", $states);
    }

}