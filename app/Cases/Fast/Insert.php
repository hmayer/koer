<?php


namespace App\Cases\Fast;


use App\DataObjects\Attendance;
use App\DataObjects\Pet;
use App\Entities\PetEntity;
use App\ValueObjects\AttendanceDate;
use App\ValueObjects\AttendanceDescription;
use App\ValueObjects\PetName;
use App\ValueObjects\PetType;

class Insert
{
    public function action(array $params)
    {
        $pet_data = new Pet();
        $attendance_data = new Attendance();

        $pet = $pet_data->add(
            new PetName($params['name']),
            new PetType($params['type'])
        );

        $attendance = $attendance_data->add(
            $pet,
            new AttendanceDate($params['date']),
            new AttendanceDescription($params['description'])
        );

        $attendance->withPet(TRUE);
        return $attendance;
    }
}
