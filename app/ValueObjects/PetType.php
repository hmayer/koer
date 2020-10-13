<?php


namespace App\ValueObjects;

use JsonSerializable;
use RuntimeException;

class PetType implements JsonSerializable
{
    const SIZE = 1; //it's a single char
    const ENUM_OPTIONS = ['C', 'G']; // C - for dogs, G - for cats
    protected ?string $type = null;

    /**
     * Validates Pet type
     * @param string|null $type
     * @return bool
     */
    protected function isValid(?string $type): bool
    {
        if (
            !is_null($type)
            && strlen($type) == self::SIZE
            && in_array($type, self::ENUM_OPTIONS)) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * PetType constructor.
     * @param string|null $type
     */
    public function __construct(?string $type)
    {
        if (!$this->isValid($type)) {
            throw new RuntimeException("Pet type '{$type}' is invalid");
        }
        $this->type = $type;
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
        return $this->type;
    }
}
