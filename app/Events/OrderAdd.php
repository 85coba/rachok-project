<?php

namespace App\Events;

use Illuminate\Support\Facades\App;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use App\Http\Presenter\OrderArrayPresenter;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderAdd implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = App::make(OrderArrayPresenter::class)->present($order);
    }

    public function broadcastAs()
    {
        return 'order.added';
    }

    public function broadcastOn()
    {
        return new PrivateChannel('order-channel');
    }


}
