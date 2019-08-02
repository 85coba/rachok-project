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
use App\Action\Order\GetProcessedOrderCollectionAction;
use App\Action\Order\GetUnProcessedOrderCollectionAction;
use App\Action\Order\GetRemovedOrderCollectionAction;

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
    protected $getProcessedOrderCollectionAction;
    protected $getUnProcessedOrderCollectionAction;
    protected $getRemovedOrderCollectionAction;

    public function __construct(
            AddOrderAction $addOrderAction, 
            OrderArrayPresenter $presenter, 
            GetOrderCollectionAction $getOrderColectionAtion,
            RemoveOrderFromUserListAction $removeOrderFromUserListAction,
            ProcessOrderAction $processOrderAction,
            UnprocessOrderAction $unprocessOrderAction,
            IsProcessedOrderAction $isProcessedOrderAction,
            GetProcessedOrderCollectionAction $getProcessedOrderCollectionAction,
            GetUnProcessedOrderCollectionAction $getUnProcessedOrderCollectionAction,
            GetRemovedOrderCollectionAction $getRemovedOrderCollectionAction

        )
    {
        $this->removeOrderFromUserListAction = $removeOrderFromUserListAction;
        $this->addOrderAction = $addOrderAction;
        $this->presenter = $presenter;
        $this->getOrderColectionAtion = $getOrderColectionAtion;
        $this->processOrderAction = $processOrderAction;
        $this->unprocessOrderAction = $unprocessOrderAction;
        $this->isProcessedOrderAction = $isProcessedOrderAction;
        $this->getProcessedOrderCollectionAction = $getProcessedOrderCollectionAction;
        $this->getUnProcessedOrderCollectionAction = $getUnProcessedOrderCollectionAction;
        $this->getRemovedOrderCollectionAction = $getRemovedOrderCollectionAction;
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

        return $this->created([$response]);
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

    public function removeOrderFromUserList($id) 
    {   
        $this->removeOrderFromUserListAction->execute($id);
        return $this->createDeletedResponse();
    }

    public function processOrder(Request $request)
    {
        $this->processOrderAction->execute($request->get('id'));
        return $this->createSuccessResponse(['order was processed']);
    }

    public function unprocessOrder(Request $request)
    {
        $this->unprocessOrderAction->execute($request->get('id'));
        return $this->createSuccessResponse(['order was UNprocessed']);
    }

    public function isProcessed($id)
    {
        return $this->isProcessedOrderAction->execute($id);
    }

    public function getRemovedOrders(CollectionHttpRequest $request): ApiResponse
    {
        $response = $this->getRemovedOrderCollectionAction->execute(
            new GetCollectionRequest(
                (int)$request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );
        return $this->createPaginatedResponse($response->getPaginator(), $this->presenter);
    }

    public function getProcessedOrders(CollectionHttpRequest $request): ApiResponse
    {
        $response = $this->getProcessedOrderCollectionAction->execute(
            new GetCollectionRequest(
                (int)$request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );
        return $this->createPaginatedResponse($response->getPaginator(), $this->presenter);
    }

    public function getUnProcessedOrders(CollectionHttpRequest $request): ApiResponse
    {
        $response = $this->getUnProcessedOrderCollectionAction->execute(
            new GetCollectionRequest(
                (int)$request->query('page'),
                $request->query('sort'),
                $request->query('direction')
            )
        );
        return $this->createPaginatedResponse($response->getPaginator(), $this->presenter);
    }
}
