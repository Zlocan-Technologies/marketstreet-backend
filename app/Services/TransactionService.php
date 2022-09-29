<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\WalletResource;
use App\Util\{CustomResponse, Paystack, Flutterwave, Helper};
use App\Models\{Transaction, User};
//use App\Http\Requests\{TransferRequest};
use Illuminate\Support\Facades\{DB, Mail, Http};

class TransactionService
{
    public function callback(Request $request)
    {
        $reference = $request['reference'];

        $order = Order::where(['reference' => $reference])->first();
        if (!$order) exit();
        if ($order->verified) exit();

        $payment = new Paystack;
        $paymentData = $payment->getPaymentData($reference);
        $status = $paymentData['data']["status"];

        $order->status = $status;
        $order->save();

        foreach($order->contents as $content):
            
        endforeach;
    }

    public function callbacks(Request $request)
    {
        $transactionId = $request['transaction_id'];
        $reference = $request['tx_ref'];
        $status = $request['status'];
        try{
            $order = Order::where(['reference' => $reference])->first();
            if (!$order) exit();
            if ($status != "successful") exit();

            $payment = new Flutterwave;
            $response = $payment->verifyTransaction($transactionId);
            if($response['data']["status"] === "successful"):
                $order->status = "success";
            else:
                $order->status = "failed";
            endif;
            
            $order->save();

            return CustomResponse::success("success", $order);
        }catch (\Exception $e) {
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
    }

    public function transfer(TransferRequest $request)
    {
        $user = auth()->user();
        
        if($wallet->available_balance < $request->amount):
            $message = "Insufficient Balance";
            return CustomResponse::error($message, 400);
        endif;

        try{
            $paystack = new Paystack;
            $recipient = $paystack->createTransferRecipient(
                Crypt::decryptString($wallet->account_number),
                Crypt::decryptString($wallet->account_name),
                $wallet->bank_code
            );

            $wallet->available_balance -= $request->amount;
            $wallet->save();
            $reference = Helper::generateReference($user->id);
            $transaction = Transaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'Debit',
                'amount' => $request->amount,
                'reference' => $reference,
                'method'  => 'Bank Transfer'
            ]);
            
            return $payment->sendMoney(
                [
                    'recipient' => $recipient['data']["recipient_code"],
                    'amount' => $request->amount * 100,
                    'source' => "balance",
                    'reason' => "Workpro Withdrawal Testing thursday",
                    'reference' => $reference
                ]
            );
            //return CustomResponse::success($response['message'], $data);
        }catch(\Exception $e){
            $message = $e->getMessage();
            return CustomResponse::error($message);
        }
    }

    public function transferWebhook(Request $request)
    {
        http_response_code(200);

        $transaction = Transaction::where([
            'reference' => $request['data']["reference"] ])
                ->first();
        if (!$transaction) exit();
        if ($transaction->verified) exit();

        $wallet = Wallet::find($transaction->wallet_id);

        if ($request['event'] == "transfer.success"):
            Transaction::where(['id' => $transaction->id])
            ->update([
                'status' => 'success',
                'verified' => 1
            ]);
            
            $wallet->balance -= $request['data']["amount"] / 100;
            $wallet->save();
        elseif ($request['event'] == "transfer.failed"):
            Transaction::where(['id' => $transaction->id])
            ->update([
                'status' => 'failed',
                'verified' => 1
            ]);
            
            $wallet->available_balance += $request['data']["amount"] / 100;
            $wallet->save();
        elseif ($request['event'] == "transfer.reversed"):
            Transaction::where(['id' => $transaction->id])
            ->update([
                'status' => 'reversed',
                'verified' => 1
            ]);
            
            $wallet->available_balance += $request['data']["amount"] / 100;
            $wallet->save();
        endif;
        
        exit();
    }
    
}
