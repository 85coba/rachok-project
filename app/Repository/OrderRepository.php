<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Presenter\SettingsArrayPresenter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
        $filterIDs = [];
        $filters = $model->settings;
        foreach ($filters as $filter) {
            $IDs = collect(Order::select('id')
                ->whereNotIn($filter->name, explode(",", $filter->value))
                ->get()->toArray())->pluck('id')->all();
            $filterIDs = (count($filterIDs) === 0) ? $IDs : array_uintersect($filterIDs, $IDs, "strcasecmp");
        }

        $removedIds = collect($model->removing(Order::class)->get()->toArray())->pluck($model->getKeyName())->all();
        
        return Order::whereNotIn('id',$filterIDs)->whereNotIn('id', $removedIds)
            ->orderBy($sort, $direction)
            ->paginate($perPage, ['*'], null, $page);
    }

    public function getRemovedOrders(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        $model = Auth::user();

        $removedIds = collect($model->removing(Order::class)->get()->toArray())->pluck($model->getKeyName())->all();
        
        return Order::whereIn('id', $removedIds)->orderBy($sort, $direction)->paginate($perPage, ['*'], null, $page);
    }

    public function getProcessedOrders(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        $model = Auth::user();

        $processedIds = collect($model->processing(Order::class)->get()->toArray())->pluck($model->getKeyName())->all();
        
        return Order::whereIn('id', $processedIds)->orderBy($sort, $direction)->paginate($perPage, ['*'], null, $page);
    }

    public function getUnProcessedOrders(
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        $model = Auth::user();

        $processedIds = collect($model->processing(Order::class)->get()->toArray())->pluck($model->getKeyName())->all();
        
        return Order::whereNotIn('id', $processedIds)->orderBy($sort, $direction)->paginate($perPage, ['*'], null, $page);
    }
}