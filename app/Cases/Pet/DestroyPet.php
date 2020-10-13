<?php


namespace App\Cases\Pet;


use App\DataObjects\Pet;

class DestroyPet
{
    public function action(int $id)
    {
        $pet_data = new Pet();
        return $pet_data->destroy($id);
    }
}
