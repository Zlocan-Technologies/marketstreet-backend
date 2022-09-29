<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Util\{CustomResponse, Paystack, Flutterwave, Helper};
use App\Http\Resources\{ProductResource};
use App\Http\Requests\{CreateProduct, ReviewProduct};
use Illuminate\Support\Facades\{DB, Http, Crypt, Hash, Mail};
use App\Models\{User, Product, Category, Order, OrderContent};

class OrderService
{  
    public function order(Request $request)
    {
        $user = auth()->user();
        $total = $request['total'];
        $reference = Helper::generateReference($user->id);
        $channel = strtoupper($request['payment_channel']);
        $paymentUrl = $this->generatePaymentUrl($user, $channel, $total, $reference);
        
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'reference' => $reference,
            'payment_channel' => $channel,
            'coupon_code' => isset($request['coupon_code']) ? $request['coupon_code'] : NULL
        ]);
        foreach($request['cart'] as $item):
            $content = OrderContent::create([
                'order_id' => $order->id,
                'product_id' =>(int) $item['id'],
                'quantity' =>(int) $item['quantity'],
                'price' => $item['price']
            ]);
        endforeach;
       
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

    public function viewOrder($id)
    {
        $order = Order::where(['id' => $id])->first();
        if(!$order) return CustomResponse::error('No order found', 404);

        return CustomResponse::success("Order Details:", $order);
    }

    public function test()
    {
        return Order::find(1)->contents;
        return Product::find(1)->orders;
        return Order::find(2)->products;
    }

    public function sendInvoice(Request $request)
    {
        $seller = auth()->user();
        $product = Product::find($id);
        $productId = $request['productId'];
        $price = $request['price'];
        $quantity = isset($request['quantity']) ? $request['quantity'] : 1;
        $buyer = User::find($request['buyerId']);

        $total = $request['price'] * $request['quantity'];
        $total += $product->shipping_cost;
        $reference = Helper::generateReference($buyer->id);
        $channel = isset($request['channel']) ? $request['channel'] : 'FLUTTERWAVE';
        $paymentUrl = $this->generatePaymentUrl($buyer, $channel, $total, $reference);
        
        $order = Order::create([
            'user_id' => $buyer->id,
            'total' => $total,
            'reference' => $reference,
            'payment_channel' => $channel,
            'coupon_code' => NULL
        ]);
        $content = OrderContent::create([
            'order_id' => $order->id,
            'product_id' =>(int) $request['productId'],
            'quantity' =>(int) $request['quantity'],
            'price' => $request['price']
        ]);
       
        return CustomResponse::success("Product:", $paymentUrl);
    }

    public function checkCoupon(Request $request)
    {
        $coupon = DB::table('coupons')->where([
            'coupons' => $request['code']
        ])->first();

        return CustomResponse::success("Coupon:", $coupon);
    }

}