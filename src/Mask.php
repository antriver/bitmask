<?php

declare(strict_types=1);

namespace Abibidu\Bit;

class Mask implements \JsonSerializable
{
    const EMPTY_MASK = 0;

    const FLAG_1  = 1 << 0;  // 0b00000000000000000000000000000001  1
    const FLAG_2  = 1 << 1;  // 0b00000000000000000000000000000010  2
    const FLAG_3  = 1 << 2;  // 0b00000000000000000000000000000100  4
    const FLAG_4  = 1 << 3;  // 0b00000000000000000000000000001000  8
    const FLAG_5  = 1 << 4;  // 0b00000000000000000000000000010000  16
    const FLAG_6  = 1 << 5;  // 0b00000000000000000000000000100000  32
    const FLAG_7  = 1 << 6;  // 0b00000000000000000000000001000000  64
    const FLAG_8  = 1 << 7;  // 0b00000000000000000000000010000000  128
    const FLAG_9  = 1 << 8;  // 0b00000000000000000000000100000000  256
    const FLAG_10 = 1 << 9;  // 0b00000000000000000000001000000000  512
    const FLAG_11 = 1 << 10; // 0b00000000000000000000010000000000  1024
    const FLAG_12 = 1 << 11; // 0b00000000000000000000100000000000  2048
    const FLAG_13 = 1 << 12; // 0b00000000000000000001000000000000  4096
    const FLAG_14 = 1 << 13; // 0b00000000000000000010000000000000  8192
    const FLAG_15 = 1 << 14; // 0b00000000000000000100000000000000  16384
    const FLAG_16 = 1 << 15; // 0b00000000000000001000000000000000  32768
    const FLAG_17 = 1 << 16; // 0b00000000000000010000000000000000  65536
    const FLAG_18 = 1 << 17; // 0b00000000000000100000000000000000  131072
    const FLAG_19 = 1 << 18; // 0b00000000000001000000000000000000  262144
    const FLAG_20 = 1 << 19; // 0b00000000000010000000000000000000  524288
    const FLAG_21 = 1 << 20; // 0b00000000000100000000000000000000  1048576
    const FLAG_22 = 1 << 21; // 0b00000000001000000000000000000000  2097152
    const FLAG_23 = 1 << 22; // 0b00000000010000000000000000000000  4194304
    const FLAG_24 = 1 << 23; // 0b00000000100000000000000000000000  8388608
    const FLAG_25 = 1 << 24; // 0b00000001000000000000000000000000  16777216
    const FLAG_26 = 1 << 25; // 0b00000010000000000000000000000000  33554432
    const FLAG_27 = 1 << 26; // 0b00000100000000000000000000000000  67108864
    const FLAG_28 = 1 << 27; // 0b00001000000000000000000000000000  134217728
    const FLAG_29 = 1 << 28; // 0b00010000000000000000000000000000  268435456
    const FLAG_30 = 1 << 29; // 0b00100000000000000000000000000000  536870912
    const FLAG_31 = 1 << 30; // 0b01000000000000000000000000000000  1073741824
    const FLAG_32 = 1 << 31; // 0b10000000000000000000000000000000  2147483648

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
    public static function fromString(string $mask, bool $strictMode = true)
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
            throw MaskException::whenFlagIsPresentInMask($this, $flag);
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
            throw MaskException::whenFlagIsAbsentInMask($this, $flag);
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
