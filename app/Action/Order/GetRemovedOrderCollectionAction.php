<?php

declare (strict_types=1);

namespace App\Action\Order;

use App\Models\Order;
use App\Contracts\Getter;
use App\Action\PaginatedResponse;
use App\Repository\OrderRepository;
use App\Action\GetCollectionRequest;
use Illuminate\Support\Facades\Auth;

final class GetRemovedOrderCollectionAction
{
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(GetCollectionRequest $request):PaginatedResponse
    {
        $user = Auth::user();
        
        $IDs = collect($user->removing(Order::class)->get()->toArray())
            ->pluck($user->getKeyName())->all();
        return new PaginatedResponse(
            $this->repository->getOrdersIn(
                $IDs,
                $request->getPage() ?: OrderRepository::DEFAULT_PAGE,
                OrderRepository::DEFAULT_PER_PAGE,
                $request->getSort() ?: OrderRepository::DEFAULT_SORT,
                $request->getDirection() ?: OrderRepository::DEFAULT_DIRECTION
            )
        );
    }
}