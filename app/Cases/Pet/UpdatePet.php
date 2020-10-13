<?php


namespace App\Cases\Pet;


use App\DataObjects\Pet;
use App\ValueObjects\PetName;
use App\ValueObjects\PetType;

class UpdatePet
{
    public function action(int $id, array $params)
    {
        $pet_data = new Pet();
        $pet = $pet_data->retrieve($id);
        $pet->setName(new PetName($params['name']));
        $pet->setType(new PetType($params['type']));
        if ($pet_data->update($pet)) {
            return $pet;
        }
        return FALSE;
    }
}
