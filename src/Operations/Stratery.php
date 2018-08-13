<?php

namespace Dixmod\Operations;

class Stratery
{
    /** @var OperationInterface */
    private $stratery;

    /**
     * Calculator constructor.
     * @param $operation
     * @throws \Exception
     */
    public function __construct($operation)
    {
        $this->stratery = $this->getStratery($operation);
    }

    /**
     * @param $operation
     * @return OperationInterface
     * @throws \Exception
     */
    public function getStratery($operation): OperationInterface
    {
        switch ($operation) {
            case '+' :
                return new Plus();
            case '-' :
                return new Subs();
            case '*' :
                return new Mult();
            case '/' :
                return new Div();
            default:
                throw new \Exception('Unknow operation');
        }
    }

    public function calc(float $a, float $b): float
    {
        return $this->stratery->calc($a, $b);
    }
}