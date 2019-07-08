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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): ApiResponse
    {
        return $this->createSuccessResponse($this->getAllEquipmentAction->execute());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
