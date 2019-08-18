<?php

declare(strict_types=1);

namespace App\Repository;

use Carbon\Carbon;
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

    public function getOrdersNotIn(
        array $IDs,
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator {
        
        return Order::whereNotIn('id', $IDs)
            ->orderBy($sort, $direction)
            ->paginate($perPage, ['*'], null, $page);
    }

    public function getOrdersIn(
        array $IDs,
        int $page = self::DEFAULT_PAGE,
        int $perPage = self::DEFAULT_PER_PAGE,
        string $sort = self::DEFAULT_SORT,
        string $direction = self::DEFAULT_DIRECTION
    ): LengthAwarePaginator 
    { 
        return Order::whereIn('id', $IDs)
            ->orderBy($sort, $direction)
            ->paginate($perPage, ['*'], null, $page);
    }

    public function getOrdersCount()
    {
        return Order::count();
    }

    public function getTopEquipment()
    {
        return DB::table('orders')
            ->select('title', DB::raw('count(*) as total'))
            ->groupBy('title')
            ->orderByDesc('total')
            ->first();
    }

    public function getOrdersCountByDate()
    {
        return Order::selectRaw('year(created_at) year, monthname(created_at) month, count(*) data')
            ->groupBy('year', 'month')
            ->orderByDesc('month')
            ->get();
            
    }

}