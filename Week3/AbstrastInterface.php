<?php
interface Drivable
{
    public function drive(): void;
}

abstract class Vehicle
{
    protected string $brand;

    public function __construct(string $brand)
    {
        $this->brand = $brand;
    }

    abstract public function stop(): void;
}

class Car extends Vehicle implements Drivable
{
    public function drive(): void
    {
        echo "Driving {$this->brand}<br>";
    }

    public function stop(): void
    {
        echo "Stopping {$this->brand}<br>";
    }
}

$car = new Car("Honda");
$car->drive();
$car->stop();
