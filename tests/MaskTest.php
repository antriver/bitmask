<?php

declare(strict_types=1);

namespace Abibidu\Bit;

class MaskTest extends \PHPUnit_Framework_TestCase
{
    const TEST_MASK = 42;

    public function testMaskGetter()
    {
        $mask = new Mask(self::TEST_MASK);

        $this->assertSame(self::TEST_MASK, $mask->get());
        $this->assertNotSame((string) self::TEST_MASK, $mask->get());
    }

    public function testMaskAsStringBehaviour()
    {
        $mask = new Mask(self::TEST_MASK);

        $this->assertSame((string) self::TEST_MASK, $mask->__toString());
        $this->assertNotSame(self::TEST_MASK, $mask->__toString());
    }
}
