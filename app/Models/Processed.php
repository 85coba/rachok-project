<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processed extends Model
{
    protected $table = 'processeds';

    public $timestamps = false;

    public function processble() 
    {
        return $this->morphTo();
    }

    public function processor()
    {
        return $this->morphTo();
    }
}
