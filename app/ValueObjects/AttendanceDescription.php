<?php


namespace App\ValueObjects;


use RuntimeException;

class AttendanceDescription
{
    protected ?string $description = null;

    /**
     * Validates Attendance Description rules
     * @param string|null $description
     * @return bool
     */
    protected function isValid(?string $description): bool
    {
        // optional field
        $this->description = $description;
        return TRUE;
    }

    /**
     * AttendanceDescription constructor.
     * @param string|null $description
     */
    public function __construct(?string $description)
    {
        if (!$this->isValid($description)) {
            throw new RuntimeException("Attendance description '{$description}' is invalid");
        }
        $this->description = $description;
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
        return $this->description;
    }
}
