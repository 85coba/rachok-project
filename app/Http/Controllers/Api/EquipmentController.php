<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Response\ApiResponse;
use App\Http\Controllers\ApiController;
use App\Action\Equipment\GetAllEquipmentAction;

class EquipmentController extends ApiController
{
    protected $getAllEquipmentAction;

    public function __construct(GetAllEquipmentAction $getAllEquipmentAction)
    {
        $this->getAllEquipmentAction = $getAllEquipmentAction;
    }

    public function index(): ApiResponse
    {
        return $this->createSuccessResponse($this->getAllEquipmentAction->execute());
    }
}
