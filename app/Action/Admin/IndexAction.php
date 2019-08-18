<?php

namespace App\Action\Admin;

use App\Repository\UserRepository;
use App\Repository\OrderRepository;
use Illuminate\Support\Facades\Auth;
use App\Charts\OrdersChart;

final class IndexAction
{
    private $admin;
    private $vendorsCount;
    private $ordersCount;
    private $userRepo;
    private $orderRepo;
    private $topEquipment;

    public function __construct(OrderRepository $orderRepo, UserRepository $userRepo)
    {
        $this->orderRepo = $orderRepo;
        $this->userRepo = $userRepo;
    }

    public function execute (): array
    {
        $this->admin = Auth::user();
        $this->vendorsCount = $this->userRepo->getVendorsCount();
        $this->ordersCount = $this->orderRepo->getOrdersCount();
        $this->topEquipment = $this->orderRepo->getTopEquipment();
        $chart = $this->createChart($this->fetchOrdersGroupByMonth());
        
        $response = [
            'chart' => $chart,
            'admin' => $this->admin,
            'vendorsCount' => $this->vendorsCount,
            'ordersCount' => $this->ordersCount,
            'topEquipment' => $this->topEquipment
        ];

        return $response;        
    }

    private function fetchOrdersGroupByMonth()
    {
        $month = [];
        $count = [];
        $data = $this->orderRepo->getOrdersCountByDate();
        $data->map(function($item) use (&$month, &$count) {
            array_push($month, $item->month);
            array_push($count, $item->data);
        });
        
        return ['month' => $month, 'dataSet' => $count];
    }

    private function createChart(array $dataSet)
    {
        $chart = new OrdersChart;
        $chart->labels($dataSet['month']);
        $chart->dataset('Orders', 'line', $dataSet['dataSet'])->options([
            'backgroundColor' => 'rgba(0,255,0,0.3)', 
        ]);

        return $chart;
    }

}