<?php

namespace App\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Removeble;
use App\Contracts\Processble;
use Prophecy\Exception\InvalidArgumentException;
use App\Traits\CanBeRemoved;
use App\Traits\CanBeProcessed;


final class Order extends Model implements Removeble, Processble
{
    use CanBeRemoved, CanBeProcessed;

    protected $table = "orders";
   
    protected $fillable = [
        'title',
        'features',
        'info',
        'region',
        'city',
        'pib',
        'email',
        'phoneNumber'
   ];

   public function getId():int
   {
       return $this->id;
   }

   public function getTitle():string
   {
        return $this->title;
   }

   public function getFeatures():string
   {
       return $this->features;
   }

   public function getInfo():string
   {
        return $this->info;
   }

   public function getRegion():string
   {
       return $this->region;
   }

   public function getCity():string
   {
       return $this->city;
   }

   public function getEmail():string
   {
       return $this->email;
   }

   public function getphoneNumber():string
   {
       return $this->phoneNumber;
   }

   public function getPib():string
   {
       return $this->pib;
   }

   public function getCreatedAt(): Carbon
   {
       return $this->created_at;
   }
}
