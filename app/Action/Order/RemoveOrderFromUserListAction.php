<?php

namespace App\Action\Order;

use App\Models\Order;
use Auth;

use Log;

final class RemoveOrderFromUserListAction
{
    public function execute($id)
    {

        Log::info($id);
        $user = Auth::user();
        $order = Order::find($id);
        return $user->remove($order);
    }
}