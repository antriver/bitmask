<?php

declare(strict_types=1);

namespace Abibidu\Bit;

class MaskExceptionTest extends \PHPUnit_Framework_TestCase
{
    const TEST_MASK = 73;
    const TEST_FLAG = 32;

    public function testThatFlagIsPresentExceptionInstanceRight()
    {
        $this->assertInstanceOf(
            MaskException::class,
            MaskException::whenFlagIsPresentInMask(self::TEST_FLAG, self::TEST_MASK)
        );
    }

    public function testThatFlagIsAbsentExceptionInstanceRight()
    {
        $this->assertInstanceOf(
            MaskException::class,
            MaskException::whenFlagIsAbsentInMask(self::TEST_FLAG, self::TEST_MASK)
        );
    }

    public function testThatFlagIsPresentExceptionHasNeededInformation()
    {
        $message = MaskException::whenFlagIsPresentInMask(self::TEST_FLAG, self::TEST_MASK)->getMessage();

        $this->assertContains(sprintf('%032b', self::TEST_FLAG), $message);
        $this->assertContains(sprintf('%032b', self::TEST_MASK), $message);
    }

    public function testThatFlagIsAbsentExceptionHasNeededInformation()
    {
        $message = MaskException::whenFlagIsAbsentInMask(self::TEST_FLAG, self::TEST_MASK)->getMessage();

        $this->assertContains(sprintf('%032b', self::TEST_FLAG), $message);
        $this->assertContains(sprintf('%032b', self::TEST_MASK), $message);
    }
}
