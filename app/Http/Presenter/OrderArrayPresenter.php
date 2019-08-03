<?php

namespace App\Http\Presenter;

use App\Models\Order;
use Illuminate\Support\Collection;
use Auth;

final class OrderArrayPresenter implements CollectionAsArrayPresenter
{
    public function present(Order $order):array
    {
        return [
            'id' => $order->getId(),
            'title' => $order->getTitle(),
            'info' => $order->getInfo(),
            'features' => $order->getFeatures(),
            'region' => $order->getRegion(),
            'city' => $order->getCity(),
            'pib' => $order->getPib(),
            'email' => $order->getEmail(),
            'phoneNumber' => $order->getPhoneNumber(),
            'date' => $order->getCreatedAt()->toDateTimeString(),
            'processed' => Auth::user() ? Auth::user()->isProcessed($order) : false
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Order $order) {
                    return $this->present($order);
                }
            )
            ->all();
    }
}