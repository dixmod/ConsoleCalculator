<?php

namespace Dixmod\Strategy;

interface OperationInterface
{
    public function calc(float $a, float $b): float;
}
