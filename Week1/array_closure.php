<?php

//Array Closure Example  One
$a = 10;
$b = 20;
$arr = array();
$arr["ADD"] = function () use ($a, $b) {
    echo "Addition is:" . $a + $b . "<br>";
};
$out = $arr["ADD"];
$out();


// Passing the address of a variable as a argumnet.
$incremented_Number = 10;
echo "Original number:" . $incremented_Number . "<br>";
$increment = function () use (&$incremented_Number) {
    $incremented_Number++;
};
$increment();
echo "Number Incremented using Its Address:" . $incremented_Number . "<br>";




//Binding Array Closure using  A loop

$multiples = [10, 20, 30];

foreach ($multiples as $multiple) {
    $results[] = function ($number) use ($multiple) {
        return $number * $multiple;
    };
}
// echo "Value:".$results[2](9)."<Br>";
foreach ($results as $result) {
    echo "value: " . $result(3) . " ";
}




class Scope
{

    private $property = 'default';

    public function run()
    {
        $self = $this;
        $func = function () use ($self) {
            $self->property = 'changed';
        };

        $func();
        var_dump($this->property);
    }
}

$scope = new Scope();
$scope->run();

$message = "aniket";
$example = function () use ($message): string {
    return "hello $message";
};

var_dump($example());
