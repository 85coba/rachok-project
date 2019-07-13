<?php

namespace App\Action\Order;

use App\Models\Order;
use Auth;

use App\Models\User;

final class IsProcessedOrderAction
{
    public function execute($id)
    {
        // $user = Auth::user();
        $user = User::find(1);
        $order = Order::find($id);
        if ($user->isProcessed($order)) return 'Processed';
        return 'notProcessed';
    }
}