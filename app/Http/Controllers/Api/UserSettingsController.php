<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Response\ApiResponse;
use App\Http\Controllers\ApiController;
use App\Action\UserSettings\UserAddSettingsAction;
use App\Action\UserSettings\UserGetSettingsAction;

class UserSettingsController extends ApiController
{
    private $userAddSettingsAction;
    private $userGetSettingsAction;

    public function __construct(
        UserAddSettingsAction $userAddSettingsAction,
        UserGetSettingsAction $userGetSettingsAction
    ) {
        $this->userAddSettingsAction = $userAddSettingsAction;
        $this->userGetSettingsAction = $userGetSettingsAction;
    }

    public function addSettings(Request $request)
    {
        return $this->userAddSettingsAction->execute($request);
    }

    public function getSettings(): ApiResponse
    {
        return $this->createSuccessResponse(
            $this->userGetSettingsAction->execute()
        );
    }
}
