<?php


namespace App\DataObjects;


use App\Entities\AttendanceEntity;
use App\ValueObjects\AttendanceDate;
use App\ValueObjects\AttendanceDescription;
use Illuminate\Database\Eloquent\Collection;
use JsonSerializable;

class AttendanceCollection implements JsonSerializable
{
    protected $attendances;
    protected array $attendances_entities;

    public function __construct($attendances)
    {
        $this->attendances = $attendances;
        $this->convertToEntity();
    }

    protected function convertToEntity(): void
    {
        $this->attendances_entities = []; //wipe old data
        foreach ($this->attendances as $attendance) {
            $this->attendances_entities[] = new AttendanceEntity(
                $attendance->id,
                $attendance->pet_id,
                new AttendanceDate($attendance->date),
                new AttendanceDescription($attendance->description)
            );
        }
    }

    /**
     * @return array
     */
    public function getAttendances(): array
    {
        return $this->attendances_entities;
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
        return $this->attendances_entities;
    }
}
