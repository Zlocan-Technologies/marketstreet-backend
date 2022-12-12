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

    public function listBuyerOrders($id)
    {
        return $this->orderService->listBuyerOrders($id);
    }

    public function listSellerOrders($id)
    {
        return $this->orderService->listSellerOrders($id);
    }

    public function fetchBuyerOrderData($orderId)
    {
        return $this->orderService->fetchBuyerOrderData($orderId);
    }

    public function fetchSellerOrderData($orderId)
    {
        return $this->orderService->fetchSellerOrderData($orderId);
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
