<?php

namespace Dixmod\Command;

use Dixmod\Operations\OperationInterface;
use Exception;
use ReflectionClass;
use Symfony\Component\Console\{
    Command\Command,
    Input\InputArgument,
    Input\InputInterface,
    Output\OutputInterface,
    Question\ChoiceQuestion,
    Question\Question
};

class Calculator extends Command
{
    protected const TYPES_OPERATION = [
        'Plus',
        'Subs',
        'Mult',
        'Div',
    ];
    protected $input;
    protected $output;
    protected $dialog;

    /** @var ReflectionClass */
    private $classOperation;

    /**
     *
     */
    protected function configure()
    {
        $this->setName('calc')
            ->setDescription('This command calculates the tow numbers')
            ->addArgument(
                'typeOperation',
                InputArgument::OPTIONAL,
                'Change operation for tow numbers: ' . join(', ', self::TYPES_OPERATION)
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->dialog = $this->getHelper('question');

        $inputTypeOperation = $this->askTypeOperation();
        $operation = $this->createOperation($inputTypeOperation);
        $params = $this->getParamsOperation();

        $output->writeln('Result: ' . call_user_func_array([$operation, 'calc'], $params));
    }

    /**
     * @param $inputTypeCalculate
     * @return OperationInterface
     * @throws \ReflectionException
     */
    private function createOperation($inputTypeCalculate): OperationInterface
    {
        // TODO: Refactor
        $classNameOperation = 'Dixmod\\Operations\\' . $inputTypeCalculate;
        if (!class_exists($classNameOperation)) {
            throw new Exception(
                'Error change type "' . $inputTypeCalculate . '" operation'
            );
        }

        // Получение класса операции
        $this->classOperation = new ReflectionClass($classNameOperation);

        // Создание экземпляра класса операции
        return $this->classOperation->newInstance();
    }

    private function getParamsOperation(): array
    {
        $methodOperation = $this->classOperation->getMethod('calc');

        // Получение списка параметров метода
        $paramsConstructorOperation = $methodOperation->getParameters();
        $valuesParamsConstructorOperation = [];

        // Запрос у пользователя значений параметров фигуры
        foreach ($paramsConstructorOperation as $index => $paramConstructorOperation) {
            $valuesParamsConstructorOperation[$index] = $this->askValueParam($paramConstructorOperation);
        }

        return $valuesParamsConstructorOperation;
    }


    /**
     * @param $param
     * @return float
     */
    protected function askValueParam($param)
    {
        do {
            $question = new Question(
                '<question>Please input "' . $param->name . '": </question>',
                0
            );

            $valuesParam = $this->dialog->ask($this->input, $this->output, $question);
            $valuesParam = (float)$valuesParam;
        } while (!$this->isValidValuesParam($valuesParam));

        return $valuesParam;
    }

    /**
     * @param $value
     * @return bool
     */
    protected function isValidValuesParam($value)
    {
        return !empty($value);
    }

    /**
     * @param string $inputTypeOperation
     * @return bool
     */
    protected function isValidTypeOperation(string $inputTypeOperation)
    {
        return in_array($inputTypeOperation, self::TYPES_OPERATION);
    }

    /**
     * @return string
     */
    private function askTypeOperation(): string
    {
        $inputTypeOperation = $this->input->getArgument('typeOperation');
        $inputTypeOperation = ucfirst($inputTypeOperation);

        if (!$this->isValidTypeOperation($inputTypeOperation)) {
            $question = new ChoiceQuestion(
                '<question>Please select operation for two numbers:</question>',
                self::TYPES_OPERATION
            );

            $question->setErrorMessage('Operation %s is invalid.');
            $inputTypeOperation = $this->dialog->ask($this->input, $this->output, $question);
        }

        return $inputTypeOperation;
    }
}