<?php

namespace App\Action\Order;

use App\Models\Order;
use Auth;

final class UnprocessOrderAction
{
    public function execute($id)
    {
        $user = Auth::user();
        $order = Order::find($id);
        $user->unprocess($order);
    }
}