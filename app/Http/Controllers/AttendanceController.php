<?php

namespace App\Http\Controllers;

use App\Cases\Attendance\AddAttendance;
use App\Cases\Attendance\DestroyAttendance;
use App\Cases\Attendance\ListAttendance;
use App\Cases\Attendance\ShowAttendance;
use App\Cases\Attendance\UpdateAttendance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $list_attendances = new ListAttendance();
            $attendances = $list_attendances->action();
            return new Response($attendances, Response::HTTP_OK);
        } catch (Exception $exception) {
            return new Response([$exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $add_attendance = new AddAttendance();
        $attendance = $add_attendance->action($request->all());
        return new Response($attendance, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $attendance_id
     * @return Response
     */
    public function show(int $attendance_id)
    {
        $show = new ShowAttendance();
        $attendance = $show->action($attendance_id);
        return new Response($attendance, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $attendance_id
     * @return Response
     */
    public function update(Request $request, int $attendance_id)
    {
        $update_attendance = new UpdateAttendance();
        $attendance = $update_attendance->action($attendance_id, $request->all());
        if ($attendance) {
            return new Response($attendance, Response::HTTP_OK);
        }
        return new Response("", Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $attendance_id
     * @return Response
     */
    public function destroy(int $attendance_id)
    {
        $destroy = new DestroyAttendance();
        if ($destroy->action($attendance_id)) {
            return new Response("", Response::HTTP_NO_CONTENT);
        }
        return new Response("", Response::HTTP_NOT_FOUND);
    }
}
