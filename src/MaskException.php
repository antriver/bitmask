<?php

namespace Abibidu\Bit;

final class MaskException extends \Exception
{
    /**
     * @param int $flag
     * @param int $mask
     *
     * @return self
     */
    public static function whenFlagIsPresentInMask(int $flag, int $mask): self
    {
        return new self(sprintf('The flag %032b is already present in mask %032b', $flag, $mask));
    }

    /**
     * @param int $flag
     * @param int $mask
     *
     * @return self
     */
    public static function whenFlagIsAbsentInMask(int $flag, int $mask): self
    {
        return new self(sprintf('The flag %032b is absent in mask %032b', $flag, $mask));
    }
}
