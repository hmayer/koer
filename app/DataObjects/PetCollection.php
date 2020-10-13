<?php


namespace App\DataObjects;


use App\Entities\PetEntity;
use App\ValueObjects\PetName;
use App\ValueObjects\PetType;
use JsonSerializable;

class PetCollection implements JsonSerializable
{
    protected array $pets;
    protected array $pets_entities;

    public function __construct(array $pets)
    {
        $this->pets = $pets;
        $this->convertToEntity();
    }

    protected function convertToEntity(): void
    {
        $this->pets_entities = []; //wipe old data
        foreach ($this->pets as $pet) {
            $this->pets_entities[] = new PetEntity(
                $pet->id,
                new PetName($pet->name),
                new PetType($pet->type)
            );
        }
    }

    /**
     * @return array
     */
    public function getPets(): array
    {
        return $this->pets_entities;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize()
    {
        return $this->pets_entities;
    }
}
