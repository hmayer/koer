<?php


namespace App\Cases\Attendance;



use App\DataObjects\AttendanceCollection;
use App\Models\Attendance as AttendanceModel;

class ListAttendance
{
    public function action(): AttendanceCollection
    {
        $attendances = AttendanceModel::paginate()->all();
        return new AttendanceCollection($attendances);
    }
}
