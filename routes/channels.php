<?php

use App\Models\Order;
use App\Models\SubOrder;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('order.{orderId}', function($user, $orderId){
    return (int) $user->id === SubOrder::findOrFail($orderId)->seller_id;
});

Broadcast::channel('invoice.{orderId}', function($user, $orderId){
    return (int) $user->id === Order::findOrFail($orderId)->user_id;
});