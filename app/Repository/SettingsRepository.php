<?php

namespace App\Repository;

use Auth;
use App\Models\UserSettings;

final class SettingsRepository 
{

    public function getSettings()
    {
        $user = Auth::user();
        return $user->filters;
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
        if (!$settings['value']) {
            return $user->filters()->where('name', $settings['name'])->delete();;
        }
        
        if (!$user->filters()->exists()) {
            return $this->addSettings($settings);
        }

        foreach ($user->filters as $setting) {
            if ($setting['name'] === $settings['name']) {
                $setting['value'] = implode(",", $settings['value']);
                $setting->save();
            } else {
                $this->addSettings($settings);
            }
        }
    }
}