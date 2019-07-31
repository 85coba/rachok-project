<?php

namespace App\Repository;

use App\Models\UserSettings;
use Auth;

final class SettingsRepository 
{

    public function getSettings()
    {
        $user = Auth::user();
        $settings = $user->settings();

        return $settings;
    }

    public function addSettings($settings)
    {
        $newSettings = new UserSettings();
        $newSettings->user_id = Auth::user()->id;
        $newSettings->name = $settings['name'];
        $newSettings->value = implode(",", $settings['value']); 
        $newSettings->save();

        return $newSettings;
    }

    public function updateSettings($settings)
    {
        $user = Auth::user();
        if (!$user->settings()->exists()) {
            return $this->addSettings($settings);
        }

        foreach ($user->settings as $setting) {
            if ($setting['name'] === $settings['name']) {
                $setting['value'] = implode(",", $settings['value']);
                $setting->save();
            } else {
                $this->addSettings($settings);
            }
        }
    }


}