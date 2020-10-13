<?php


namespace App\DataObjects;


use App\Entities\PetEntity;
use App\Models\Pet as PetModel;
use App\Repository\PetRepository;
use App\ValueObjects\PetName;
use App\ValueObjects\PetType;
use Exception;
use RuntimeException;

class Pet implements PetRepository
{
    /**
     * @param PetName $name
     * @param PetType $type
     * @return PetEntity
     */
    public function add(PetName $name, PetType $type): PetEntity
    {
        $pet = new PetModel();
        $pet->name = $name->__toString();
        $pet->type = $type->__toString();
        $pet->save();
        if ($pet->exists) {
            return new PetEntity(
                $pet->id,
                new PetName($pet->name),
                new PetType($pet->type)
            );
        }
        throw new RuntimeException("Invalid input to save Pet");
    }

    public function destroy(int $id): bool
    {
        //Bypass entities, do it directly on Model
        try {
            $pet = PetModel::where('id', $id)->first();
            if ($pet) {
                $pet->attendances()->delete();
                $pet->delete();
                return TRUE;
            }
            return FALSE;
        } catch (Exception $exception) {
            return FALSE;
        }
    }

    public function update(PetEntity $pet): bool
    {
        $persisted_pet = PetModel::where('id', $pet->getId())->firstOrFail();
        $persisted_pet->name = $pet->getName()->__toString();
        $persisted_pet->type = $pet->getType()->__toString();
        return $persisted_pet->save();
    }

    public function retrieve(int $id): PetEntity
    {
        $persisted_pet = PetModel::where('id', $id)->firstOrFail();
        $attendances = new AttendanceCollection($persisted_pet->attendances);
        return new PetEntity(
            $persisted_pet->id,
            new PetName($persisted_pet->name),
            new PetType($persisted_pet->type),
            $attendances
        );
    }
}
