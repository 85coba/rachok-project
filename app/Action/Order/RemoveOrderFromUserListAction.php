<?php

namespace App\Action\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Log;

final class RemoveOrderFromUserListAction
{
    public function execute($id)
    {

        Log::info($id);
        $user = \Auth::user();
        Log::info($user);
        $order = Order::find($id);
        return $user->remove($order);
    }
}