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
            $this->repository->paginate(
                $request->getPage() ?: OrderRepository::DEFAULT_PAGE,
                OrderRepository::DEFAULT_PER_PAGE,
                $request->getSort() ?: OrderRepository::DEFAULT_SORT,
                $request->getDirection() ?: OrderRepository::DEFAULT_DIRECTION
            )
        );
    }
}