<?php

namespace Dixmod\Strategy;


class PlusOperation implements OperationInterface
{
    public function calc(float $a, float $b): float
    {
        return $a + $b;
    }
}