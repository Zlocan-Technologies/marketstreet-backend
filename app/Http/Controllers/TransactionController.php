<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\Http\Requests\{InitiateDeposit, transferRequest};


class TransactionController extends Controller
{
    protected TransactionService $transactionService; 

    public function __construct(
        TransactionService $transactionService
    )
    {
        $this->transactionService = $transactionService;
    }

    public function initiateDeposit(InitiateDeposit $request)
    {
        return $this->transactionService->initiateDeposit($request);
    }

    public function callback(Request $request)
    {
        return $this->transactionService->callback($request);
    }

    public function transferWebhook(Request $request)
    {
        return $this->transactionService->transferWebhook($request);
    }

    public function transfer(transferRequest $request)
    {
        return $this->transactionService->transfer($request);
    }

    public function escapeWebView(Request $request)
    {
        return $this->transactionService->escapeWebView();
    }
}
