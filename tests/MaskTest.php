<?php

declare(strict_types=1);

namespace Abibidu\Bit;

class MaskTest extends \PHPUnit_Framework_TestCase
{
    const TEST_MASK_INT = 42;
    const TEST_MASK_STRING = '42';

    public function testMaskGetter()
    {
        $mask = new Mask(self::TEST_MASK_INT);

        $this->assertSame(self::TEST_MASK_INT, $mask->get());
        $this->assertNotSame(self::TEST_MASK_STRING, $mask->get());
    }

    public function testMaskAsStringBehaviour()
    {
        $mask = new Mask(self::TEST_MASK_INT);

        $this->assertSame(self::TEST_MASK_STRING, $mask->__toString());
        $this->assertNotSame(self::TEST_MASK_INT, $mask->__toString());
    }
}
