<?php

namespace App\Action\Order;

use App\Models\Order;
use Auth;
use App\Models\User;

final class ProcessOrderAction
{
    public function execute($id)
    {
        // $user = Auth::user();
        $user = User::find(1);
        $order = Order::find($id);
        $user->process($order);
    }
}