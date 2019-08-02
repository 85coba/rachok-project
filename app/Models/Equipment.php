<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';

    protected $fillable = [
        'name',
        'options'
    ];

    public $timestamps = false;

    public function getId() 
    {
        return $this->id;
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getOptions()
    {
        return $this->options;
    }

}
