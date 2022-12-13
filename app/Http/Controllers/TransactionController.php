<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionService;


class TransactionController extends Controller
{
    protected TransactionService $transactionService;

    public function __construct(
        TransactionService $transactionService
    )
    
    {
        $this->transactionService = $transactionService;
    }

    public function paystackCallback(Request $request)
    {
        return $this->transactionService->paystackCallback($request);
    }

    public function flutterwaveCallback(Request $request)
    {
        return $this->transactionService->flutterwaveCallback($request);
    }

}
