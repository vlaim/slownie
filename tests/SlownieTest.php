<?php
declare(strict_types=1);

namespace Slownie;

use PHPUnit\Framework\TestCase;

final class SlownieTest extends TestCase
{
    public function testIsSlownieClassCorrectlyLoaded()
    {
        $this->assertTrue(class_exists('Slownie\Slownie'));

    }

//    public function testIs()
//    {
//        $result1 = Slownie::convert('130444');
//
//        var_dump($result1);
//    }
}
