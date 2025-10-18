<?php
class Child
{
    protected $name;
    protected $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getAge()
    {
        return $this->age;
    }
}

class Student extends Child
{
    private $marks = [];

    public function __construct($name, $age)
    {
        parent::__construct($name, $age); // Call parent constructor
    }

    public function setMarks(array $mrks)
    {
        $this->marks = $mrks;
    }

    public function getMarks()
    {
        echo "{$this->name} is of age {$this->age}";
        foreach ($this->marks  as $name => $mark) {
            echo "<br>" . $name . " : " . $mark;
        }
    }
}

$student = new Student("Aniket", 20);
echo $student->getName() . "<br>";
echo $student->getAge() . "<br>";
echo $student->setMarks(["Physics" => 40, "Maths" => 455, "English" => 35, "Chemistry" => 40]);
$student->getMarks();
