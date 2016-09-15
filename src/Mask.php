<?php

namespace Abibidu\Bit;

class Mask
{
    /**
     * @var int
     */
    private $mask = 0;

    /**
     * @var bool
     */
    private $strictMode = true;

    /**
     * @param int  $mask
     * @param bool $strictMode
     */
    public function __construct(int $mask = 0, bool $strictMode = true)
    {
        $this->mask = $mask;
        $this->strictMode = $strictMode;
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
    public function getValue(): int
    {
        return $this->mask;
    }
}
