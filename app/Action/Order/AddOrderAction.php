<?php

declare(strict_types=1);

namespace App\Action\Order;

use App\Models\Order;
use App\Repository\OrderRepository;

final class AddOrderAction
{
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function execute(AddOrderRequest $request): AddOrderResponse
    {
        $order = new Order();
        $order->title = $request->getTitle();
        $order->info = $request->getInfo();
        $order->features = $request->getFeatures();
        $order->region = $request->getRegion();
        $order->city = $request->getCity();
        $order->pib = $request->getPib();
        $order->email = $request->getEmail();
        $order->phoneNumber = $request->getPhoneNamber();

        $order = $this->orderRepository->save($order);
        
        // broadcast(new OrderAddedEvent($order))->toOthers();

        return new AddOrderResponse($order);
    }
}