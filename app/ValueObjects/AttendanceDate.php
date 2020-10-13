<?php


namespace App\ValueObjects;


use RuntimeException;

class AttendanceDate
{
    const SIZE = 10;
    protected ?string $date = null;

    /**
     * Validates Attendance date rules
     * @param string|null $date
     * @return bool
     */
    protected function isValid(?string $date): bool
    {
        if (
            !is_null($date)
            && strlen($date) == self::SIZE
            && preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)
        ){
            $year = substr($date, 0, 4);
            $month = substr($date,5,2);
            $day = substr($date, 8, 2);

            if (checkdate($month, $day, $year)) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * AttendanceDate constructor.
     * @param string|null $date
     */
    public function __construct(?string $date)
    {
        if (!$this->isValid($date)) {
            throw new RuntimeException("Attendance date '{$date}' is invalid");
        }
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return $this->__toString();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->date;
    }
}
