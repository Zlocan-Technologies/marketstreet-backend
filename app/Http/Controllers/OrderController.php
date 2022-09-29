<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function order(Request $request)
    {
        return $this->orderService->order($request);
    }

    public function listOrdersForBuyer()
    {
        return $this->orderService->listOrdersForBuyer();
    }

    public function viewOrder($id)
    {
        return $this->orderService->viewOrder($id);
    }

    public function test()
    {
        return $this->orderService->test();
    }
}
