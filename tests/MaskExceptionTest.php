<?php

declare(strict_types=1);

namespace Abibidu\Bit;

class MaskExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Mask
     */
    private $mask;

    protected function setUp()
    {
        $this->mask = new Mask(Mask::FLAG_13);
    }

    public function testThatFlagIsPresentExceptionInstanceRight()
    {
        $this->assertInstanceOf(
            MaskException::class,
            MaskException::whenFlagIsPresentInMask($this->mask, Mask::FLAG_13)
        );
    }

    public function testThatFlagIsAbsentExceptionInstanceRight()
    {
        $this->assertInstanceOf(
            MaskException::class,
            MaskException::whenFlagIsAbsentInMask($this->mask, Mask::FLAG_7)
        );
    }

    public function testThatFlagIsPresentExceptionHasNeededInformation()
    {
        $message = MaskException::whenFlagIsPresentInMask($this->mask, Mask::FLAG_13)->getMessage();

        $this->assertContains(sprintf('%032b', $this->mask->get()), $message);
        $this->assertContains(sprintf('%032b', Mask::FLAG_13), $message);
    }

    public function testThatFlagIsAbsentExceptionHasNeededInformation()
    {
        $message = MaskException::whenFlagIsAbsentInMask($this->mask, Mask::FLAG_7)->getMessage();

        $this->assertContains(sprintf('%032b', $this->mask->get()), $message);
        $this->assertContains(sprintf('%032b', Mask::FLAG_7), $message);
    }
}
