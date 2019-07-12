<?php

namespace App\Contracts;

interface Processble
{
    public function processor($model = null);
}