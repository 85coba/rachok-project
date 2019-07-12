<?php

namespace App\Traits;

trait CanBeRemoved
{
    public function removers($model = null)
    {
        return $this->morphToMany(($model) ?: $this->getMorphClass(), 'remover', 'removes', 'remover_id', 'removed_id')
            ->withPivot('remover_ type')
            ->wherePivot('remover_type', ($model) ?: $this->getMorphClass())
            ->wherePivot('removed_type', $this->getMorphClass);
    }
}