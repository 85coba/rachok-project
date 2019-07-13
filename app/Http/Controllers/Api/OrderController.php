<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Response\ApiResponse;
use App\Http\Request\Api\Order\AddOrderHttpRequest;
use App\Action\Order\AddOrderRequest;
use App\Action\Order\AddOrderAction;
use App\Http\Presenter\OrderArrayPresenter;
use App\Action\GetCollectionRequest;
use App\Http\Request\Api\CollectionHttpRequest;
use App\Action\Order\GetOrderCollectionAction;
use App\Action\Order\RemoveOrderFromUserListAction;
use App\Action\Order\ProcessOrderAction;
use App\Action\Order\UnprocessOrderAction;
use App\Action\Order\IsProcessedOrderAction;

use Log;

class OrderController extends ApiController
{
    protected $presenter;
    protected $getOrderColectionAtion;
    protected $addOrderAction;
    protected $addOrderResponse;
    protected $getOrderCollectionAction;
    protected $removeOrderFromUserListAction;
    protected $processOrderAction;
    protected $unprocessOrderAction;
    protected $isProcessedOrderAction;

    public function __construct(
            AddOrderAction $addOrderAction, 
            OrderArrayPresenter $presenter, 
            GetOrderCollectionAction $getOrderColectionAtion,
            RemoveOrderFromUserListAction $removeOrderFromUserListAction,
            ProcessOrderAction $processOrderAction,
            UnprocessOrderAction $unprocessOrderAction,
            IsProcessedOrderAction $isProcessedOrderAction
        )
    {
        $this->removeOrderFromUserListAction = $removeOrderFromUserListAction;
        $this->addOrderAction = $addOrderAction;
        $this->presenter = $presenter;
        $this->getOrderColectionAtion = $getOrderColectionAtion;
        $this->processOrderAction = $processOrderAction;
        $this->unprocessOrderAction = $unprocessOrderAction;
        $this->isProcessedOrderAction = $isProcessedOrderAction;
    }

    public function addOrder(AddOrderHttpRequest $request):ApiResponse
    {
        $response = $this->addOrderAction->execute(
            new AddOrderRequest(
                $request->get('title'),
                (string)$request->get('info'),
                $request->get('features'),
                $request->get('region'),
                $request->get('city'),
                $request->get('pib'),
                $request->get('email'),
                $request->get('phoneNumber')
            )
        );

        return $this->created($this->presenter->present($response->getOrder()));
    }

    public function getOrderCollection(CollectionHttpRequest $request): ApiResponse 
    {
        $response = $this->getOrderColectionAtion->execute(
            new GetCollectionRequest(
                (int)$request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );
        return $this->createPaginatedResponse($response->getPaginator(), $this->presenter);
    }

    public function removeOrderFromUserList(Request $request) 
    {   
        $this->removeOrderFromUserListAction->execute($request->get('id'));
    }

    public function processOrder(Request $request)
    {
        $this->processOrderAction->execute($request->get('id'));
    }

    public function unprocessOrder(Request $request)
    {
        $this->unprocessOrderAction->execute($request->get('id'));
    }

    public function isProcessed($id)
    {
        return $this->isProcessedOrderAction->execute($id);
    }
}
