<?php

declare (strict_types=1);

namespace App\Action\Order;

use App\Action\GetCollectionRequest;
use App\Repository\OrderRepository;
use App\Action\PaginatedResponse;

final class GetOrderCollectionAction 
{
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetCollectionRequest $request):PaginatedResponse
    {
        
        return new PaginatedResponse(
            $this->repository->getFiltredOrders(
                $request->getPage() ?: OrderRepository::DEFAULT_PAGE,
                OrderRepository::DEFAULT_PER_PAGE,
                $request->getSort() ?: OrderRepository::DEFAULT_SORT,
                $request->getDirection() ?: OrderRepository::DEFAULT_DIRECTION
            )
        );
    }

    // public function setProcessedStatus(Order $order)
    // {
    //     $user = Auth::user();
    //     if ($user->isProcessed($order)) {
    //         $order->processed = true;
    //     } else {
    //         $order->processed = false;
    //     }
    //     return $order;
    // }

    // public function checkArray ($orders)
    // {
    //     foreach ($orders as $order) {
    //         $order = $this->setProcessedStatus($order);
    //     }
    //     return $orders;
    // }
}