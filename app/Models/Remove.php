<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remove extends Model
{
    protected $table = 'removers';

    public $timestamps = false;

    public function removeble() 
    {
        return $this->morphTo();
    }

    public function remover()
    {
        return $this->morphTo();
    }
}
