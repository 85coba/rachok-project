<?php

namespace App\Traits;

trait CanBeProcessed
{
    public function processor($model = null)
    {
        return $this->morphToMany(($model) ?: $this->getMorphClass(), 'processed', 'processor', 'processed_id', 'processor_id')
            ->withPivot('processor_type')
            ->wherePivot('processor_type', ($model) ?: $this->getMorphClass())
            ->wherePivot('processed_type', $this->getMorphClass());
    }
}