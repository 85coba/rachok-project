<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Response\ApiResponse;
use App\Http\Request\Api\Order\AddOrderHttpRequest;
use App\Action\Order\AddOrderRequest;
use App\Action\Order\AddOrderAction;
use App\Http\Presenter\OrderArrayPresenter;

class OrderControler extends ApiController
{
    protected $presenter;
    protected $getOrderColectionAtion;
    protected $addOrderAction;
    protected $addOrderResponse;

    public function __construct(AddOrderAction $addOrderAction, OrderArrayPresenter $presenter)
    {
        $this->addOrderAction = $addOrderAction;
        $this->presenter = $presenter;
    }

    public function addOrder(AddOrderHttpRequest $request):ApiResponse
    {
        $response = $this->addOrderAction->execute(
            new AddOrderRequest(
                $request->get('title'),
                $request->get('info'),
                $request->get('features'),
                $request->get('region'),
                $request->get('city'),
                $request->get('pib'),
                $request->get('email'),
                $request->get('phoneName')
            )
        );

        return $this->created($this->presenter->present($response->getOrder()));
    }

    
}
