<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Requests\{
    CreateOrder, 
    CreateInvoice
};

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function order(CreateOrder $request)
    {
        return $this->orderService->order($request);
    }

    public function listOrdersForBuyer()
    {
        return $this->orderService->listOrdersForBuyer();
    }

    public function show($id)
    {
        return $this->orderService->show($id);
    }

    public function test()
    {
        return $this->orderService->test();
    }

    public function sendInvoice(CreateInvoice $request)
    {
        return $this->orderService->sendInvoice($request);
    }

    public function invoicePayment(Request $request)
    {
        return $this->orderService->invoicePayment($request);
    }

    public function fetchCouponData($code)
    {
        return $this->orderService->fetchCouponData($code);
    }
}
