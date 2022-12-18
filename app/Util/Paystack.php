<?php

namespace App\Util;

use Illuminate\Support\Facades\Http;

class Paystack
{
    private $baseUrl;
    private $secretKey;

    public function __construct()
    {
        $this->setBaseUrl();
        $this->setKey();
    }

    public function setKey()
    {
        $this->secretKey = env('PAYSTACK_SECRET', '');
    }

    public function setBaseUrl()
    {
        $this->baseUrl = 'https://api.paystack.co/';
    }

    public function getPaymentData($reference)
    {
        $url = $this->baseUrl.'transaction/verify/'.$reference;
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->get($url);
        return $response;
    }

    public function initiateDeposit(
        $email, $amount, $reference
    )
    {
        $callback = url("/api/v1/callback/paystack/");
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->post($this->baseUrl."transaction/initialize", [
                    'email' => $email,
                    'amount' => $amount * 100, 
                    'callback_url' => $callback,
                    'channels' => [
                        'card', 
                        'bank', 
                        'ussd', 
                        'qr', 
                        'mobile_money',
                    ],
                    'reference' => $reference,
                ]);
        return $response;
    }

    public function createTransferRecipient(
        $account, $name, $code
    )
    {
        $response = Http::acceptJson()
        ->withToken($this->secretKey)
        ->post($this->baseUrl.'transferrecipient', [
            'type' => 'nuban',
            'currency' => 'NGN',
            'account_number' => $account,
            'name' => $name,
            'bank_code' => $code,
        ]);
        return $response;
    }

    public function sendMoney(array $data)
    {
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
            ->post($this->baseUrl.'transfer', [
                'recipient' => $data['recipient'],
                'amount' => $data['amount'] * 100,
                'source' => "balance",
                'reason' => $data['reason'],
                'reference' => $data['reference']
            ]);
            return $response;
    }
    
    public function resolve(array $data)
    {
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->get($this->baseUrl."bank/resolve", $data);
        return $response;
    }

    public function getBankList()
    {
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->get($this->baseUrl.'bank', [
                    'country' => 'nigeria',
                ]);
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

    public function fetchAllTransfers()
    {
        $url = $this->baseUrl.'transfer';
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->get($url, [
                    'perPage' => '',  //default 50
                    'page' => '',   //defult 1
                    'customer' => '',   //filter by customer ID
                    'from' => '',   //A timestamp from which to start listing transfers
                    'to' => ''    //A timestamp from which to stop listing transfers
                ]);
        return $response;
    }

    public function fetchTransferData($id_or_code)
    {
        $url = $this->baseUrl.'transfer/'.$id_or_code;
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->get($url);
        return $response;
    }

    public function verifyTransfer($reference)
    {
        $url = $this->baseUrl.'transfer/verify/'.$reference;
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->get($url);
        return $response;
    }
    
    public function fetchBalance()
    {
        $url = $this->baseUrl.'balance/';
        $response = Http::acceptJson()
            ->withToken($this->secretKey)
                ->get($url);
        return $response;
    }
}