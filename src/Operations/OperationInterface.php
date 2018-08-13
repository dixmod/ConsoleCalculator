<?php

namespace Dixmod\Operations;

interface OperationInterface
{
    /**
     * @param float $a
     * @param float $b
     * @return float
     */
    public function calc(float $a, float $b): float;
}
