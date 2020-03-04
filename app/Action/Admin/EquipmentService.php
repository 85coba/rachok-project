<?php


namespace App\Action\Admin;


use App\Repository\EquipmentRepository;

class EquipmentService
{
    private $equipmentRepository;

    public function __construct(EquipmentRepository $equipmentRepository)
    {
        $this->equipmentRepository = $equipmentRepository;
    }

    public function create(array $data)
    {
        $data['options'] = explode(', ', $data['options']);
        $this->equipmentRepository->create($data);
    }
}
