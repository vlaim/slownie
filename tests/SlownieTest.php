<?php
declare(strict_types=1);

namespace Slownie;

use PHPUnit\Framework\TestCase;

final class SlownieTest extends TestCase
{
    public function testIsSlownieClassCorrectlyLoaded(): void
    {
        $this->assertTrue(class_exists('Slownie\Slownie'));
    }

    public function testIsNegativeNumberThrowsException(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Provided number should be positive');
        Slownie::convert('-1');
    }

    public function testIsTooBigNumberThrowsException(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Provided number is too big');
        Slownie::convert(1000000000000000000);
    }

    public function testIsZeroCorrect(): void
    {
        $this->assertSame('zero złotych 00/100', Slownie::convert(0));
    }

    public function testIsDecimalBelowOneCorrect(): void
    {
        $this->assertSame('zero złotych 99/100', Slownie::convert(0.99));
    }

    public function testIsSingleDigitCorrect(): void
    {
        $this->assertSame('osiem złotych 00/100', Slownie::convert(8));
    }

    public function testIsRoundingCorrect(): void
    {
        $this->assertSame('jeden złoty 46/100', Slownie::convert(1.456));
    }

    public function testIsLargeNumberCorrect(): void
    {
        $this->assertSame('dziewięćdziesiąt dziewięć milionów dziewięćset dziewięćdziesiąt dziewięć tysięcy dziewięćset dziewięćdziesiąt dziewięć złotych 99/100', Slownie::convert(99999999.99));
    }

    public function testIsTrailingZerosHandledCorrectly(): void
    {
        $this->assertSame('sto złotych 00/100', Slownie::convert(100.00));
    }

    public function testIsCommaAsDecimalSeparatorHandled(): void
    {
        $this->assertSame('trzy złote 50/100', Slownie::convert('3,50'));
    }

    public function testIsWhitespaceInInputHandled(): void
    {
        $this->assertSame('czterysta pięćdziesiąt sześć złotych 78/100', Slownie::convert('  456.78  '));
    }

    public function testIsIntegerAsStringWithSpacesCorrect(): void
    {
        $this->assertSame('jeden milion złotych 00/100', Slownie::convert('1 000 000'));
    }

    public function testIsMixedIntegerAndFloatHandling(): void
    {
        $this->assertSame('dwa tysiące pięćset złotych 50/100', Slownie::convert(2500.5));
    }

    public function testIsHandlingLargeRoundNumbers(): void
    {
        $this->assertSame('pięćdziesiąt milionów złotych 00/100', Slownie::convert(50000000));
    }

    public function testIsHideGroszeCorrect(): void
    {
        $this->assertSame('dwanaście milionów trzysta trzynaście tysięcy sto dwadzieścia trzy złote', Slownie::convert(12313123.38, true));
    }

    public function testIsHideGroszeAndHideZloteCorrect(): void
    {
        $this->assertSame('dwanaście milionów trzysta trzynaście tysięcy sto dwadzieścia trzy', Slownie::convert(12313123.38, true, true));
    }

    public function testIsHideZloteCorrect(): void
    {
        $this->assertSame('dwanaście milionów trzysta trzynaście tysięcy sto dwadzieścia trzy 38/100', Slownie::convert(12313123.38, false, true));
    }
}
