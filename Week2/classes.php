<?php
class Student
{
  public $name;
  private $age;
  protected $marks = [];
  function __construct(String $name, int $age)
  {
    $this->age = $age;
    $this->name = $name;
    echo "Object Initialized!!";
  }
  public function display($name = 100)
  {
    echo "Name:" . $this->name . "<br>";
    echo "Age:" . $this->age . "<br>";
  }
  function __destruct()
  {
    echo "<br>Student Object Memory Freed!!";
  }

  function Marks_Display()
  {
    foreach ($this->marks as $subject => $mark) {
      echo "<br>Subject" . $subject . " : " . $mark;
    }
  }
}

class Subject extends Student
{
  function __construct($marks)
  {
    $this->marks = $marks;
  }

  function Marks_Display()
  {
    foreach ($this->marks as $subject => $mark) {
      echo "<br>Subject" . $subject . ":" . $mark;
    }
  }
  function __destruct()
  {
    echo "<br>Markss Object Memory Freed!!";
  }
}

$obj = new Student("Aniket", 21);
echo $obj->display();

$marks = ["Phyiscs" => 20, "Economics" => 12];
$obj2 = new Subject($marks);

$obj2->Marks_Display();
?>
