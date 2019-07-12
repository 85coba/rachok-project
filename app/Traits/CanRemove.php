<?php

namespace App\Traits;

use App\Contacts\Removeble;
use App\Contacts\Remover;

trait CanRemove
{
    public function removing($model = null) 
    {
        return $this->morphToMany(($model) ?: $this->getMorphClass(), 'remover', 'removes', 'romover_id', 'removed_id')
        ->withPivot('removed_type')
        ->wherePivot('removed_type', ($model) ?: $this->getMorphClass())
        ->wherePivot('remover_type', $this->getMorphClass());
    }

    public function isRemoved($model = null): bool
    {
        if (! $model instanceof Removeble && ! $model instanceof Remover) {
            return false;
        }

        return (bool) ! is_null($this->removing($model->getMorphClass())->find($model->getKey()));
    }

    public function removeFrom($model = null): bool
    {
        if (! $model instanceof Removeble && $model instanceof Remover) {
            return false;
        }

        if ($this->isRemoved($model)) {
            return false;
        }

        $this->removing()->attach($this->getKey(), [
            'remover_id' => $this->getKey(),
            'removed_type' => $model->getMorphClass(),
            'removed_id' => $model->getKey()
        ]);

        return true;
    }
}