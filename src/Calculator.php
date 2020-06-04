<?php

class Calculator
{
    public static function calculate(int $number1, int $number2, callable $callback): float
    {
        return $callback($number2, $number1);
    }
}

class Multiple
{
    public function calculate(int $number1, int $number2): float
    {
        return $number1 * $number2;
    }
}

class Divider
{
    public function __invoke(int $number1, int $number2): float
    {
        return $number1 / $number2;
    }
}

function subtraction(int $number1, int $number2): float
{
    return $number1 - $number2;
}

echo '<a href="/">Вернуться на главную</a> <br/>';

$pairs = [
    [5, 10],
    [10, 15],
    [546, 761]
];

$callbacks = [];
$callbacks[] = function (int $number1, int $number2): float {
    return $number1 + $number2;
};

$callbacks[] = 'subtraction';

$callbacks[] = [Multiple::class, 'calculate'];

$callbacks[] = new Divider();

$calculator = new Calculator();
$i = 1;
foreach ($pairs as $pair) {
    foreach ($callbacks as $callback) {
        echo $i++ . ') ' . $calculator::calculate($pair[0], $pair[1], $callback) . '<br/>';
    }
}
