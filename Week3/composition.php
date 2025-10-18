<?php

use function PHPSTORM_META\type;

class Student
{
    public $name;
    public $marks = [];
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return "<br>" . $this->name;
    }
}


class Test
{
    public $type;
    public function __construct($type)
    {
        $this->type = $type;
    }
    public function setValue(Student $std, $marks)
    {
        $std->marks = $marks;
    }
    public function GetAverage(Student $std)
    {
        return "<br>" . $std->name . "  has Received an Average Of " . array_sum($std->marks) / count($std->marks) . " in " . $this->type . "<br>";
    }
    public function GetPercentage(Student $std)
    {
        $Total = ($this->type === "ClassTest") ? 50 : 100;
        $perctenage = [];
        foreach ($std->marks as $name => $value) {
            $perctenage[$name] = (string)(number_format((($value / $Total) * 100), 2)) . "%";
        }
        return $perctenage;
    }
}

$std1 = new Student("Aniket");
$Ctest = new Test("ClassTest");
$Ctest->setValue($std1, ["Physics" => 30, "Chemistry" => 42, "Maths" => 30, "Economics" => 25]);
echo "<h4><b>" . $std1->getName() . " Examination Result Are as Follows</b></h2>";
echo "<pre>";
echo $Ctest->GetAverage($std1);
print_r($Ctest->GetPercentage($std1));


$std2 = new Student("Ajay");
$Ctest = new Test("ClassTest");
$Ctest->setValue($std2, ["Physics" => 15, "Chemistry" => 22, "Maths" => 33, "Economics" => 45]);
echo "<h4><b>" . $std2->getName() . " Examination Result Are as Follows</b></h2>";
echo "<pre>";
echo $Ctest->GetAverage($std2);
print_r($Ctest->GetPercentage($std2));


$Ctest2 = new Test("Sem End");
// echo "<h4><b>" . $std2->getName() . " Examination Result Are as Follows</b></h2>";
echo "<pre>";
echo $Ctest2->GetAverage($std2);
print_r($Ctest2->GetPercentage($std2));
