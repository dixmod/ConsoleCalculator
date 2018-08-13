<?php

namespace Dixmod\Operations;


class Plus implements OperationInterface
{
    /**
     * @param float $a
     * @param float $b
     * @return float
     */
    public function calc(float $a, float $b): float
    {
        return $a + $b;
    }
}