<?php


namespace App\ValueObjects;


use JsonSerializable;
use RuntimeException;

class PetName implements JsonSerializable
{
    const MIN_SIZE = 2;
    protected ?string $name = null;

    /**
     * Validates Pet name rules
     * @param string|null $name
     * @return bool
     */
    protected function isValid(?string $name): bool
    {
        if (!is_null($name)) {
            if (strlen($name) > self::MIN_SIZE) {
                return TRUE;
            }
        }
        return FALSE;
    }

    /**
     * PetName constructor.
     * @param string|null $name
     */
    public function __construct(?string $name)
    {
        if (!$this->isValid($name)) {
            throw new RuntimeException("Pet name '{$name}' is invalid");
        }
        $this->name = $name;
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
        return $this->name;
    }
}
