<?php


namespace App\Entities;


use App\DataObjects\Pet;
use App\ValueObjects\AttendanceDate;
use App\ValueObjects\AttendanceDescription;
use JsonSerializable;

class AttendanceEntity implements JsonSerializable
{
    protected ?int $id = null;
    protected ?int $pet_id = null;
    protected ?AttendanceDate $date = null;
    protected ?AttendanceDescription $description = null;
    protected bool $showPet = FALSE;

    /**
     * PetEntity constructor.
     * @param int|null $id
     * @param int $pet_id
     * @param AttendanceDate $date
     * @param AttendanceDescription $description
     */
    public function __construct(?int $id, int $pet_id, AttendanceDate $date, AttendanceDescription $description)
    {
        $this->id = $id;
        $this->pet_id = $pet_id;
        $this->date = $date;
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return PetEntity
     */
    public function getPet(): PetEntity
    {
        $pet_data = new Pet();
        return $pet_data->retrieve($this->pet_id);
    }

    /**
     * @param PetEntity $pet
     */
    public function setPet(PetEntity $pet): void
    {
        $this->pet_id = $pet->getId();
    }

    /**
     * @return AttendanceDate|null
     */
    public function getDate(): ?AttendanceDate
    {
        return $this->date;
    }

    /**
     * @param AttendanceDate|null $date
     */
    public function setDate(?AttendanceDate $date): void
    {
        $this->date = $date;
    }

    /**
     * @return AttendanceDescription|null
     */
    public function getDescription(): ?AttendanceDescription
    {
        return $this->description;
    }

    /**
     * @param AttendanceDescription|null $description
     */
    public function setDescription(?AttendanceDescription $description): void
    {
        $this->description = $description;
    }

    public function withPet(bool $show)
    {
        $this->showPet = $show;
    }

    public function jsonSerialize()
    {
         $json = [
            'id' => $this->getId(),
            'date' => $this->getDate()->__toString(),
            'description' => $this->getDescription()->__toString()
         ];
         if ($this->showPet) {
             $json['pet'] = $this->getPet();
         }
         return $json;
    }
}
