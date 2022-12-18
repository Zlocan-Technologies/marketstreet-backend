<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\{
    DB
};
use App\Http\Requests\{
    ResolveAccount
};
use App\Models\{
    User, 
    Role, 
};

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function createRoles(Request $request)
    {
        foreach($request->roles as $role){
            DB::table('roles')
            ->insert([
                "name" => $role,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        return response()->json(['success'=> true]);
    }

    public function updateBankDetail(ResolveAccount $request)
    {
        return $this->userService->updateBankDetail($request);
    }

    public function fetchBanks()
    {
        return $this->userService->fetchBanks();
    }

    public function updateProfilePhoto(Request $request)
    {
        return $this->userService->updateProfilePhoto($request);
    }

    public function updateProfileData(Request $request)
    {
        return $this->userService->updateProfileData($request);
    }

    public function getBankDetails()
    {
        return $this->userService->getBankDetails();
    }

    public function deleteBankDetail($id)
    {
        return $this->userService->deleteBankDetail($id);
    }

    public function emailNotification(Request $request)
    {
        return $this->userService->emailNotification($request);
    }

    public function pushNotification(Request $request)
    {
        return $this->userService->pushNotification($request);
    }

    public function getUserData($userId)
    {
        return $this->userService->getUserData($userId);
    }

    public function storeFcmToken(Request $request)
    {
        return $this->userService->storeFcmToken($request);
    }

    public function sendPushNotification(Request $request)
    {
        return $this->userService->sendPushNotification($request);
    }

    public function fetchReports($userId)
    {
        return $this->userService->fetchReports($userId);
    }

    public function fetchStates()
    {
        return $this->userService->fetchStates();
    }
    
}
