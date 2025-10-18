<?php
class Student
{

    private $name;
    private $marks = [];
    public function __construct($name, $marks)
    {
        $this->name = $name;
        $this->marks = $marks;
    }
    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return "Name:" . $this->$property;
        }
    }
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        } else {
            echo "Property {$property} does not exist.";
        }
    }
    public function __toString()
    {
        return "Student Name is: " . $this->name;
    }
    public function __call($method, $args)
    {
        if ($method === 'getAverage') {
            return "Average is: " . (array_sum($this->marks) / count($this->marks));
        }
        if ($method === 'getPercentage') {
            $total = 100; // Assuming total marks for each subject is 100
            $percentage = [];
            foreach ($this->marks as $subject => $mark) {
                $percentage[$subject] = (string)(number_format((($mark / $total) * 100), 2)) . "%";
            }
            return $percentage;
        }
        return "Method {$method} does not exist.";
    }


    public function __destruct()
    {
        echo "<br>Object deleted and memory freed!!!";
    }

    public static function __callStatic($name, $arguments)
    {
        echo "<br> Static function {$name} is not defined in the class";
    }

    public function __invoke()
    {
        echo "<br> Method used as a Function";
    }

    public function __debugInfo()
    {
        echo "<br>Vardump used on object";
    }
}
$student = new Student("Aniket", ["Physics" => 40, "Maths" => 55, "English" => 35, "Chemistry" => 40]);
echo $student->name . "<br>"; // Using __get
$student->name2 = "Ajay"; // Using __set
echo $student . "<br>"; // Using __toString
echo $student->getAverage() . "<br>"; // Using __call
print_r($student->getPercentage()); // Using __call
echo "<br>";

Student::hello("Aniket");
$student();

var_dump($student);
