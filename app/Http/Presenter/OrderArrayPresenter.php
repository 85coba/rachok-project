<?php

namespace App\Http\Presenter;

use App\Models\Order;
use Illuminate\Support\Collection;

final class OrderArrayPresenter
{
    public function present(Order $order):array
    {
        return [
            'id' => $order->getId(),
            'title' => $order->getTigle(),
            'info' => $order->getInfo(),
            'features' => $order->getFeatures(),
            'region' => $order->getRegion(),
            'city' => $order->getCity(),
            'pib' => $order->getPib(),
            'email' => $order->getEmail(),
            'phoneNumber' => $order->getPhoneNumber(),
            'date' => $order->getCreatedAt()->toDateTimeString()
        ];
    }
}