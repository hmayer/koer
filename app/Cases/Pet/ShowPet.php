<?php


namespace App\Cases\Pet;


use App\DataObjects\Pet;
use App\Entities\PetEntity;

class ShowPet
{
    public function action(int $id): PetEntity
    {
        $pet_data = new Pet();
        $pet = $pet_data->retrieve($id);
        $pet->withAttendance(TRUE);
        return $pet;
    }
}
