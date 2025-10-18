<?php

namespace MathFunction;

trait Average
{
    public $average;
    public function GetAverage($values)
    {
        $this->average = (array_sum($values) / count($values));
        return $this->average;
    }
    public function display(): void
    {
        echo "<br>Display Average using Trait: " . $this->average;
    }
}


trait Percentage
{
    public $percentage = [];

    public function GetPercentage($values, $total)
    {

        foreach ($values as $name => $value) {
            $this->percentage[$name] = (string)(number_format((($value / $total) * 100), 2)) . "%";
        }
        return $this->percentage;
    }

    public function display(): void
    {
        foreach ($this->percentage as $name => $value) {
            echo "<br>name: " . $name . " : " . $value . "";
        }
    }
}


namespace App;

use MathFunction\Average;
use MathFunction\Percentage;

class Student
{
    use Average, Percentage {
        Average::display insteadof Percentage;
        Percentage::display as PercentageDisplay;
    }

    public $name;
    public $marks = [];
    public function __construct($name, $marks)
    {
        $this->name = $name;
        $this->marks = $marks;
    }
}
$obj = new Student("Aniket", ["Physics" => 36, "Chemistry" => 45, "Maths" => 45]);

echo "<br>Average :" . $obj->GetAverage($obj->marks);
var_dump($obj->GetPercentage($obj->marks, 50));

//Displaying The Average
$obj->display();

//Displaying The Average
$obj->PercentageDisplay();
