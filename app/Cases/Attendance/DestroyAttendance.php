<?php


namespace App\Cases\Attendance;


use App\DataObjects\Attendance;

class DestroyAttendance
{
    public function action(int $id)
    {
        $attendance_data = new Attendance();
        return $attendance_data->destroy($id);
    }
}
