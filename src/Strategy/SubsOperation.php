<?php

namespace Dixmod\Strategy;


class SubsOperation implements OperationInterface
{
    public function calc(float $a, float $b): float
    {
        return $a - $b;
    }
}