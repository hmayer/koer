<?php


namespace App\Entities;


use App\DataObjects\AttendanceCollection;
use App\Models\Attendance;
use App\ValueObjects\PetName;
use App\ValueObjects\PetType;
use JsonSerializable;

class PetEntity implements JsonSerializable
{
    protected ?int $id = null;
    protected ?PetName $name = null;
    protected ?PetType $type = null;
    protected ?AttendanceCollection $attendances = null;
    protected bool $showAttendance = FALSE;

    /**
     * PetEntity constructor.
     * @param int|null $id
     * @param PetName $name
     * @param PetType $type
     * @param AttendanceCollection|null $attendances
     */
    public function __construct(?int $id, PetName $name, PetType $type, ?AttendanceCollection $attendances = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->attendances = $attendances;
    }

    /**
     * @return AttendanceCollection|null
     */
    public function getAttendances(): ?array
    {
        if ($this->attendances) {
            return $this->attendances->getAttendances();
        }
        return [];
    }

    /**
     * @param AttendanceCollection|null $attendances
     */
    public function setAttendances(?AttendanceCollection $attendances): void
    {
        $this->attendances = $attendances;
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
     * @return PetName|null
     */
    public function getName(): ?PetName
    {
        return $this->name;
    }

    /**
     * @param PetName|null $name
     */
    public function setName(?PetName $name): void
    {
        $this->name = $name;
    }

    /**
     * @return PetType|null
     */
    public function getType(): ?PetType
    {
        return $this->type;
    }

    /**
     * @param PetType|null $type
     */
    public function setType(?PetType $type): void
    {
        $this->type = $type;
    }

    public function withAttendance(bool $show)
    {
        $this->showAttendance = $show;
    }

    public function jsonSerialize()
    {
        $json = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'type' => $this->getType()
        ];
        if ($this->showAttendance) {
            $json['attendances'] = $this->getAttendances();
        }
        return $json;
    }
}
