<?php

namespace App\Traits;

use App\Contracts\Processble;
use App\Contracts\Processor;

trait CanProcess
{
    public function processing($model = null)
    {
        return $this->morphToMany(($model) ?: $this->getMorphClass(), 'processor', 'processeds', 'processor_id', 'processed_id')
            ->withPivot('processed_type')
            ->wherePivot('processed_type', ($model) ?: $this->getMorphClass())
            ->wherePivot('processor_type', $this->getMorphClass());
    }

    public function isProcessed($model): bool
    {
        if (! $model instanceof Processble && ! $model instanceof Processor ) {
            return false;
        }

        return (bool) ! is_null($this->processing($model->getMorphClass())->find($model->getKey()));
    }

    public function process($model = null): bool
    {
       
        if (! $model instanceof Processble && ! $model instanceof Processor ) {
            return false;
        }
        
        if ($this->isProcessed($model)) {
            return false;
        }
        
        $this->processing()->attach($this->getKey(), [
            'processor_id' => $this->getKey(),
            'processed_type' => $model->getMorphClass(),
            'processed_id' => $model->getKey()
        ]);

        return true;
    }

    public function unprocess($model = null): bool
    {
        if (! $model instanceof Processble && ! $model instanceof Processor ) {
            return false;
        }
        
        if (! $this->isProcessed($model)) {
            return false;
        }

        return (bool) $this->processing($model->getMorphClass())->detach($model->getKey());
    }
}