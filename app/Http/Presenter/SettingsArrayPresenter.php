<?php

namespace App\Http\Presenter;

use App\Models\UserSettings;
use Illuminate\Support\Collection;

final class SettingsArrayPresenter
{
    public function present (UserSettings $setting): array
    {
        return [
                    $setting->getName() => explode(",",$setting->getValue())
            ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection->map(function(UserSettings $userSettings) {
            return $this->present($userSettings);
        })->all();
    }
}