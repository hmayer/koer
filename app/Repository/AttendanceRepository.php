<?php


namespace App\Repository;

use App\Entities\AttendanceEntity;
use App\Entities\PetEntity;
use App\ValueObjects\AttendanceDate;
use App\ValueObjects\AttendanceDescription;

interface AttendanceRepository
{
    public function add(PetEntity $pet, AttendanceDate $date, AttendanceDescription $description): AttendanceEntity;
    public function destroy(int $id): bool;
    public function update(AttendanceEntity $attendance): bool;
    public function retrieve(int $id): AttendanceEntity;
}
