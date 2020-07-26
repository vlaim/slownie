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
        $message = '';

        try {
            Slownie::convert('-1');
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }

        $this->assertEquals($message, 'Provided number should be positive');
    }

    public function testIsTooBigNumberThrowsException(): void
    {
        $message = '';

        try {
            Slownie::convert(1000000000000000000);
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }

        $this->assertEquals($message, 'Provided number is too big');
    }

    public function testIs1CorrectInteger(): void
    {
        $this->assertSame('jeden złoty 23/100', Slownie::convert(1.23));
    }

    public function testIs1CorrectString(): void
    {
        $this->assertSame('jeden złoty 00/100', Slownie::convert('1'));
    }

    public function testIs1CorrectFloat(): void
    {
        $this->assertSame('jeden złoty 01/100', Slownie::convert(1.01));
    }

    public function testIs10Correct(): void
    {
        $this->assertSame('dziesięć złotych 89/100', Slownie::convert(10.89));
    }

    public function testIs100CorrectInteger(): void
    {
        $this->assertSame('sto cztery złote 10/100', Slownie::convert(104.10));
    }

    public function testIs100CorrectFloat(): void
    {
        $this->assertSame('osiemset siedemdziesiąt siedem złotych 88/100', Slownie::convert(877.88));
    }

    public function testIs100CorrectString(): void
    {
        $this->assertSame('dziewięćset czterdzieści pięć złotych 03/100', Slownie::convert('945.03'));
    }

    public function testIs1000CorrectInteger(): void
    {
        $this->assertSame('jeden tysiąc osiem złotych 00/100', Slownie::convert(1008));
    }

    public function testIs1000CorrectFloat(): void
    {
        $this->assertSame('dziewięć tysięcy dziewięćset dziewięćdziesiąt dziewięć złotych 34/100', Slownie::convert(9999.34));
    }

    public function testIs10000CorrectFloat(): void
    {
        $this->assertSame('piętnaście tysięcy sześćset sześćdziesiąt osiem złotych 33/100', Slownie::convert(15668.333));
    }

    public function testIs10000000CorrectFloat(): void
    {
        $this->assertSame('dziesięć milionów złotych 00/100', Slownie::convert(10000000));
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

    public function testIsIntegerAsStringWithSpacesCorrect(): void
    {
        $this->assertSame('jeden milion złotych 00/100', Slownie::convert('1 000 000'));
    }
}
