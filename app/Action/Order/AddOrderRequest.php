<?php
    declare(strict_types=1);

    namespace App\Action\Order;

final class AddOrderRequest
{
    private $title;
    private $info;
    private $features;
    private $region;
    private $city;
    private $pib;
    private $email;
    private $phoneNumber;

    public function __construct(
        string $title, 
        string $info, 
        string $features, 
        string $region,
        string $city,
        string $pib,
        string $email,
        string $phoneNumber
    ){
        $this->title = $title;
        $this->info = $info;
        $this->features = $features;
        $this->region = $region;
        $this->city = $city;
        $this->pib = $pib;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;        
    }

    public function getTitle():string
    {
        return $this->title;
    }

    public function getInfo():string
    {
        return $this->info;
    }

      
    public function getFeatures()
    {
            return $this->features;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getCity()
    {
            return $this->city;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhoneNamber()
    {
        return $this->phoneNumber;
    }

    public function getPib()
    {
        return $this->pib;
    }
}
