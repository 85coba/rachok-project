<?php

namespace App\Repository;

use App\Models\Equipment;

final class EquipmentRepository {

    public function create (array $eqiupment)
    {
        return Equipment::create($eqiupment);
    }

    public function getAll ()
    {
        return Equipment::all();
    }
}
