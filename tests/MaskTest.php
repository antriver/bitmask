<?php

declare(strict_types=1);

namespace Abibidu\Bit;

class MaskTest extends \PHPUnit_Framework_TestCase
{
    const TEST_MASK = 42;

    public function testGetter()
    {
        $mask = new Mask(self::TEST_MASK);

        $this->assertSame(self::TEST_MASK, $mask->get());
        $this->assertNotSame((string) self::TEST_MASK, $mask->get());
    }

    public function testToStringBehaviour()
    {
        $mask = new Mask(self::TEST_MASK);

        $this->assertSame((string) self::TEST_MASK, $mask->__toString());
        $this->assertNotSame(self::TEST_MASK, $mask->__toString());
    }

    public function testNamedConstructorForString()
    {
        $mask = Mask::fromString((string) self::TEST_MASK);

        $this->assertSame(self::TEST_MASK, $mask->get());
    }

    public function testToJsonBehaviour()
    {
        $mask = new Mask(self::TEST_MASK);

        $this->assertSame(json_encode(['mask' => self::TEST_MASK]), json_encode(['mask' => $mask]));
    }

    public function testIfHasFlag()
    {
        $mask = new Mask(Mask::EMPTY_MASK | Mask::FLAG_13);

        $this->assertFalse($mask->has(Mask::FLAG_3));
        $this->assertTrue($mask->has(Mask::FLAG_13));
    }

    public function testConstants()
    {
        $reflection = new \ReflectionClass(Mask::class);

        for ($i = 1; $i <= 32; $i++) {
            $this->assertSame(pow(2, $i - 1), $reflection->getConstant('FLAG_' . $i));
        }
    }

    public function testFlagAddition()
    {
        $mask = new Mask();

        $mask->add(Mask::FLAG_9);
        $mask->add(Mask::FLAG_21);

        $this->assertTrue($mask->has(Mask::FLAG_9));
        $this->assertTrue($mask->has(Mask::FLAG_21));
    }

    public function testFlagRemoval()
    {
        $mask = new Mask(Mask::FLAG_9 | Mask::FLAG_21);

        $this->assertTrue($mask->has(Mask::FLAG_9));
        $this->assertTrue($mask->has(Mask::FLAG_21));

        $mask->remove(Mask::FLAG_9);
        $mask->remove(Mask::FLAG_21);

        $this->assertFalse($mask->has(Mask::FLAG_9));
        $this->assertFalse($mask->has(Mask::FLAG_21));
    }

    /**
     * @expectedException \Abibidu\Bit\MaskException
     */
    public function testAlreadyPresentFlagAddition()
    {
        $mask = new Mask(Mask::FLAG_13);

        $mask->add(Mask::FLAG_13);
    }

    /**
     * @expectedException \Abibidu\Bit\MaskException
     */
    public function testAbsentFlagRemoval()
    {
        $mask = new Mask();

        $mask->remove(Mask::FLAG_13);
    }
}
