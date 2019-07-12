<?php

namespace App\Contracts;

interface Processor
{
    public function processing($model = null);

    public function isProcessing($model = null): bool;

    public function process($model = null): bool;

    public function unprocess($model = null): bool;
}