<?php


namespace App\Cases\Attendance;



use App\DataObjects\Attendance;
use App\DataObjects\Pet;
use App\Entities\AttendanceEntity;
use App\ValueObjects\AttendanceDate;
use App\ValueObjects\AttendanceDescription;

class AddAttendance
{
    public function action(?array $params): AttendanceEntity
    {
        $pet_data = new Pet();
        $pet = $pet_data->retrieve($params['pet_id']);
        $date = new AttendanceDate($params['date']);
        $description = new AttendanceDescription($params['description']);
        $attendance = new Attendance();
        return $attendance->add($pet, $date, $description);
    }
}
