<?php

declare(strict_types = 1);

namespace App\Http\Presenter;

use App\Models\Equipment;
use Illuminate\Support\Collection;

final class EquipmentArrayPresenter implements CollectionAsArrayPresenter
{
    public function present(Equipment $equipment): array
    {
        return [
            'id' => $equipment->getId(),
            'name' => $equipment->getName(),
            'options' => $equipment->getOptions(),
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (Equipment $equipment) {
                    return $this->present($equipment);
                }
            )
            ->all();
    }
}
