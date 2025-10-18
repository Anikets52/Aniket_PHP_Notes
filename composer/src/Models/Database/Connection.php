<?php

namespace Models\Database;

use mysqli;

class Connection
{
    private $servename = "localhost";
    private $Username = "root";
    private $password = "";

    public function connect(string $databaseName): mysqli
    {
        return new mysqli($this->servename, $this->Username, $this->password, $databaseName);
    }
}
