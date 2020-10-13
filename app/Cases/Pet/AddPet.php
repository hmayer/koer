<?php


namespace App\Cases\Pet;


use App\Entities\PetEntity;
use App\ValueObjects\PetName;
use App\ValueObjects\PetType;
use App\DataObjects\Pet;
use function Sodium\add;

class AddPet
{
    public function action(?array $params): PetEntity
    {
        $name = new PetName($params['name']);
        $type = new PetType($params['type']);
        $pet = new Pet();
        return $pet->add($name, $type);
    }
}
