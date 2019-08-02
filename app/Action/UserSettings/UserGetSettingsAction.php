<?php

namespace App\Action\UserSettings;

use App\Repository\SettingsRepository;
use Auth;
use App\Http\Presenter\SettingsArrayPresenter;

final class UserGetSettingsAction
{
    private $repository;
    private $presenter;

    public function __construct(
        SettingsRepository $repository,
        SettingsArrayPresenter $presenter
    )
    {
        $this->repository = $repository;
        $this->presenter = $presenter;
    }

    public function execute (): array
    {
        return $this->presenter->presentCollection($this->repository->getSettings());
    }
}