<?php

namespace App\Http\Controllers\Api;

use App\Models\UserSettings;
use Illuminate\Http\Request;
use App\Action\UserSettings\UserSettingsAction;
use App\Http\Controllers\ApiController;

class UserSettingsController extends ApiController
{
    private $userSettingsAction;

    public function __construct(UserSettingsAction $userSettingsAction)
    {
        $this->userSettingsAction = $userSettingsAction;
    }
 
    public function addSettings(Request $request)
    {
        $this->userSettingsAction->execute($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function show(UserSettings $userSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSettings $userSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSettings $userSettings)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserSettings  $userSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSettings $userSettings)
    {
        //
    }
}
