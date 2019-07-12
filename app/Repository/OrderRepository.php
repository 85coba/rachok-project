<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;
use Log;


final class OrderRepository implements Paginable
{
    public function create(array $fields): Order
    {
        return Order::create($fields);
    }

    public function paginate(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        return Order::orderBy($sort, $direction)->paginate($perPage, ['*'], null, $page);
    }

    public function getById(int $id): Order
    {
        return Order::findOrFail($id);
    }

    public function save(Order $order): Order
    {
        $order->save();

        return $order;
    }

    public function delete(Order $order): ?bool
    {
        return $order->delete();
    }

    public function getFiltredOrders(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        $model = Auth::user();

        $blockingsIds = collect($model->removing(Order::class)->get()->toArray())->pluck($model->getKeyName())->all();
        Log::info(count($blockingsIds));
        return Order::whereNotIn('id', $blockingsIds)->orderBy($sort, $direction)->paginate($perPage, ['*'], null, $page);
    }
}