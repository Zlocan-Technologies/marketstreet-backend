<?php

namespace App\Events;

use App\Models\Order;
use App\Models\SubOrder;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderPlaced implements ShouldBroadcast
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $order;
   
    public function __construct(SubOrder $order)
    {
        $this->order = $order;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('order.'.$this->order->id);
    }

    public function broadcastAs()
    {
        return 'order.placed';
    }
}
