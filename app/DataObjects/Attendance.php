<?php


namespace App\DataObjects;

use App\Entities\AttendanceEntity;
use App\Entities\PetEntity;
use App\Models\Attendance as AttendanceModel;
use App\Repository\AttendanceRepository;
use App\ValueObjects\AttendanceDate;
use App\ValueObjects\AttendanceDescription;
use Exception;
use RuntimeException;

class Attendance implements AttendanceRepository
{
    /**
     * @param PetEntity $pet
     * @param AttendanceDate $date
     * @param AttendanceDescription $description
     * @return AttendanceEntity
     */
    public function add(PetEntity $pet, AttendanceDate $date, AttendanceDescription $description): AttendanceEntity
    {
        $attendance = new AttendanceModel();
        $attendance->pet_id = $pet->getId();
        $attendance->date = $date->__toString();
        $attendance->description = $description->__toString();
        $attendance->save();
        if ($attendance->exists) {
            return new AttendanceEntity(
                $attendance->id,
                $attendance->pet_id,
                new AttendanceDate($attendance->date),
                new AttendanceDescription($attendance->description)
            );
        }
        throw new RuntimeException("Invalid input to save Attendance");
    }

    public function destroy(int $id): bool
    {
        //Bypass entities, do it directly on Model
        try {
            $attendance = AttendanceModel::where('id', $id)->first();
            if ($attendance) {
                $attendance->delete();
                return TRUE;
            }
            return FALSE;
        } catch (Exception $exception) {
            return FALSE;
        }
    }

    public function update(AttendanceEntity $attendance): bool
    {
        $persisted_attendance = AttendanceModel::where('id', $attendance->getId())->firstOrFail();
        $persisted_attendance->pet_id = $attendance->getPet()->getId();
        $persisted_attendance->date = $attendance->getDate()->__toString();
        $persisted_attendance->description = $attendance->getDescription()->__toString();
        return $persisted_attendance->save();
    }

    public function retrieve(int $id): AttendanceEntity
    {
        $persisted_attendance = AttendanceModel::where('id', $id)->firstOrFail();
        return new AttendanceEntity(
            $persisted_attendance->id,
            $persisted_attendance->pet_id,
            new AttendanceDate($persisted_attendance->date),
            new AttendanceDescription($persisted_attendance->description)
        );
    }
}
