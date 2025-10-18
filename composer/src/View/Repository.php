<?php

namespace View;

use Models\Database\Connection;

class Repository
{
    private $conn;
    public function __construct(Connection $conn, string $databasename)
    {
        $this->conn = $conn->connect($databasename);
    }

    public function display(string $table)
    {
        $query = "SELECT * FROM `$table`";
        $smt = $this->conn->prepare($query);
        if ($smt->execute()) {
            $result = $smt->get_result();
            // foreach ($row = $result->fetch_assoc() as $colum => $value) {
            //     echo $colum . " : ", $value;
            // }

            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return "Error";
        }
    }
}
