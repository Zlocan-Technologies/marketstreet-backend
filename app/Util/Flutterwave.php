<?php

namespace App\Util;

use Illuminate\Support\Facades\Http;
use App\Models\User;

class Flutterwave
{
    private $baseUrl;
    private $secretKey;
    private $secretHash;

    public function __construct()
    {
        // $this->secretKey = env('FLW_SECRET_KEY', '');
        $this->secretKey = config('admin.flw_secret_key');

        $this->baseUrl = 'https://api.flutterwave.com/v3/';
        // $this->secretHash = env('FLW_SECRET_HASH', '');
        $this->secretKey = config('admin.flw_secret_hash');

    }

    public function initializePayment(User $user, array $data)
    {
        $redirect_url = url("/api/v1/callback/flutterwave/");
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->post($this->baseUrl."payments/", [
                    'tx_ref' => $data['tx_ref'],
                    'amount' => $data['amount'],
                    'currency' => 'NGN',
                    'redirect_url' => $redirect_url,
                    'customer' => [
                        'email' => $user->email,
                        'name' => $user->firstname.' '.$user->lastname
                    ],
                    'meta' => [
                        'user_id' => $user->id
                    ],
                    'customizations' => [
                        'title' => 'MarketStreet Payments',
                        'logo' => 'https://',
                        'description' => ''
                    ]
                ]);
        return $response;
    }

    public function generateReference(String $transactionPrefix = NULL)
    {
        if($transactionPrefix):
            return $transactionPrefix . '_' .uniqid(time());
        endif;
        return 'mks' . uniqid(time());
    }

    public function verifyWebhook()
    {
        if(request()->header('verif-hash')):
            //get input and verify paystack signature
            $flutterwaveSignature = request()->header('verif-hash');
            //confirm the signature is right
            if($flutterwaveSignature == $this->secretHash):
                return true;
            endif;
        endif;
        return false;
    }

    public function getTransactionIdFromCallback()
    {
        $transactionID = request()->transaction_id;

        if(!$transactionID):
            $transactionID = json_encode(request()->resp)->data->id;
        endif;
        
        return $transactionID;
    }

    /**
    * Reaches out to flutterwave to verify a transaction
    */
    public function verifyTransaction($id)
    {
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->get($this->baseUrl."transactions/".$id."/verify");
        return $response;
    }

    public function createTransferRecipient(array $data)
    {
        $response = Http::acceptJson()
        ->withToken($this->secretKey)
        ->post($this->baseUrl.'transfers', [
            'currency' => 'NGN',
            'account_number' => $account,
            'reference' => $reference,
            'account_name' => $code,
            'account_bank' => $code,
            'amount' => $amount,
            'narration' => 'Payment for things',
            'beneficiary_name' => 'Itua Osemeilu',
            'callback_url' => '',
            'meta' => [
                'mobile_number' => '',
                'email' => '',
                'beneficiary_country' => '',
            ]
        ]);
        return $response;
    }

    public function getBankList()
    {
        $country = 'NG';  // other supported countries are GH, KE, UG, ZA, TZ
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->get($this->baseUrl.'banks/'.$country);
        return $response;
    }

    public function getBank($code)
    {
        $response = $this->getBankList();
        $data = $response['data'];
        foreach($data as $array):
            if($array["code"] == $code):
                $bank = $array["name"];
            endif;
            global $bank;
        endforeach;
        return $bank;
    }

    public function fetchBillCategories()
    {
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->get($this->baseUrl.'/bill-categories/', [

                ]);
        return $response;
    }
}