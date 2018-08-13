<?php

declare(strict_types=1);

include_once './vendor/autoload.php';

use Dixmod\Operations\Stratery;
use PHPUnit\Framework\TestCase;

final class TestCalc extends TestCase
{
    /**
     * @throws Exception
     */
    public function testPlus(): void
    {
        $operation = new Stratery('+');
        $a = mt_rand(0, 10000);
        $b = mt_rand(0, 10000);
        $this->assertEquals(
            $a + $b,
            $operation->calc($a, $b)
        );
    }

    public function testSubs(): void
    {
        $operation = new Stratery('-');
        $a = mt_rand(0, 10000);
        $b = mt_rand(0, 10000);
        $this->assertEquals(
            $a - $b,
            $operation->calc($a, $b)
        );
    }

    /**
     * @throws Exception
     */
    public function testMult(): void
    {
        $operation = new Stratery('*');
        $a = mt_rand(0, 10000);
        $b = mt_rand(0, 10000);
        $this->assertEquals(
            $a * $b,
            $operation->calc($a, $b)
        );
    }

    /**
     * @throws Exception
     */
    public function testDivs(): void
    {
        $operation = new Stratery('/');
        $a = 30;
        $b = 6;
        $this->assertEquals(
            $a / $b,
            $operation->calc($a, $b)
        );
    }

    /**
     * @throws Exception
     */
    public function testDivsByZerro(): void
    {
        $operation = new Stratery('/');
        $this->expectException(\Exception::class);
        $a = mt_rand(0, 10000);
        $b = 0;
        $operation->calc($a, $b);
    }
}
