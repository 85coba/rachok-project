<?php

namespace App\Action\Equipment;

use App\Repository\EquipmentRepository;
use App\Http\Presenter\EquipmentArrayPresenter;

final class GetAllEquipmentAction 
{
    protected $repository;
    protected $presenter;

    public function __construct(EquipmentRepository $repository, EquipmentArrayPresenter $presenter)
    {
        $this->repository = $repository;
        $this->presenter = $presenter;
    }

    public function execute(): array
    {
        return $this->presenter->presentCollection($this->repository->getAll());
    }
}