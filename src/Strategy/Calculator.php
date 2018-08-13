<?php

namespace Dixmod\Strategy;

class Calculator
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
                return new PlusOperation();
            case '-' :
                return new SubsOperation();
            case '*' :
                return new MultOperation();
            case '/' :
                return new DivOperation();
            default:
                throw new \Exception('Unknow operation');
        }
    }

    public function calc(): float
    {
        return $this->stratery->calc($a, $b);
    }
}