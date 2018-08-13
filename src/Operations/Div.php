<?php

namespace Dixmod\Operations;


class Div implements OperationInterface
{
    /**
     * @param float $a
     * @param float $b
     * @return float
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