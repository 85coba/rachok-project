<?php

namespace App\Repository;

use App\Models\Equipment;

final class EquipmentRepository {

    public function create (array $eqiupment) 
    {
        return Equipment::crreate($eqiupment);
    }

    public function getAll ()
    {
        return Equipment::all();
    }
}