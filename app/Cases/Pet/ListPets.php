<?php


namespace App\Cases\Pet;


use App\DataObjects\PetCollection;
use App\Models\Pet;

class ListPets
{
    public function action(?string $name = ' '): PetCollection
    {
        $name = str_replace(' ', '%', $name);
        $pets = Pet::where('name', 'like', "%{$name}%")->paginate()->all();
        return new PetCollection($pets);
    }
}
