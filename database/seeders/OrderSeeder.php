<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\SubOrder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $paymentChannel =  ['paystack', 'flutterwave'];

       for ($i=0; $i < 100; $i++) { 
        $faker = \Faker\Factory::create();
                    $cost = rand(100,400);
                    $price = rand(600,10000);
                    $channelID = rand(0,1);
                //seed orders and sub orders into db
                $order = Order::create([
                        'user_id' => rand(1,20),
                        'shipping_cost' => $cost,
                        'total' => $price,
                        'subtotal' => $price,
                        'subcharge' => $cost,
                        'reference' => Str::random(12),
                        'order_no' => Str::random(12),
                        'payment_channel' => $paymentChannel[$channelID],
                        'created_at'=> $faker->dateTimeBetween($startDate = '-6 month',$endDate = 'now')
                    ]);

                //create sub order
                SubOrder::create([
                    'order_id' => $order->id,
                    'seller_id' => rand(1,20),
                    'order_no' => $order->order_no,
                    'total' => $price,
                ]);

            }
       }
}
