<?php
// Report all errors (they’ll go to log file, not screen)
error_reporting(E_ALL);
// error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

ini_set("display_errors", 0);
ini_set('log_errors', 1);
ini_set('error_log', 'log.txt');

// class MagicUser
// {
//     private $data = [];

//     public function __construct($name)
//     {
//         $this->data['name'] = $name;
//     }

//     public function __get($key)
//     {
//         return $this->data[$key] ?? "Property $key not found";
//     }

//     public function __set($key, $value)
//     {
//         $this->data[$key] = $value;
//     }

//     public function __toString()
//     {
//         return "User: {$this->data['name']}";
//     }

//     public function __call($name, $arguments)
//     {
//         return "Method $name called with arguments: " . implode(", ", $arguments);
//     }

// }

// $user = new MagicUser("Aniket");
// echo $user->name;
// $user->age = 30;
// echo $user->age;
// echo $user;
// echo $user->unknownMethod("test");

use Dotenv\Parser\Value;

$iterator = new DirectoryIterator(__DIR__);
foreach ($iterator as $file) {
    if ($file->isFile()) {
        echo $file->getFilename() . "<br>";
    }
}


// Spl Iterator classes

//1. Array Iterator
$array = ["Name" => "Aniket", "Age" => 21, "Address" => "Diva"];
$iterator = new ArrayIterator($array);
echo "<br>Array Iterator:<BR>";
foreach ($iterator as $key => $value) {
    echo "$key => $value <br>";
}

//2. RecursiveArrayIterator
$array2 = array(
    "fruits" => ["apple", "banana"],
    "vegetables" => ["carrot", "tamatoo"]
);
$riterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($array2));
echo "<br>Recursive Array Iterator:<BR>";
foreach ($riterator as $key => $value) {
    echo "$key => $value <br>";
}

//3. Directory Iterator
$dir = new DirectoryIterator(".");
echo "<br>Directory Iterator:<BR>";
foreach ($dir as $file) {
    if (!$file->isDot()) {
        echo $file->getFilename() . "<br>";
    }
}

//4. RecursiveDirectory Iterator
$dir = new RecursiveDirectoryIterator(".");
$iterator = new RecursiveIteratorIterator($dir);
// echo "<br>RecursiveDirectory Iterator:<BR>";
// foreach ($iterator as $file) {
//     echo $file . "<br>";
// }

//5. FilterIterator
class EvenFilter extends FilterIterator
{
    public function accept(): bool
    {
        return $this->current() % 2 === 0;
    }
}


$numbers = new ArrayIterator([1, 2, 3, 4, 5, 6]);
$even = new EvenFilter($numbers);
echo "<br>FilterIterator:<BR>";
foreach ($even as $num) {
    echo "Even Number:" . $num . "<br>";  // 2, 4, 6
}



//6. LimitIterator
$data = range(1, 100);
$iterator = new LimitIterator(new ArrayIterator($data), 0, 5); // First 5 items
echo "<b><br>LimitIterator:<BR></b  >";
foreach ($iterator as $number) {
    echo "Number:" . $number . "<br>";
}

//7. RegxIterator

$files = ['image.jpg', 'doc.pdf', 'photo.png'];
$iterator = new RegexIterator(new ArrayIterator($files), '/\.(jpg|png)$/');
echo "<br><b>RegxIterator:</b><BR>";
foreach ($iterator as $file) {

    echo "Name of the files is: " . htmlspecialchars($file, ENT_QUOTES, 'UTF-8') . "<br>";
}

$array = new ArrayIterator(["apple", "banana", "cherry", "apricot"]);
$regex = new RegexIterator($array, '/^a/');
foreach ($regex as $fruit) {
    echo "Elements Name starting with letter 'a': " . $fruit . "<br>";  // apple, apricot
}

/**  SPL Data Structures */
echo "<br><b><h3>: SPL Data Structures :</h3></b><BR>";

//1. SplDoubleLinkedList
$list = new SplDoublyLinkedList();
$list->push('Alice');
$list->push('Bob');
$list->push('Alicew');
echo "<br><b>SplDoublyLinkedList:</b><BR>";
foreach ($list as $item) {
    echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8') . "<br>";
}


//2. SplFixedArray
$array = new SplFixedArray(3);
$array[0] = 'Alice';
$array[1] = 'Bob';
$array[2] = 'Charlie';
echo "<br><b>SplFixedArray:</b><BR>";
foreach ($array as $item) {
    echo htmlspecialchars($item, ENT_QUOTES, 'UTF-8') . "<br>";
}

//3.SplStack
$stack = new SplStack();
$stack->push("Apple");
$stack->push("Banana");
$stack->push("Orange");
echo "<br><b>SplStack:</b><BR>";
foreach ($stack as $item) {
    echo $item . "<br>";
}

//4. SplQueue

$queue = new SplQueue();
$queue->push("Hbaibi1");
$queue->push("Hbaibi2");

echo "<br><b>SplQueue:</b><BR>";
foreach ($queue as $item) {
    echo $item . "<br>";
}


//Spl Custom iterator
class Collection implements Iterator
{
    public $item = [];
    public $position;
    public function __construct(array $item)
    {
        $this->item = $item;
    }
    public function current(): int
    {
        return $this->item[$this->position];
    }
    public function next(): void
    {
        ++$this->position;
    }
    public function key(): string
    {
        return "Aniket_" . $this->position;
    }
    public function rewind(): void
    {
        $this->position = 0;
    }
    public function valid(): bool
    {
        return isset($this->item[$this->position]);
    }
}

$obj = new Collection([1, 2, 32, 4]);
foreach ($obj as $key => $value) {
    echo "<br>{$key} : {$value}";
}


//Spl IteratorAggregate
class Collection2 implements IteratorAggregate
{
    private $item;
    public function __construct($item)
    {
        $this->item = $item;
    }

    public function getIterator(): Traversable
    {
        return new DirectoryIterator($this->item);
    }
}

$obj2 = new Collection2(__DIR__);
foreach ($obj2 as $key => $value) {
    echo "<br>{$key} : {$value}";
}
