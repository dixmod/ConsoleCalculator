<?php

namespace Dixmod\Strategy;


class MultOperation implements OperationInterface
{
    public function calc(float $a, float $b): float
    {
        return $a * $b;
    }
}