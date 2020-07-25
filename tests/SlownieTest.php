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

    public function testIs1CorrectInteger(): void
    {
        $this->assertSame('jeden złoty', Slownie::convert(1));
    }

    public function testIs1CorrectString(): void
    {
        $this->assertSame('jeden złoty', Slownie::convert('1'));
    }

    public function testIs1CorrectFloat(): void
    {
        $this->assertSame('jeden złoty', Slownie::convert(1.00));
    }

    public function testIs10Correct(): void
    {
        $this->assertSame('dziesięć złotych', Slownie::convert(10));
    }

    public function testIs100Correct(): void
    {
        $this->assertSame('sto cztery złote', Slownie::convert(104));
    }

    public function testIs1000Correct(): void
    {
        $this->assertSame('jeden tysiąc osiem złotych', Slownie::convert(1008));
    }

    public function testIs10000Correct(): void
    {
        $this->assertSame('dziesięć tysięcy trzysta czterdzieści osiem złotych', Slownie::convert('10 348'));
    }
}
