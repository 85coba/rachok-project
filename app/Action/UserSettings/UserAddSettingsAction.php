<?php

namespace App\Action\UserSettings;

use Illuminate\Http\Request;
use App\Repository\SettingsRepository;

final class UserAddSettingsAction 
{
    private $repository;

    public function __construct(SettingsRepository $repository)
    {
        $this->repository = $repository;
    }
    public function execute(Request $settings)
    {
        
        foreach ($settings['settings'] as $name => $value) {
            $this->repository->updateSettings(['name' => $name, 'value' => $value]);
        }
    }
}