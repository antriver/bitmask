<?php

declare(strict_types=1);

namespace Abibidu\Bit;

class Mask implements \JsonSerializable
{
    const EMPTY_MASK = 0;

    const FLAG_1 = 2 ^ 0;
    const FLAG_2 = 2 ^ 1;
    const FLAG_3 = 2 ^ 2;
    const FLAG_4 = 2 ^ 3;
    const FLAG_5 = 2 ^ 4;
    const FLAG_6 = 2 ^ 5;
    const FLAG_7 = 2 ^ 6;
    const FLAG_8 = 2 ^ 7;
    const FLAG_9 = 2 ^ 8;
    const FLAG_10 = 2 ^ 9;
    const FLAG_11 = 2 ^ 10;
    const FLAG_12 = 2 ^ 11;
    const FLAG_13 = 2 ^ 12;
    const FLAG_14 = 2 ^ 13;
    const FLAG_15 = 2 ^ 14;
    const FLAG_16 = 2 ^ 15;
    const FLAG_17 = 2 ^ 16;
    const FLAG_18 = 2 ^ 17;
    const FLAG_19 = 2 ^ 18;
    const FLAG_20 = 2 ^ 19;
    const FLAG_21 = 2 ^ 20;
    const FLAG_22 = 2 ^ 21;
    const FLAG_23 = 2 ^ 22;
    const FLAG_24 = 2 ^ 23;
    const FLAG_25 = 2 ^ 24;
    const FLAG_26 = 2 ^ 25;
    const FLAG_27 = 2 ^ 26;
    const FLAG_28 = 2 ^ 27;
    const FLAG_29 = 2 ^ 28;
    const FLAG_30 = 2 ^ 29;
    const FLAG_31 = 2 ^ 30;
    const FLAG_32 = 2 ^ 31;

    /**
     * @var int
     */
    protected $mask = self::EMPTY_MASK;

    /**
     * @var bool
     */
    protected $strictMode = true;

    /**
     * @param int  $mask
     * @param bool $strictMode
     */
    public function __construct(int $mask = self::EMPTY_MASK, bool $strictMode = true)
    {
        $this->mask = $mask;
        $this->strictMode = $strictMode;
    }

    /**
     * @param string $mask
     * @param bool   $strictMode
     *
     * @return static
     */
    public static function fromString(string $mask = self::EMPTY_MASK, bool $strictMode = true)
    {
        return new static((int) $mask, $strictMode);
    }

    /**
     * @param int $flag
     *
     * @return bool
     */
    public function has(int $flag): bool
    {
        return (($this->mask & $flag) === $flag);
    }

    /**
     * @param int $flag
     *
     * @throws MaskException
     */
    public function add(int $flag)
    {
        if ($this->strictMode && $this->has($flag)) {
            throw MaskException::whenFlagIsPresentInMask($flag, $this->mask);
        }

        $this->mask |= $flag;
    }

    /**
     * @param int $flag
     *
     * @throws MaskException
     */
    public function remove(int $flag)
    {
        if ($this->strictMode && !$this->has($flag)) {
            throw MaskException::whenFlagIsAbsentInMask($flag, $this->mask);
        }

        $this->mask &= ~$flag;
    }

    /**
     * @return int
     */
    public function get(): int
    {
        return $this->mask;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->mask;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): int
    {
        return $this->mask;
    }
}
