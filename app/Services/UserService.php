<?php 

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\{
    ResolveAccount, 
    SavePhoto
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
    Mail
};
use App\Models\{
    User, 
    BankAccount
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

    public function updateProfilePhoto(SavePhoto $request)
    {
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
        $user = auth()->user();
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
        $account = BankAccount::where(['id' => $id])->first();
        if(!$account) return CustomResponse::error('Account not found', 404);

        $account->delete();
        return CustomResponse::success("Bank Details Deleted", null);
    }

    public function newsletter(Request $request)
    {
        DB::table('newsletter')
        ->where(['email' => auth()->user()->email])
        ->update([
            'subscribed' => $request['notify']
        ]);

        if($request['notify'] == 0):
            $message = 'You have unsubscribed from our newsletter';
        elseif($request['notify'] == 1):
            $message = 'You have subscribed for our newsletter';
        endif;
        return CustomResponse::success($message, null);
    } 

    public function getUserData($userId)
    {
        $user = User::find($userId);
        try{
            //$user = new UserResource($user);
            return CustomResponse::success("successful", $user);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
    }

    public function storeFcmToken(Request $request)
    {
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


}