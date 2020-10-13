<?php


namespace App\Repository;


use App\Entities\PetEntity;
use App\ValueObjects\PetName;
use App\ValueObjects\PetType;

interface PetRepository
{
    public function add(PetName $name, PetType $type): PetEntity;
    public function destroy(int $id): bool;
    public function update(PetEntity $pet): bool;
    public function retrieve(int $id): PetEntity;
}
