<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Util\{CustomResponse, Paystack, Flutterwave, Helper};
use App\Http\Resources\{ProductResource};
use App\Http\Requests\{CreateOrder, CreateInvoice};
use Illuminate\Support\Facades\{DB, Http, Crypt, Hash, Mail};
use App\Models\{User, Product, Category, Order, OrderContent};

class OrderService
{  
    public function order(CreateOrder $request)
    {
        $user = auth()->user();
        $total = $request['total'];
        $reference = Helper::generateReference($user->id);
        $channel = strtoupper($request['payment_channel']);
        $paymentUrl = $this->generatePaymentUrl($user, $channel, $total, $reference);
        $orderNo = mt_rand(1000, 9999);
        
        DB::transaction(function(){
            $order = Order::create([
                'user_id' => $user->id,
                'order_no' => $orderNo,
                'subtotal' => $request['subtotal'],
                'shipping_cost' => $request['shipping_cost'],
                'subcharge' => $request['subcharge'],
                'total' => $total,
                'reference' => $reference,
                'payment_channel' => $channel,
                'coupon_code' => isset($request['coupon_code']) ? $request['coupon_code'] : NULL
            ]);
            foreach($request['cart'] as $item):
                $content = OrderContent::create([
                    'order_id' => $order->id,
                    'product_id' => (int) $item['id'],
                    //'seller_id' => (int) $item['seller_id'],
                    'quantity' =>(int) $item['quantity'],
                    'price' => $item['price']
                ]);
            endforeach;
        });
       
        return $paymentUrl;
    }

    public function generatePaymentUrl($user, $channel, $total, $reference)
    {
        if($channel === "PAYSTACK"):
            $payment = new Paystack;
            $response = $payment->initiateDeposit(
                $user->email, $total, $reference
            );

            return $response['data']["authorization_url"];
        elseif($channel === "FLUTTERWAVE"):
            $payment = new Flutterwave;
            $response = $payment->initializePayment(
                $user,
                [
                    'tx_ref' => $reference,
                    'amount' => $total,
                ]
            );

            return $response['data']["link"];
        endif;
    }

    public function listOrdersForBuyer()
    {
        $user = auth()->user();
        $orders = Order::where(['user_id' => $user->id])->get();
        if(!$orders) return CustomResponse::error('No orders found', 404);

        return CustomResponse::success("Orders:", $orders);
    }

    public function show($id)
    {
        $order = Order::find($id);
        if(!$order) return CustomResponse::error('No order found', 404);

        return CustomResponse::success("Order Details:", $order);
    }

    public function test()
    {
        return Order::find(1)->contents;
        return Product::find(1)->orders;
        return Order::find(2)->products;
    }

    public function sendInvoice(CreateInvoice $request)
    {
        $seller = auth()->user();
        $product = Product::find($request["cart"]["id"]);
        $price = $request["cart"]["price"];
        $quantity = isset($request["cart"]["quantity"]) ? $request["cart"]["quantity"] : 1;
        $buyer = User::find($request["id"]);
        $subcharge = 700;

        $subtotal = $request["cart"]["price"] * $request["cart"]["quantity"];
        $total = 0;
        $total += $product->shipping_cost;
        $total += $subcharge;
        $reference = Helper::generateReference($buyer->id);
        $orderNo = mt_rand(1000, 9999);
        
        $order = Order::create([
            'user_id' => $buyer->id,
            'order_no' => $orderNo,
            'subtotal' => $subtotal,
            'shipping_cost' => $product->shipping_cost,
            'subcharge' => $subcharge,
            'total' => $total,
            'reference' => $reference,
        ]);
        $content = OrderContent::create([
            'order_id' => $order->id,
            'product_id' =>(int) $request["cart"]["id"],
            'quantity' =>(int) $request["cart"]["quantity"],
            'price' => $request["cart"]["price"]
        ]);
       
        return CustomResponse::success("An invoice has been sent to the buyer", $order->fresh());
    }

    public function invoicePayment(Request $request)
    {
        $order = Order::find($request['id']);
        $user = User::find($order->user_id);
        $channel = strtoupper($request['payment_channel']);
        $total = $order->total;
        $reference = $order->reference;
        $paymentUrl = $this->generatePaymentUrl($user, $channel, $total, $reference);

        return CustomResponse::success("Payment Link:", $paymentUrl);
    }

    public function fetchCouponData($code)
    {
        $coupon = DB::table('coupons')->where([
            'code' => $code
        ])->first();
        if(!$coupon):
            return CustomResponse::error("Invalid Coupon Code", 404);
        endif;
        return CustomResponse::success("Coupon:", $coupon);
    }

}