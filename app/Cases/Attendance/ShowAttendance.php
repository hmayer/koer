<?php


namespace App\Cases\Attendance;


use App\DataObjects\Attendance;
use App\Entities\AttendanceEntity;

class ShowAttendance
{
    public function action(int $id): AttendanceEntity
    {
        $attendance_data = new Attendance();
        $attendance = $attendance_data->retrieve($id);
        $attendance->withPet(TRUE);
        return $attendance;
    }
}
