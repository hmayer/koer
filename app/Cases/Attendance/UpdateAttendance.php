<?php


namespace App\Cases\Attendance;


use App\DataObjects\Attendance;
use App\DataObjects\Pet;
use App\ValueObjects\AttendanceDate;
use App\ValueObjects\AttendanceDescription;

class UpdateAttendance
{
    public function action(int $id, array $params)
    {
        $attendance_data = new Attendance();
        $pet_data = new Pet();
        $pet = $pet_data->retrieve($params['pet_id']);
        $attendance = $attendance_data->retrieve($id);
        $attendance->setPet($pet);
        $attendance->setDate(new AttendanceDate($params['date']));
        $attendance->setDescription(new AttendanceDescription($params['description']));
        if ($attendance_data->update($attendance)) {
            return $attendance;
        }
        return FALSE;
    }
}
