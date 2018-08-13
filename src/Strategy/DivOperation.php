<?php

namespace Dixmod\Strategy;


class DivOperation implements OperationInterface
{
    /**
     * @param int $a
     * @param int $b
     * @return int
     * @throws \Exception
     */
    public function calc(float $a, float $b): float
    {
        if (!$b) {
            throw new \Exception('Division by zero');
        }
        return floor($a / $b);
    }
}