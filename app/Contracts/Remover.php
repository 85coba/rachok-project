<?php

namespace App\Contracts;

interface Remover
{
    public function removing($model = null);

    public function isRemoved($model = null): bool;

    public function removeFrom($model = null): bool;
    
}